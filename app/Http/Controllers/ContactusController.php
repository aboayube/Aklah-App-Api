<?php

namespace App\Http\Controllers;

use App\Models\Contactus;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ContactusController extends Controller
{

    //
    function __construct()
    {
        /*      $this->middleware('permission:contactus-index', ['only' => ['index']]);
        $this->middleware('permission:contactus-delete', ['only' => ['destroy']]);
    */
    }
    public function index()
    {
        $contactus = Contactus::orderBy('id', 'desc')->paginate();
        return view('admin.contactus', compact('contactus'));
    }
    public function create()
    {
        return view('contactus');
    }
    public function store(Request $request)
    {
        if (App::getLocale() == 'ar') {
            if (\Auth::check()) {
                $data = ['message' => 'required'];
                $this->validationRoles($request, $data);
                $data['name'] = auth()->user()->name;
                $data['email'] = auth()->user()->email;
            } else {
                $this->validationRoles($request, ['name' => 'required', 'email' => 'required', 'message' => 'required']);
                $data['name'] = $request->post('name');
                $data['message'] = $request->post('message');
                $data['email'] = $request->post('email');
            }
        } else if (App::getLocale() == 'en') {
            if (\Auth::check()) {
                $valid = ['message_en' => 'required'];
                $adssad =  $this->validationRoles($request, $valid);
                dd($adssad);
                $data['name_en'] = auth()->user()->name_en;
                $data['email'] = auth()->user()->email;
            } else {
                $this->validationRoles($request, ['name_en' => 'required', 'email' => 'required', 'message_en' => 'required']);
                $data['name_en'] = $request->post('name_en');
                $data['email'] = $request->post('email');
                $data['message_en'] = $request->post('message_en');
            }
        }
        Contactus::create($data);
        alert()->success('  سوف تتواصلك معك ادارة قريبا تواصل مع ادارة', 'تم طلبك   بنجاح');
        return redirect()->route('home');
    }
    public function delete(Request $request)
    {
        $contactus = Contactus::find($request->post('id'));
        $contactus->delete();
        alert()->success('مقالات', 'تم اضافة تصنيف بنجاح');
        return redirect()->route('admin.contactus.index');
    }
    private function validationRoles($request, $validation)
    {
        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            alert()->error('تواصل', 'هناكق خطا ما');
            return redirect()->back();
        }
    }
}
