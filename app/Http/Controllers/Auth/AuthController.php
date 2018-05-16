<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\changePasswordRequest;
use App\Http\Requests\Auth\loginRequest;
use App\Http\Requests\Auth\registerRequest;
use App\Http\Requests\Auth\forgotPasswordRequest;
use App\Http\Requests\Auth\resetPasswordRequest;
use App\Models\Partner;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller {
    
    /**
     * Show the form for logging the user in.
     *
     * @return \Illuminate\View\View
     */
    public function login() {
        
        if(Sentinel::guest() == false){
            return redirect()->route('home');
        }
        
        return view('auth.login');
    }
    
    /**
     * Handle a login request to the application.
     *
     * @param loginRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function processLogin(loginRequest $request) {
        
        $credentials = array(
            'email'    => $request->email,
            'password' => $request->password,
        );

        $remember = $request->remember == 'On' ? true : false;

        try {
            if ($user = Sentinel::authenticate($credentials, $remember)) {

                Session::flash('success', __('auth.login_successful'));

                return redirect('/auth');
                
                //return redirect()->intended();
            } else {
                Session::flash('failed', __('auth.login_unsuccessful'));
                
                return redirect()->route('login.form');
            }
        } catch (ThrottlingException $ex) {
            Session::flash('failed', __('auth.login_timeout'));
            
            return redirect()->route('login.form');
            
        } catch (NotActivatedException $ex) {
            Session::flash('failed', __('auth.login_unsuccessful_not_active'));
            
            return redirect()->route('login.form');
        }
    }
    
    /**
     * Handle a logout request to the application.
     *
     * @return \Illuminate\Http\Response
     *
     * @internal param Request $request
     */
    public function logout() {
        
        Sentinel::logout(null, true);
        
        Session::flash('success', __('auth.logout_successful'));
        
        return redirect()->route('login.form');
    }
    
    /**
     * Show the form for the user registration.
     *
     * @return \Illuminate\View\View
     */
    public function register() {
        return view('auth.register');
    }
    
    /**
     * Handle posting of the form for the user registration.
     *
     * @param registerRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processRegistration(registerRequest $request) {

        DB::beginTransaction();
        try {
            
            $request->offsetSet('created_by', 'Register');
            $request->offsetSet('updated_by', 'Register');

            if ($user = Sentinel::register($request->all())) {
                
                $activation = Activation::create($user);
                
                //Attach the user to the role
                $role = Sentinel::findRoleBySlug('user');
                $role->users()
                     ->attach($user);
                
                $code = $activation->code;
                
                //$sent = Mail::send('auth.emails.activate', compact('user', 'code'), function ($m) use ($user) {
                //    $m->to($user->email)
                //      ->subject('Activate Your Account');
                //});
                
                $sent = 1;
                
                if ($sent === 0) {
                    Session::flash('failed', __('auth.activation_email_unsuccessful'));
                    
                    return redirect()
                        ->back()
                        ->withInput();
                }
                
                DB::commit();
                
                Session::flash('success', __('auth.activation_email_successful'));
                
                return redirect()->route('login.form');
            }
            
            
        } catch (\Exception $exception) {
            
            DB::rollBack();
            
            dd($exception->getMessage() . ' ' . $exception->getLine());
            Session::flash('failed', __('auth.activation_email_unsuccessful'));
            
            return redirect()->route('register.form');
        }
    }
    
    /**
     * Handle activation for the user registration.
     *
     * @param $userId
     * @param $code
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($userId, $code) {
        
        $user = Sentinel::findById($userId);
        
        if (Activation::complete($user, $code)) {
            
            // Activation was successfull
            Session::flash('success', __('auth.activate_successful'));
            
            return redirect()->route('login.form');
            
        } else {

            Activation::removeExpired();
            // Activation not found or not completed.
            Session::flash('failed', __('auth.activate_unsuccessful'));
            
            return redirect()->route('register.form');
        }
    }
    
    /**
     * Display the password reset view for the email.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forgotPassword() {
        return view('auth.password.forgot');
    }
    
    /**
     * Send the given user's email reset instruction.
     *
     * @param forgotPasswordRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processForgotPassword(forgotPasswordRequest $request) {
    
        DB::beginTransaction();
        try {
            $credentials = [
                'login' => $request->email,
            ];
    
            $user = Sentinel::findByCredentials($credentials);
    
            if (!$user) {
        
                Session::flash('failed', __('auth.forgot_password_email_not_found'));
        
                return redirect()->back()
                                 ->withInput();
            }
    
            $reminder = Reminder::exists($user) ?: Reminder::create($user);
    
            $code     = $reminder->code;
    
            $sent     = Mail::send('auth.emails.password', compact('user', 'code'), function ($m) use ($user) {
                $m->to($user->email)
                  ->subject('Reset your account password.');
            });
            
            if ($sent === 0) {
                Session::flash('failed', __('auth.forgot_password_unsuccessful'));

                return redirect()->back();

            }
    
            DB::commit();
    
            Session::flash('success', __('auth.forgot_password_successful'));
            return redirect()->back();
            
            
        } catch (\Exception $exception) {
            DB::rollBack();
    
            Session::flash('failed', __('auth.forgot_password_unsuccessful'));
    
            return redirect()->back();
    
        }
        
    }
    
    /**
     * Display the password reset view for the given token.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resetPassword(){
        return view('auth.password.reset');
    }
    
    /**
     * Reset the given user's password.
     *
     * @param resetPasswordRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processResetPassword(resetPasswordRequest $request){
        
        $user = Sentinel::findById($request->userId);
    
        if ( ! $user)
        {
            Session::flash('failed', __('auth.forgot_password_email_not_found'));
            return redirect()->back()
                           ->withInput();
        }
    
        if ( ! Reminder::complete($user, $request->code, $request->password))
        {
            Session::flash('failed', __('Invalid or expired reset code.'));
    
            return redirect()->route('forgotPassword.form');
        }
    
        Session::flash('success', __('auth.password_change_successful'));
    
        return redirect()->route('login.form');
    
    }
    
    /**
     * Display the denied view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function accessDenied(){
        return view('auth.password.change');
    }
    
    /**
     * Display the change password form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword(){
        return view('auth.password.change');
    }
    
    /**
     * Handle change password action
     *
     * @param changePasswordRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processChangePassword(changePasswordRequest $request){

        $user = Sentinel::getUser();
        
        $credentials = [
            'email'    => $user->email,
            'password' => $request->old_password,
        ];
    
        #Is this password is valid for this user?
        if(Sentinel::validateCredentials($user, $credentials)){
            $credentials['password'] = $request->password;
            
            Sentinel::update($user, $credentials);
    
            Sentinel::logout();
    
            Session::flash('success', __('auth.password_change_successful'));
            return redirect()->route('login.form');
            
        } else {
            Session::flash('failed', __('auth.reset_password_change_unsuccessful_old'));
            return redirect()->back()->withInput($request->all());
        }
    }
}