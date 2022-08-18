<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\WasfaUser;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class RegisterChefController extends Controller
{

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
        $user = User::create([
            'name' => $name,
            'name_en' => $name_en,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'mobile' => $request->mobile,
            'role' => 'chef',
            'status' => '0',
        ]);
        $user->assignRole('chef');
        $data['user'] = new UserResource($user);
        $data['token'] = $user->createToken('my-app-token')->plainTextToken;

        return response()->json(['error' => false, 'data' => $data, 'status' => 200], 200);
    }
 
}
