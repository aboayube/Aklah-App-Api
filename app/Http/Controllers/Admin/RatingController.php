<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    //

    public function chefs()
    {
        if (auth()->user()->role == 'admin') {
            $ratings = Rating::where('type', 'chef')->paginate();
        } else {
            $ratings = Rating::where('type', 'chef')->where('chef_id', auth()->id())->all();
        }
        return view('admin.rating.chefs', compact('ratings'));
    }
    public function wasfas()
    {
        if (auth()->user()->role == 'admin') {
            $ratings = Rating::where('type', 'wasfa')->paginate();
        } else {
            $ratings = Rating::where('type', 'wasfa')->where('type_id', auth()->id())->all();
        }
        return view('admin.rating.wasfas', compact('ratings'));
    }
}
