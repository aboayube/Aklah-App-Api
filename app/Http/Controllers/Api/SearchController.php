<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CatoriesResource;
use App\Http\Resources\WasfaResource;
use App\Models\Category;
use App\Models\Wasfa;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function search(Request $request, $lang, $word, $type)
    {
        $this->language($lang);
        if ($type == 'categories') {
            $cats = Category::where('name', 'like', '%' . $word . '%')->orWhere('name_en', 'like', '%' . $word . '%')->paginate(15);
            if ($cats) {
                return response()->json(['error' => false, 'data' => CatoriesResource::collection($cats), 'status' => 200]);
            }
        } else if ($type == 'price') {
            $lowerPrice = "";
            $highPrice = '';
            if ($request->lowerPrice) {

                $wasfa = Wasfa::where('status', '1')->orderby('price', 'ASC')->paginate(15);
            } else if ($request->highPrice) {
                $wasfa = Wasfa::where('status', '1')->orderby('price', 'DESC')->paginate(15);
            }

            if ($wasfa) {
                return response()->json(['error' => false, 'data' => WasfaResource::collection($wasfa), 'status' => 200]);
            } else {
                return response()->json(['error' => false, 'data' => 'no there data', 'status' => 200]);
            }
        }
    }
}
