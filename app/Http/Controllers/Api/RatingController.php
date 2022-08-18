<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RatingResource;
use App\Http\Resources\WasfaUserResource;
use App\Models\Rating;
use App\Models\WasfaUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{

    public function ratewasfa($lang, $id)
    {
        $this->language($lang);
        $order = WasfaUser::where('id', $id)->where('user_id', auth()->id())->where('status', 'finish')->first();

        if ($order) {
            return response()->json(['error' => false, 'data' => new RatingResource($order), 'status' => 200],);
        } else {
            return response()->json(['error' => true, 'message' => 'هذا الطلب غير موجود', 'status' => 200],);
        }
    }
    public function   ratechef($lang, Request $request)
    {
        $this->language($lang);
        $order = WasfaUser::where('id', $request->order_id)->where('user_id', auth()->id())->first();

        if ($order) {
            return response()->json(['error' => false, 'data' => new RatingResource($order), 'status' => 200],);
        } else {
            return response()->json(['error' => true, 'message' => 'هذا الطلب غير موجود', 'status' => 200],);
        }
    }
    public function postratewasfa($lang, Request $request)
    {
        $this->language($lang);

        $validation = Validator::make($request->all(), [
            'rating' => 'required',
            'note' => 'required',
            'wasfa_id' => 'required',
            'chef_id' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => true, 'message' => $validation->errors(), 'status' => 500], 500);
        }
        $note = null;
        $note_en = null;
        if ($this->language() == 'en') {
            $note_en = $request->note;
        } else {
            $note = $request->note;
        }
        $rating = Rating::create([
            'type' => 'wasfa',
            'wasfa_id' => $request->wasfa_id,
            'rating' => $request->rating,
            'note' => $request->note,
            'note_en' => $request->note,
            'user_id' => auth()->id(),
            'chef_id' => $request->chef_id,

        ]);
        if ($rating) {
            return response()->json(['error' => false, 'message' => 'تم التقييم بنجاح', 'status' => 200],);
        } else {
            return response()->json(['error' => true, 'message' => 'حدث خطأ ما', 'status' => 500],);
        }
    }
    public function postratechef($lang, Request $request)
    {
        $this->language($lang);
        $validation = Validator::make($request->all(), [
            'rating' => 'required',
            'note' => 'required',
            'chef_id' => 'required',
            'wasfa_id' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => true, 'message' => $validation->errors(), 'status' => 500], 500);
        }
        $note = null;
        $note_en = null;
        if ($this->language() == 'en') {
            $note_en = $request->note;
        } else {
            $note = $request->note;
        }
        $rating = Rating::create([
            'type' => 'chef',
            'wasfa_id' => $request->wasfa_id,
            'chef_id' => $request->chef_id,
            'rating' => $request->rating,
            'note' => $request->note,
            'note_en' => $request->note,
            'user_id' => auth()->id(),

        ]);

        if ($rating) {
            return response()->json(['error' => false, 'message' => 'تم التقييم بنجاح', 'status' => 200],);
        } else {
            return response()->json(['error' => true, 'message' => 'حدث خطأ ما', 'status' => 500],);
        }
    }
}
