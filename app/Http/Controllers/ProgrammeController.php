<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('content.programmes.index');
    }

    public function programmes(): \Illuminate\Http\JsonResponse
    {
        $programmes = Programme::orderBy('id', 'DESC')->get();
        return response()->json(['data' => $programmes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $programme = new Programme;
        $programme->programme_id = substr(str_shuffle('1234567890qwertyuiopasdfghjklzxcvbnm'), 0, 8);
        $programme->name = $request->name;
        if ($programme->save()) {
            return response()->json(['data' => $programme, 'message' => 'Programme saved successfully']);
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $programme = Programme::find($request->id);
        return response()->json($programme);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function edit(Programme $programme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $programme = Programme::find($request->id);
        $programme->programme_id = substr(str_shuffle('1234567890qwertyuiopasdfghjklzxcvbnm'), 0, 8);
        $programme->name = $request->name;
        if ($programme->update()) {
            return response()->json(['data' => $programme, 'message' => 'Changes saved successfully']);
        }
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $programme = Programme::find($id);
        if ($programme->delete()) {
            return response()->json(['data' => $programme, 'message' => 'Programme deleted successfully']);
        }
        return false;
    }
}
