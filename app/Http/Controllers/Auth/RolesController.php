<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\Role;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

use App\Http\Requests\Auth\Role\createRequest;
use App\Http\Requests\Auth\Role\updateRequest;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('auth.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param createRequest $request
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function store(createRequest $request)
    {

        $data = new Role();
        $data->name = $request->name;
        $data->slug = str_slug($request->name);

        /**
         *  Permission Here
         */
        $permissions = collect(json_decode($this->permissions($request)))->toArray();
        $data->permissions = $permissions;

        $data->save();

        Session::flash('success', __('auth.role_creation_successful'));

        return redirect()->route('roles.index');
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

        $dataDb = Role::find($id);

        if (empty($dataDb)) {
            Session::flash('failed', __('global.denied'));

            return redirect()->back();
        }

        $permission = json_decode(json_encode($dataDb->permissions), true);

        return view('auth.role.update', array(
            'dataDb'      => $dataDb,
            'permissions' => $permission
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param updateRequest $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(updateRequest $request, $id)
    {

        $dataDb = Role::find($id);

        if (empty($dataDb)) {
            Session::flash('failed', __('global.denied'));

            return redirect()->back();
        }

        $dataDb->name = $request->name;

        /**
         *  Permission Here
         */
        $permissions = collect(json_decode($this->permissions($request)))->toArray();
        $dataDb->permissions = $permissions;
        $dataDb->save();

        Session::flash('success', __('auth.role_update_successful'));

        return redirect()->route('roles.index');
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

        $userDb = Sentinel::getUser();
        $dataDb = Sentinel::findRoleById($id);

        if (empty($dataDb)) {
            Session::flash('failed', __('global.not_found'));

            return redirect()->route('roles.index');
        }

        $dataDb->users()
            ->detach($userDb);
        $dataDb->delete();

        Session::flash('success', __('auth.delete_account'));

        return redirect()->route('roles.index');

    }

    /**
     * Datatables Ajax Data
     *
     * @return mixed
     * @throws \Exception
     */
    public function anyData()
    {

        $dataDb = Role::select([
            'id',
            'slug',
            'name',
            'created_at',
            'updated_at',
        ]);

        return Datatables::eloquent($dataDb)
            ->addColumn('action', function ($dataDb) {
                return '<a href="' . route('roles.edit', $dataDb->id) . '" id="tooltip" title="Edit"><span class="label label-warning label-sm"><i class="fa fa-edit"></i></span></a>
                             <a href="' . route('roles.duplicate', $dataDb->id) . '" id="tooltip" title="Duplicate"><span class="label label-info label-sm"><i class="fa fa-copy"></i></span></a>
                             <a href="#" data-message="' . trans('auth.delete_confirmation', ['name' => $dataDb->name]) . '" data-href="' . route('roles.destroy', $dataDb->id) . '" id="tooltip" data-method="DELETE" data-title="Delete" data-title-modal="' . trans('auth.delete_confirmation_heading') . '" data-toggle="modal" data-target="#delete"><span class="label label-danger label-sm"><i class="fa fa-trash"></i></span></a>';
            })
            ->make(true);
    }

    /**
     * For Add Permission
     *
     * @param $request
     *
     * @return string
     */
    private function permissions($request)
    {

        //Dashboard
        $permissions['dashboard'] = true;

        $request = $request->except(array('_token', 'name', '_method', 'previousUrl'));

        foreach ($request as $key => $value) {
            $permissions[preg_replace('/_([^_]*)$/', '.\1', $key)] = true;
        }

        return json_encode($permissions);
    }

    /**
     * Duplicate Form
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function duplicate($id)
    {
        $data = Role::where('id', $id)->firstOrFail();

        $permission = json_decode(json_encode($data->permissions), true);

        return view('auth.role.duplicate', ['data' => $data, 'permissions' => $permission]);
    }
}
