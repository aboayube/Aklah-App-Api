<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\WasfaUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RattingController extends Controller
{
    //
    public function ratewasfa(Request $request)
    {
        $order = WasfaUser::where('id', $request->order_id)->where('user_id', auth()->id())->first();

        if ($order) {
            return view('rating.wasfa', compact('order'));
        }
    }
    public function   ratechef(Request $request)
    {
        $order = WasfaUser::where('id', $request->order_id)->where('user_id', auth()->id())->first();
        if ($order) {
            return view('rating.chef', compact('order'));
        }
    }
    public function postratewasfa(Request $request)
    {


        $validation = Validator::make($request->all(), [
            'rating' => 'required',
            'note' => 'required',
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
            'type' => 'wasfa',
            'wasfa_id' => $request->wasfa_id,
            'rating' => $request->rating,
            'note' => $request->note,
            'note_en' => $request->note,
            'user_id' => auth()->id(),
            'chef_id' => $request->chef_id,

        ]);
        return redirect()->route('home');
    }
    public function postratechef(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'rating' => 'required',
            'note' => 'required',
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
            'type' => 'chef',
            'wasfa_id' => $request->wasfa_id,
            'chef_id' => $request->chef_id,
            'rating' => $request->rating,
            'note' => $request->note,
            'note_en' => $request->note,
            'user_id' => auth()->id(),

        ]);
        return redirect()->route('home');
    }
}
