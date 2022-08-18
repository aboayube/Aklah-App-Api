<?php

namespace App\Http\Controllers;

use App\Helpers\Paypal;
use App\Models\WasfaUser;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {

        $wasfas =    WasfaUser::where('user_id', auth()->id())->where('status', 'card')->get();
     
        return view('cards.index', compact('wasfas'));
    }
    public function payment(Request $request)
    {
        $pay = new Paypal();
        $pay->paypal($request->post('price'), $request->post('id'));

        
    }
    public function delete($id)
    {
        $wasfas =    WasfaUser::where('user_id', auth()->id())->where('id', $id)->first();
        if ($wasfas) {
            $wasfas->delete();
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        }
    }
}
