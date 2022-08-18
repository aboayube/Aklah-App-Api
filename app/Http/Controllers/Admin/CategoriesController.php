<?php

namespace App\Http\Controllers\Admin;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Wasfa;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use  App\Helpers\ImageClass;
use App\Models\User;

class CategoriesController extends Controller
{
    function __construct()
    {
        /*    $this->middleware('permission:category-index', ['only' => ['index']]);
        $this->middleware('permission:category-store', ['only' => ['store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit']]);
        $this->middleware('permission:category-update', ['only' => ['update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    */
    }
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->with(['user'])->paginate(6);
        return view(
            'admin.categories',
            compact(
                'categories',
            )
        );
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name|max:50',
            'name' => 'required|unique:categories,name_en|max:50',
            'image' => 'required'
        ]);
        if ($validator->fails()) {
            alert()->error('اقسام', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->image) {
            $filename = ImageClass::create($request->image, 'categories');
            $category = Category::create([
                'name' => $request->post('name'),
                'name_en' => $request->post('name_en'),
                'status' => $request->post('status'),
                'user_id' => auth()->user()->id,
                'image' => $filename,
            ]);
            alert()->success('اقسام', 'تم اضافة قسم بنجاح');
            return redirect()->route('admin.categories.index');
        }
    }
    public function edit($id)
    {
        $cat = Category::where('id', $id)->first();
        if ($cat) {
            return Response::json($cat);
        }
        return false;
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name_en' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('اقسام', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $cat = Category::where('id', $request->post('cat_id'))->first();

        if (!$cat) {
            alert()->error('اقسام', 'هناك خطا ما');
        } else {
            if ($request->image) {
                $data['image'] =   ImageClass::update($request->image, $cat->image, 'categories');
            }

            $data['name'] = $request->post('name');
            $data['name_en'] = $request->post('name_en');
            $data['status'] = $request->post('status');
            $cat->update($data);
            alert()->success('اقسام', 'تم اضافة قسم بنجاح');
            return redirect()->route('admin.categories.index');
        }
    }
    public function destroy(Request $request)
    {
        $cat = Category::where('id', $request->id)->first();
        if ($cat) {
            ImageClass::delete($cat->image, 'categories');
          /*   $post = Wasfa::where('category_id', $request->id)->first();
            if ($post) {
                alert()->warning('تصنيف', 'هناك مقالات يجيب حذفها بالاول لانها مرتبطه بقسم');
                return redirect()->back();
            } */
            $cat->delete();
            alert()->warning('اقسام', 'تم حذف القسم بنجاح');

            return redirect()->route('admin.categories.index');
        } else {
            alert()->error('اقسام', 'هناك خطا ما');
            return false;
        }
    }
}
