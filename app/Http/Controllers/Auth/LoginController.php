<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleLoginredirect()
    {

        $user = Socialite::driver('google')->stateless()->user();
        $data['user_name'] = $user->user['given_name'];
        $data['name'] =  $user->name;
        $data['image'] = $user->avatar;
        $data['email'] = $user->email;
        $register =   User::create([
            'username' => $data['user_name'],
            'name' =>  $data['name'],
            'image' => $data['image'],
            'email' => $data['email'],
            'role' => 'user'
        ]);
        $register->assignRole('user');
        return 'create successfly';
    }
    public function facebookLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function facebookLoginredirect()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $data['user_name'] = $user->name;
        $data['name'] =  $user->name;
        $data['image'] = $user->avatar;
        $data['email'] = $user->email;
        $register =   User::create([
            'username' => $data['user_name'],
            'name' =>  $data['name'],
            'image' => $data['image'],
            'email' => $data['email'],
            'role' => 'user'
        ]);
        $register->assignRole('user');
        return 'create successfly';
    }
}
