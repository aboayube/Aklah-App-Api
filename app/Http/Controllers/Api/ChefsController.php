<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChefsResource;
use App\Models\Rating;
use App\Models\User;
use App\Models\Wasfa;
use App\Models\WasfaUser;
use Illuminate\Http\Request;

class ChefsController extends Controller
{
    public function index($lang)
    {
        $this->set_Language($lang);
        $chefs = User::where('status', '1')->where('role', 'chef')->orderBy('id', 'DESC')->paginate(10);
        //   dd($chefs);
        if ($chefs->count() > 0) {
            return response()->json(['error' => false, 'data' => ChefsResource::collection($chefs), 'status' => 200]);
        } else {
            return response()->json(['error' => true, 'message' => 'No chefs found', 'status' => 200],);
        }
    }

    public function chef_wasfas($lang)
    {
        $this->language($lang);
        $wasfas = Wasfa::where('status', '1')->where('user_id', auth()->id())->withCount('wasfa_users')->get();

        if ($wasfas) {
            if ($wasfas->count() > 0) {
                return response()->json(['error' => false, 'data' => ChefsResource::collection($wasfas), 'status' => 200]);
            } else {
                return response()->json(['error' => true, 'message' => 'No wasfas found', 'status' => 200],);
            }
        }
    }
    public function dashborad($lang)
    {
        $this->language($lang);
        $wasfa_cancle = WasfaUser::where("chef_id", auth()->id())->where('status', 'cacncle')->count();
        $wasfas = Wasfa::where('user_id', auth()->id())->count();
        $wasfa_user = WasfaUser::where("chef_id", auth()->id())->where('status', 'payment')->count();
        $wasfa_rating = Rating::where("chef_id", auth()->id())->count();

        return response()->json(['error' => false, 'data' => [
            'wasfa_cancle' => $wasfa_cancle,
            'wasfas' => $wasfa_cancle,
            'wasfa_user' => $wasfa_user,
            'wasfa_rating' => $wasfa_rating,
        ], 'status' => 200],);
    }
}
