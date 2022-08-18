<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageClass;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\Wasfa;
use App\Models\WasfaContent;
use Illuminate\Http\Request;

class WasfaContentController extends Controller
{
    public function show($id)
    {
        $wasfacontents = WasfaContent::where('wasfa_id', $id)->paginate();
        return view('admin.wasfas.wasfacontent', compact('wasfacontents', 'id'));
    }
    public function store(Request $request)
    {
        $wasfa = Wasfa::findOrFail($request->wasfa_id);
        if ($wasfa) {
            $validator = Validator::make($request->all(), [
                'name'         => 'required|max:35|unique:wasfas,name',
                'name_en'         => 'required|max:35|unique:wasfas,name_en',
                'status'        => 'required',
                'price'        => 'required',
            ]);
            if ($validator->fails()) {
                alert()->error('وصفات', 'هناك خطا ما');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($request->image) {
                $filename = ImageClass::create($request->image, 'wasfas_content');
                $wasfa->wasfa_content()->create([
                    'name' => $request->post('name'),
                    'name_en' => $request->post('name_en'),
                    'status' => $request->post('status'),
                    'price' => $request->post('price'),
                    'image' => $filename,
                ]);
                alert()->success('وصفات', 'تمت الاضافة بنجاح');
                return redirect()->back();
            } else {
                alert()->warning('وصفات', 'لا يوجد صورة');
            }
        }
    }
    public function edit($wasfa_id, $id)
    {
        $reservation = WasfaContent::where('wasfa_id', $wasfa_id)->where('id', $id)->first();

        if ($reservation) {
            return Response::json($reservation);
        }
    }
    public function update(Request $request)
    {
        $wasfa = WasfaContent::where('id', $request->post('data_id'))->where('wasfa_id', $request->post('wasfa_id'))->first();
        if ($wasfa) {
            $validator = Validator::make($request->all(), [
                'name'         => 'required|max:35|unique:wasfas,name',
                'name_en'         => 'required|max:35|unique:wasfas,name_en',
                'status'        => 'required',
                'price'        => 'required',
            ]);
            if ($validator->fails()) {
                alert()->error('وصفات', 'هناك خطا ما');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($request->image) {
                $data['image'] = ImageClass::update($request->image, $wasfa->image, 'wasfas_content');
            }
            $data['name'] = $request->post('name');
            $data['name_en'] = $request->post('name_en');
            $data['status'] = $request->post('status');
            $data['price'] = $request->post('price');

            $wasfa->update($data);
            alert()->success('وصفات', 'تمت');
            return redirect()->back();
        }
    }
    public function destroy(Request $request)
    {
        $wasfa = WasfaContent::where('id', $request->post('id'))->first();
        if ($wasfa) {
            ImageClass::delete($wasfa->image, 'wasfas_content');
            $wasfa->delete();
            alert()->success('وصفات', 'تمت الحذف');
            return redirect()->back();
        }
    }
}
