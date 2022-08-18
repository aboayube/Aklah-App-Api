<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ImageClass;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class RegisterUserController extends Controller
{

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'data' => 'somthing was error', 'status' => 200]);
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $data['user'] = new UserResource($user);
            $data['token'] = $user->createToken('my-app-token')->plainTextToken;
            return response()->json(['error' => false, 'data' => $data, "status" => 200]);
        } else {

            return response()->json(['error' => true, 'data' => "somthing is error", 'status' => 200]);
        } //end of else

    }
    //
    public function register(Request $request, $lang)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'mobile' => 'required|numeric|min:10',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'true', 'message' => $validator->errors()->first(), 'status' => 200]);
        }
        $name = null;
        $name_en = null;
        if ($this->language() == 'ar') {
            $name = $request->name;
        } else {
            $name_en = $request->name;
        }
        $datauser =  $user = User::create([
            'name' => $name,
            'name_en' => $name_en,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'mobile' => $request->mobile,
            'role' => 'user',
            'status' => '1',
        ]);
        $user->assignRole('user');
        $data['user'] = new UserResource($datauser);
        $data['token'] = $user->createToken('my-app-token')->plainTextToken;

        return response()->json(['error' => false, 'data' => $data, 'status' => 200], 200);
    }

    public function address(Request $request, $lang)
    {
        $this->language($lang);
        $validator = Validator::make($request->all(), [
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'true', 'message' => $validator->errors()->first(), 'status' => 200]);
        }
        $user = User::find(auth()->id());
        $user->longtoitle = $request->lat;
        $user->attuite = $request->lng;
        $user->save();
        return response()->json(['error' => false, 'data' => new UserResource($user), 'status' => 200], 200);
    }
    public function editprofile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name_en' => 'required',
            'mobile' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'true', 'message' => $validator->errors()->first(), 'status' => 200]);
        }
        $user = User::where('id', auth()->id())->first();
        if ($user) {
        } else {
            return response()->json(['error' => 'true', 'message' => 'user not found', 'status' => 200]);
        }
        if ($request->image) {
            $data['image'] = ImageClass::update($request->image, $user->image, 'users');
        }

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $data['name'] = $request->name;
        $data['name_en'] = $request->name_en;
        $data['mobile'] = $request->mobile;
        $user->update($data);
        return response()->json(['error' => false, 'data' => new UserResource($user), 'status' => 200], 200);
    }
    public function getUserbyToken(Request $reuqest)
    {
        $user = User::where('remember_token', $reuqest->token)->first();
        if ($user) {
            return response()->json(['error' => false, 'data' => new UserResource($user), 'status' => 200], 200);
        } else {
            return response()->json(['error' => true, 'message' => 'user not found', 'status' => 200]);
        }
    }
}
