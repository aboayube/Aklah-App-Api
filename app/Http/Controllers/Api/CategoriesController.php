<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CatoriesResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $this->set_Language($request->lang);
        if (auth()->check()) {
            $catoegiry = Category::where('status', '1')->where('user_id', auth()->id())->orderBy('id', 'DESC')->paginate(10);
        } else {
            $catoegiry = Category::where('status', '1')->orderBy('id', 'DESC')->paginate(10);
        }
        if ($catoegiry->count() > 0) {
            return response()->json(['error' => false, 'data' => CatoriesResource::collection($catoegiry), 'status' => 200]);
        } else {
            return response()->json(['error' => true, 'message' => 'No Posts found', 'status' => 200],);
        }
    }
    //
}
