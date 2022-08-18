<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use  App\Helpers\ImageClass;
use Illuminate\Http\Request;
use App\Models\Wasfa;
use Illuminate\Support\Facades\Response;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;
use App\Models\User;
use App\Models\WasfaContent;

class WasfaController extends Controller
{
    function __construct()
    {
        /*      $this->middleware('permission:wasfas-index', ['only' => ['index']]);
        $this->middleware('permission:wasfas-store', ['only' => ['store']]);
        $this->middleware('permission:wasfas-edit', ['only' => ['edit']]);
        $this->middleware('permission:wasfas-update', ['only' => ['update']]);
        $this->middleware('permission:wasfas-delete', ['only' => ['destroy']]);
 */
    }
    public function index()
    {
        $wasfas = Wasfa::orderBy('id', 'DESC')->with(['user', 'category'])->paginate(10);
        $cats = Category::get();
        if ($cats->isEmpty()) {
            alert()->error('اقسام', 'لا يوجد اقسام');
            return redirect()->route("admin.categories.index");
        }
        return view('admin.wasfas.index', compact('wasfas'));
    }
    public function create()
    {
        $cats = Category::where('status', '1')->get();
        return view('admin.wasfas.create', compact('cats'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|max:35|unique:wasfas,name',
            'name_en'         => 'required|max:35|unique:wasfas,name_en',
            'discription'   => 'required',
            'discription_en'   => 'required',
            'status'        => 'required',
            'price'        => 'required',
            'category_id'   => 'required|exists:categories,id',
            'time_make'   => 'required',
            'number_user'   => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('وصفات', 'هناك خطا ما');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->image) {
            $filename = ImageClass::create($request->image, 'wasfas');
            $artical =   Wasfa::create([
                'name' => $request->post('name'),
                'name_en' => $request->post('name_en'),
                'discription' => Purify::clean($request->post('discription')),
                'discription_en' => Purify::clean($request->post('discription_en')),
                'status' => $request->post('status'),
                'user_id' => auth()->id(),
                'category_id' => $request->post('category_id'),
                'image' => $filename,
                'price' => $request->post('price'),
                'time_make' => $request->post('time_make'),
                'number_user' => $request->post('number_user'),
            ]);

            $elemnts = [];
            foreach ($request->element as $key => $value) {
                if (empty($value)) {
                    alert()->error('وصفات', 'يجيب ان تدخل قيمة العنصر');
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $elemnts[$key]['name'] = $value;
                $elemnts[$key]['name_en'] = $value;
                $elemnts[$key]['price'] = $request->element_value[$key];
                $elemnts[$key]['status'] = $request->element_status[$key];
                $elemnts[$key]['element_img'] = $request->element_img[$key];
            }
            foreach ($elemnts as $key => $value) {
                $contentImage = ImageClass::create($value['element_img'], 'wasfas_content');

                $artical->wasfa_content()->create([
                    'name' => $value['name'],
                    'name_en' => $value['name_en'],
                    'price' => $value['price'],
                    'status' => $value['status'],
                    'image' => $contentImage,
                ]);
            }
            alert()->success('وصفات', 'تم اضافة وصفات بنجاح');
            return redirect()->route('admin.wasfas.index');
        }
    }
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $wasfa = Wasfa::where('id', $id)->with('wasfa_content')->first();
        $cats = Category::get();
        return view("admin.wasfas.wasfa_edit", compact('wasfa', 'cats'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $wasfa = Wasfa::where('id', $request->id)->first();
        $validator = Validator::make($request->all(), [
            'name'         => 'required|max:35',
            'name_en'         => 'required|max:35',
            'discription'   => 'required',
            'discription_en'   => 'required',
            'price'      => 'required',
            'status'        => 'required',
            'category_id'   => 'required|exists:categories,id',
            'time_make'   => 'required',
            'number_user' => 'required'
        ]);
        if ($validator->fails()) {
            alert()->error('وصفات', 'هناك خطا ما');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($wasfa) {
            $elemnts = [];
            // اضاف صورة
            if ($request->image) {
                $data['image'] = ImageClass::update($request->image, $wasfa->image, 'wasfas');
            }
            $data['name'] = $request->post('name');
            $data['name_en'] = $request->post('name_en');
            $data['discription'] = Purify::clean($request->post('discription'));
            $data['discription_en'] = Purify::clean($request->post('discription_en'));
            $data['price'] = $request->post('price');
            $data['category_id'] = $request->post('category_id');
            $data['status'] = $request->post('status');
            $data['time_make'] = $request->post('time_make');
            $data['number_user'] = $request->post('number_user');
            $wasfa->update($data);
            alert()->success('وصفات', 'تم اضافة وصفات بنجاح');
            return redirect()->route('admin.wasfas.index');
        } else {
            alert()->error('وصفات', 'هناك خطا ما');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $wasfa = Wasfa::where('id', $request->id)->first();
        if ($wasfa->image) {
            ImageClass::delete($wasfa->image, 'wasfas');
            foreach ($wasfa->wasfa_content as $content) {
                ImageClass::delete($content->image, 'wasfas_content');
            }
            $wasfa->delete();
            alert()->warning('وصفات', 'تم حذف وصفات بنجاح');
            return redirect()->route('admin.wasfas.index');
        }
    }
}
