<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ImageClass;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChefsResource;
use App\Http\Resources\WasfaContentResource;
use App\Http\Resources\WasfaResource;
use App\Http\Resources\WasfaUserResource;
use App\Models\Wasfa;
use App\Models\WasfaContent;
use App\Models\WasfaUser;
use App\Models\WasfaUserContent;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class wasfasController extends Controller
{
    public function index($lang)
    {
        $this->set_Language($lang);
        $wasfas = Wasfa::where('status', '1')->orderBy('id', 'DESC')->paginate(10);
        if ($wasfas->count() > 0) {
            return response()->json(['error' => false, 'data' => WasfaResource::collection($wasfas), 'status' => 200]);
        } else {
            return response()->json(['error' => true, 'message' => 'No wasfas found', 'status' => 200],);
        }
    }

    public function show($lang, $id)
    {
        $this->set_Language($lang);

        $wasfa = Wasfa::where('status', '1')->with('wasfa_content')->where('id', $id)->first();


        if ($wasfa) {
            return response()->json(['errors' => true, 'message' => "wasfa cotnent created", 'data' => new WasfaResource($wasfa), 'status' => 200], 200);
        } else {
            return response()->json(['errors' => true, 'message' => "return data error", 'status' => 404], 404);
        }
    }
    public function show_content($lang, $id)
    {
        $this->set_Language($lang);
        $wasfas = WasfaContent::where('wasfa_id', $id)->where('status', '1')->paginate(10);
        if ($wasfas) {
            return response()->json(['errors' => true, 'message' => "wasfa cotnent created", 'data' =>  WasfaContentResource::collection($wasfas), 'status' => 200], 200);
        } else {
            return response()->json(['errors' => true, 'message' => "return data error", 'status' => 404], 404);
        }
    }

    public function store(Request $request, $lang, $id)
    {

        $validator = Validator::make($request->all(), [
            'countity' => 'required',
            'price'        => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => true, 'message' => $validator->errors()], 200);
        }

        $this->set_Language($lang);
        $wasfa = Wasfa::where('id', $id)->where('status', '1')->first();
        if ($wasfa) {
            $note = null;
            $note_en = null;

            if ($this->language() == 'ar') {
                $note = $request->note;
            } else {
                $note_en = $request->note;
            }
            $wsafauser = WasfaUser::create([
                'wasfa_id' => $id,
                'user_id' => auth()->id(),
                'chef_id' => $wasfa->user_id,
                'note' => $note,
                'note_en' => $note_en,
                'countity' => $request->countity,
                'price' => $request->price,
                'status' => 'card',
            ]);
            foreach ($request->wasfa_content as $key => $wasfacontent) {

                $arr = explode(',', $wasfacontent);

                $wsafaContent = WasfaUserContent::create([
                    'user_id' => auth()->id(),
                    'wasfa_id' => $id,
                    'wasfa_contents_id' => $arr[0],
                    'contity' => $arr[1],
                ]);
            }
            if ($wsafauser) {
                return response()->json(['errors' => false, 'message' => new WasfaUserResource($wsafauser), 'status' => 201]);
            } else {
                return response()->json(['errors' => true, 'message' => "return data error", 'status' => 404]);
            }
        } else {
            return response()->json(['errors' => true, 'message' => "return data error", 'status' => 404], 404);
        }
    }
    //

    public function update_status(Request $request, $lang)
    {
        $this->set_Language($lang);

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => true, 'message' => $validator->errors()], 200);
        }
        $wasfa = WasfaUser::where('id', $request->id)->where('user_id', auth()->id())->first();
        if ($wasfa) {
            $wasfa->update(['status' => $request->status]);

            return response()->json(['errors' => false, 'message' => new WasfaUserResource($wasfa), 'status' => 201]);
        } else {
            return response()->json(['errors' => true, 'message' => "return data error", 'status' => 404]);
        }
    }
    public function addwasfa(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name_en'        => 'required',
            'category_id' => 'required',
            'discription'        => 'required',
            'discription_en'        => 'required',
            'image'        => 'required',
            'price'        => 'required',
            'time_make'        => 'required',
            'number_user'        => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => true, 'message' => $validator->errors()], 200);
        }
        $filename = ImageClass::create($request->image, 'wasfas');
        $wasfa = Wasfa::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'name_en' => $request->name_en,
            'discription' => $request->discription,
            'discription_en' => $request->discription_en,
            'image' => $filename,
            'price' => $request->price,
            'time_make' => $request->time_make,
            'number_user' => $request->number_user,
            'status' => '1',
            'category_id' => $request->category_id
        ]);
        if ($request->wasfa_content) {
            foreach ($request->wasfa_content as $key => $wasfacontent) {

                $arr = explode(',', $wasfacontent);


                
                //   $filename = ImageClass::create($arr, 'wasfas');

                $wsafaContent = WasfaContent::create([
                    'user_id' => auth()->id(),
                    'wasfa_id' => $wasfa->id,
                    'name' => $arr[0],
                    'name_en' => $arr[1],
                    'price' => $arr[2],
                    'status' => $arr[3],
                    'image' => "profile.png",
                ]);
            }
        }

        dd('yes');
    }
}
