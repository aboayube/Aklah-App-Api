<?php

namespace App\Http\Controllers;

use App\Helpers\Paypal;
use App\Models\WasfaUser;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function Paypalreturn()
    {
        $pay = new Paypal();
        $data =  $pay->paypalReturn();
        $wasfa = WasfaUser::where('id', $data['id'])->first();
        $wasfa->update(['status' => 'pen']);
        return redirect()->route('home');
    }
    public function Paypalcancle()
    {
        return 'there is error in payment method';
    }
}
