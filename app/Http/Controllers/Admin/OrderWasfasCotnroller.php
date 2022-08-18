<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WasfaUser;
use App\Models\WasfaUserContent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OrderWasfasCotnroller extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $wasfas = WasfaUser::paginate(15);
        } else {
            $wasfas = WasfaUser::where('chef_id', auth()->id())->paginate(15);
        }
        return view('admin.orders.index', compact('wasfas'));
    }
    public function show($id)
    {
        $wasfa = WasfaUser::where('id', $id)->first();
        $wasfa_content = WasfaUserContent::where('wasfa_id', $wasfa->wasfa_id)->where('user_id', $wasfa->user_id)->get();

        if ($wasfa) {
            return view('admin.orders.show', compact('wasfa', 'wasfa_content'));
        }
    }
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('اقسام', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $wasfa = WasfaUser::where('id', $request->id)->first();
        if ($wasfa) {
            $wasfa->update(['status' => 'end']);
            alert()->success('success', 'alert yes');
            return redirect()->back();
        }
    }
    //
}
