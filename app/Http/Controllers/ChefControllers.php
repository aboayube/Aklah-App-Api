<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChefControllers extends Controller
{
    public function index()
    {
        $chefs = User::where('role', 'chef')->where('status', '1')->get();
        return view('chefs.index', compact('chefs'));
    }
    public function chef($id)
    {
        $chef = User::where('status', '1')->where('role', 'chef')->where('id', $id)->with('wasfas')->first();
        return view('chefs.chef', compact('chef'));
        
    }
}
