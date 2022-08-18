<?php

namespace App\Http\Controllers;

use App\Models\Wasfa;
use App\Models\WasfaUserContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WasfaController extends Controller
{
    public function index()
    {

        $wasfas = Wasfa::where('status', '1')->with([
            'user',
            'category'
        ])->get();


        return view('wasfas.index', compact('wasfas'));
    }

    public function show($id)
    {


        $wasfa = Wasfa::where('status', '1')->with(['user', 'category', 'wasfa_content'])->where('id', $id)->first();

        if ($wasfa) {
            return view('wasfas.show', compact('wasfa'));
        }
    }
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'wasfa_id' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => true, 'message' => $validation->errors(), 'status' => 500], 500);
        }
        $wasfa = Wasfa::where('id', $request->wasfa_id)->first();
        $data['chef_id'] = $wasfa->user->id;
        $data['countity'] = $request->post('countity');
        $data['user_id'] = auth()->id();
        $data['status'] = 'card';
        if ($this->language() == 'ar') {
            $data['note'] = $request->post('notes');
        } else {
            $data['note_en'] = $request->post('notes');
        }
        if ($wasfa) {

            $wasfa->wasfa_users()->create($data);

            foreach ($request->content as $con) {
                WasfaUserContent::create([
                    'user_id' => auth()->id(),
                    'wasfa_contents_id' => $con,
                    'wasfa_id' => $wasfa->id,
                    'contity' => $request->post('countity'),

                ]);
            }
            return redirect()->route('card.index');
        }
    }
    //
}
