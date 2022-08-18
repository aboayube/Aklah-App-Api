<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    //
    public function index($lang)
    {
        $this->set_Language($lang);
        $wasfas = Faq::where('status', '1')->orderBy('id', 'DESC')->paginate(10);
        if ($wasfas->count() > 0) {
            return response()->json(['error' => false, 'data' => FaqResource::collection($wasfas), 'status' => 200]);
        } else {
            return response()->json(['error' => true, 'message' => 'No faqs found', 'status' => 200],);
        }
    }
}
