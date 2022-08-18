<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        /*      $this->middleware('permission:role-index', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-store', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
  */
    }


    public function index(Request $request)
    {

        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        /* foreach ($roles as $r) {
            dd($r->name);
        } */
        $permissions = Permission::get();
        return view('admin.roles.index', compact('roles', 'permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        if ($validator->fails()) {
            \Alert::error('صلاحيات', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator);
        }
        $role = Role::create(['name' => $request->input('name')]);

        $role->syncPermissions($request->input('permission'));


        alert()->success('صلاحيات', 'تم اضافة صلاحيات بنجاح');
        return redirect()->route('admin.roles.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));

        alert()->success('اسئلة شائعة', 'تم اضافة تصنيف بنجاح');
        return redirect()->route('admin.roles.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->post('id');
        if ($id) {
            DB::table("roles")->where('id', $request->id)->delete();
            alert()->warning(' صلاحيات', 'تم حذف صلاحيات بنجاح');

            return redirect()->route('admin.roles.index')
                ->with('success', 'Role deleted successfully');
        } else {
            alert()->warning(' صلاحيات', 'هناك خطا ما في الصلاحيات   ');

            return redirect()->route('admin.roles.index');
        }
    }
}
