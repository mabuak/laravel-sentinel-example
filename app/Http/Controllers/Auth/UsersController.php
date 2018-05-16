<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\createRequest;
use App\Http\Requests\Auth\User\updateRequest;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use Yajra\DataTables\Facades\Datatables;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roleDb = Role::select('id', 'name')
            ->get();

        return view('auth.user.create', array(
            'roleDb' => $roleDb,
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param createRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function store(createRequest $request)
    {

        $email = $request->email;
        $user  = Sentinel::getUser()->first_name;

        DB::beginTransaction();
        try {
            $data = [
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => strtolower($email),
                'password'   => $request->password,
                'created_by' => $user,
                'updated_by' => $user,
            ];

            //Create a new user
            $user = Sentinel::registerAndActivate($data);

            //Attach the user to the role
            $role = Sentinel::findRoleById($request->role);
            $role->users()
                ->attach($user);

            DB::commit();

            Session::flash('success', __('auth.account_creation_successful'));

            return redirect()->route('users.index');

        } catch (\Exception $exception) {

            DB::rollBack();

            Session::flash('failed', $exception->getMessage() . ' ' . $exception->getLine());

            return redirect()
                ->back()
                ->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = Sentinel::findUserById($id);

        if (empty($user)) {
            Session::flash('failed', __('global.not_found'));

            return redirect()->route('users.index');
        }

        $roleDb = Role::select('id', 'name')
            ->get();

        $userRole = $user->roles[0]->id ?? null;

        return view('auth.user.update', array(
            'data'     => $user,
            'roleDb'   => $roleDb,
            'userRole' => $userRole
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param updateRequest $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(updateRequest $request, $id)
    {

        $user = Sentinel::findById($id);

        if (empty($user)) {
            Session::flash('failed', __('global.not_found'));

            return redirect()->route('users.index');
        }

        DB::beginTransaction();
        try {

            $oldRole = Sentinel::findRoleById($user->roles[0]->id ?? null);

            $credentials = [
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
            ];

            #If User Input Password
            if ($request->password) {
                $validator = Validator::make($request->all(), [
                    'password' => 'min:8',
                ]);

                if ($validator->fails()) {
                    return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
                }

                $credentials['password'] = $request->password;
            }

            #Valid User For Update
            $role = Sentinel::findRoleById($request->role);

            if ($oldRole) {
                #Remove a user from a role.
                $oldRole->users()
                    ->detach($user);
            }

            #Assign a user to a role.
            $role->users()
                ->attach($user);

            #Update User
            Sentinel::update($user, $credentials);

            DB::commit();

            Session::flash('success', __('auth.update_successful'));

            return redirect()->route('users.index');

        } catch (\Exception $exception) {

            DB::rollBack();

            Session::flash('failed', $exception->getMessage() . ' ' . $exception->getLine());

            return redirect()
                ->back()
                ->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = Sentinel::findById($id);

        if (empty($data)) {
            Session::flash('failed', __('global.not_found'));

            return redirect()->route('users.index');
        }

        $data->delete();

        Session::flash('success', __('auth.delete_account'));

        return redirect()->route('users.index');

    }

    /**
     * Datatables Ajax Data
     *
     * @return mixed
     * @throws \Exception
     */
    public function anyData(Request $request)
    {

        if ($request->ajax() == true) {
            $dataDb = User::select([
                'users.id',
                'first_name',
                'last_name',
                'email',
                'last_login',
                'users.created_at',
                'users.updated_at',
            ])
                ->with('roles', 'activations');

            return Datatables::eloquent($dataDb)
                ->addColumn('action', function ($dataDb) {
                    return '<a href="' . route('users.edit', $dataDb->id) . '" id="tooltip" title="Edit"><span class="label label-warning label-sm"><i class="fa fa-edit"></i></span></a>
                                <a href="#" data-message="' . trans('auth.delete_confirmation', ['name' => $dataDb->email]) . '" data-href="' . route('users.destroy', $dataDb->id) . '" id="tooltip" data-method="DELETE" data-title="Delete" data-title-modal="' . trans('auth.delete_confirmation_heading') . '" data-toggle="modal" data-target="#delete"><span class="label label-danger label-sm"><i class="fa fa-trash-o"></i></span></a>';
                })
                ->addColumn('role', function ($dataDb) {
                    if ($dataDb->roles->isNotEmpty()) {
                        return implode(', ', collect($dataDb->roles)
                            ->pluck('name')
                            ->all());
                    }
                })
                ->addColumn('status', function ($dataDb) {
                    if ($dataDb->activations->isNotEmpty()) {
                        if ($dataDb->activations[0]->completed == 1) {
                            return '<a href="#" data-message="' . trans('auth.deactivate_subheading', ['name' => $dataDb->email]) . '" data-href="' . route('users.status', $dataDb->id) . '" id="tooltip" data-method="PUT" data-title="' . trans('auth.deactivate_this_user') . '" data-title-modal="' . trans('auth.deactivate_heading') . '" data-toggle="modal" data-target="#delete" title="' . trans('auth.deactivate_this_user') . '"><span class="label label-success label-sm">' . trans('auth.index_active_link') . '</span></a>';
                        }
                    }

                    return '<a href="#" data-message="' . trans('auth.activate_subheading', ['name' => $dataDb->email]) . '" data-href="' . route('users.status', $dataDb->id) . '" id="tooltip" data-method="PUT" data-title="' . trans('auth.activate_this_user') . '" data-title-modal="' . trans('auth.deactivate_heading') . '" data-toggle="modal" data-target="#delete" title="' . trans('auth.activate_this_user') . '"><span class="label label-danger label-sm">' . trans('auth.index_inactive_link') . '</span></a>';

                })
                ->rawColumns(array(
                    'status',
                    'action'
                ))
                ->make(true);
        }
    }

    /**
     * For Active or Deactive User
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status($id)
    {

        $user = Sentinel::findById($id);

        $activation = Activation::completed($user);

        #Remove activation code
        Activation::remove($user);

        if ($activation !== false) {
            #Deactivated This Activation
            if ($user->id === Sentinel::getUser()->id) {
                Session::flash('failed', __('auth.deactivate_current_user_unsuccessful'));

                return redirect()->route('users.index');
            }

            Session::flash('success', __('auth.deactivate_successful'));

            return redirect()->back();
        }

        #Own User Cannot Change The User Status
        if ($user->id === Sentinel::getUser()->id) {
            Session::flash('failed', __('auth.active_current_user_unsuccessful'));

            return redirect()->back();
        }

        #Get Activation Code
        $activationCreate = Activation::create($user);

        #Activate this account
        Activation::complete($user, $activationCreate->code);

        Session::flash('success', __('auth.activate_successful'));

        return redirect()->back();
    }
}
