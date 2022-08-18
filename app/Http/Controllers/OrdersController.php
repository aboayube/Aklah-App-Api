<?php

namespace App\Http\Controllers;

use App\Models\WasfaUser;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orderspendeing = WasfaUser::where('status', 'pendeing')->get();
        $orderpayment = WasfaUser::where('status', 'payment')->get();
        $ordercacncle = WasfaUser::where('status', 'cacncle')->get();
        $orderend = WasfaUser::where('status', 'end')->get();
        $orderfinish = WasfaUser::where('status', 'finish')->get();
        return view('orders.index', compact(
            'orderspendeing',
            'ordercacncle',
            'orderend',
            'orderfinish',
            'orderpayment'
        ));
    }
    //
}
