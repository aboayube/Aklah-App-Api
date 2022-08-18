<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\UserRegisterNotification;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SupervisorsController extends Controller
{

    function __construct()
    {
        /*      $this->middleware('permission:supervisors-index', ['only' => ['index']]);
        $this->middleware('permission:supervisors-store', ['only' => ['store']]);
        $this->middleware('permission:supervisors-edit', ['only' => ['edit']]);
        $this->middleware('permission:supervisors-update', ['only' => ['update']]);
        $this->middleware('permission:supervisors-delete', ['only' => ['destroy']]);
   */
    }
    public function index(Request $request)
    {

        $data = User::orderBy('id', 'DESC')->where('role', '<>', 'user')->where('role', '<>', 'chef')->paginate(15);

        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('admin.users.supervisors', compact('data', 'roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'name' => 'required',
            'name_en' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'status' => 'required',
            'mobile' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('صلاحيات', 'هناك خطا ما');
            return redirect()->back()->withErrors($validator);
        }
        $user = User::create([
            'username' => $request->post('username'),
            'name' => $request->post('name'),
            'name_en' => $request->post('name_en'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password')),
            'role' => $request->post('role'),
            'status' => $request->post('status'),
            'email_verified_at' =>  \Carbon\Carbon::now(),
            'mobile' => $request->post('mobile'),
            'discription' => $request->post('discription'),
            'discription_en' => $request->post('discription_en'),
            'image' => 'profile.png',
            'location' => "null",
        ]);
        $user->assignRole($request->input('role'));
        alert()->success('مشرفين ', 'تم اضافة مشرف بنجاح');
        return redirect()->route('admin.supervisors.index');
    }
    public function edit($id)
    {
        $user = User::whereId($id)->select('status', 'role')->get();
        return Response::json($user);
    }
    public function update(Request $request)
    {
        $user = User::find($request->id);
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('مشرفين', 'هناك خطا ما');
            return redirect()->back()->withErrors($validator);
        }
        $user->update([
            'status' => $request->post('status'),
            'role' => $request->post('role'),
        ]);
        alert()->success('مشرفين', 'تم التعديل بنجاح');
        return redirect()->route('admin.supervisors.index');
    }
    public function destroy(Request $request)
    {
        User::findorFail($request->id)->delete();
        alert()->success('اطباء', 'تم التعديل بنجاح');
        return redirect()->route('admin.supervisors.index');
    }
}
