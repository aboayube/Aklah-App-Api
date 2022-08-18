<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    function __construct()
    {
        /*   $this->middleware('permission:faq-index', ['only' => ['index']]);
        $this->middleware('permission:faq-store', ['only' => ['store']]);
        $this->middleware('permission:faq-edit', ['only' => ['edit']]);
        $this->middleware('permission:faq-update', ['only' => ['update']]);
        $this->middleware('permission:faq-delete', ['only' => ['destroy']]);
 */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderBy('id', 'DESC')->paginate(10);
        return view(
            'admin.faq',
            compact(
                'faqs',
            )
        );
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
            'title' => 'required|unique:faqs,title|max:50',
            'title_en' => 'required|unique:faqs,title_en|max:50',
            'body' => 'required',
            'body_en' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('اسئلة الشائعة', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $faq =  Faq::create([
            'title' => $request->post('title'),
            'title_en' => $request->post('title_en'),
            'body' => Purify::clean($request->post('body')),
            'body_en' => Purify::clean($request->post('body_en')),
            'user_id' => auth()->id(),
            'status' => $request->post('status'),
        ]);
        alert()->success('اسئلة شائعة', 'تم اضافة تصنيف بنجاح');
        return redirect()->route('admin.faq.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = Faq::where('id', $id)->first();
        if ($faq) {

            return Response::json($faq);
        }
        return false;
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {       //   
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
            'title_en' => 'required|max:50',
            'body' => 'required',
            'body_en' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('اسئلة شائعة', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $faq = Faq::where('id', $request->id)->first();

        if (!$faq) {
            alert()->error('اسئلة شائعة', 'هناك خطا ما');
        } else {
            $data['title'] = $request->post('title');
            $data['title_en'] = $request->post('title_en');
            $data['body'] = $request->post('body');
            $data['body_en'] = $request->post('body_en');
            $data['status'] = $request->post('status');

            $faq->update($data);
            alert()->success('اسئلة شائعة', 'تم تعديل اسئلة شائعة بنجاح');
            return redirect()->route('admin.faq.index');
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
        $faq = Faq::where('id', $request->post('id'))->first();
        if ($faq) {
            $faq->delete();
            alert()->warning('اسئلة شائعة', 'تم حذف سؤال بنجاح');
            return redirect()->route('admin.faq.index');
        } else {
            alert()->error('اسئلة الشائعة', 'هناك خطا ما');
            return false;
        }
    }
}
