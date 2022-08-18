<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WasfaUserResource;
use App\Models\WasfaUser;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function card($lang)
    {
        $this->language($lang);
        $orders = WasfaUser::where('status', 'card')->orderBy('id', 'DESC')->paginate(10);
        if ($orders->count() > 0) {
            return response()->json(['error' => false, 'data' => WasfaUserResource::collection($orders), 'status' => 200]);
        } else {
            return response()->json(['error' => true, 'message' => 'No wasfas found', 'status' => 200],);
        }
    }
    //
    public function execute($lang)
    {
        $this->language($lang);
        if (auth()->user()->role == 'chef') {
            $orders = WasfaUser::where('chef_id', auth()->id())->orderBy('id', 'DESC')->paginate(10);
        } else {
            $orders = WasfaUser::orderBy('id', 'DESC')->where('user_id', auth()->id())->paginate(10);
        }
        if ($orders->count() > 0) {
            return response()->json(['error' => false, 'data' => WasfaUserResource::collection($orders), 'status' => 200]);
        } else {
            return response()->json(['error' => true, 'message' => 'No wasfas found', 'status' => 200],);
        }
    }
    public function finish($lang)
    {
        $this->language($lang);

        if (auth()->check()) {
            $orders = WasfaUser::where('status', 'cacncle')->orwhere('status', 'end')->where('chef_id', auth()->id())->orderBy('id', 'DESC')->paginate(10);
        } else {
            $orders = WasfaUser::where('status', 'cacncle')->orwhere('status', 'end')->orderBy('id', 'DESC')->paginate(10);
        }
        if ($orders->count() > 0) {
            return response()->json(['error' => false, 'data' => WasfaUserResource::collection($orders), 'status' => 200]);
        } else {
            return response()->json(['error' => true, 'message' => 'No wasfas found', 'status' => 200],);
        }
    }
    public function payment($lang, Request $request)
    {

        $pay = new Paypal();
        $pay->paypal($request->post('price'), $request->post('id'));
    }
}
