<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function language()
    {
        return App::getLocale();
    }
    public function set_Language($lang = 'ar')
    {
        App::setLocale($lang);
    }
}
