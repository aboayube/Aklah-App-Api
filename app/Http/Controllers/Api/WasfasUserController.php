<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WasfaContentResource;
use App\Http\Resources\WasfaUserResource;
use App\Models\WasfaUser;
use App\Models\WasfaUserContent;
use Illuminate\Http\Request;

class WasfasUserController extends Controller
{
    public function show($lang, $id)
    {
        $this->language($lang);
        $order = WasfaUser::where('id', $id)->where('chef_id', auth()->id())->where('status', 'pendding')->first();

        if ($order) {
            return response()->json(['error' => false, 'data' => new WasfaUserResource($order), 'status' => 200],);
        } else {
            return response()->json(['error' => true, 'message' => 'هذا الطلب غير موجود', 'status' => 200],);
        }
    }
    public function show_content(Request $request, $lang, $wasfa_id)
    {
        dd($request->all());
        $this->language($lang);
        $order = WasfaUserContent::where('user_id', $request->user_id)->where('wasfa_id', $wasfa_id)->first();

        if ($order) {
            return response()->json(['error' => false, 'data' => new WasfaContentResource($order), 'status' => 200],);
        } else {
            return response()->json(['error' => true, 'message' => 'هذا الطلب غير موجود', 'status' => 200],);
        }
    }
}
