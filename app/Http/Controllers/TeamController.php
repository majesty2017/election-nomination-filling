<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['name' => "Teams"]];
        return view('content.teams.index', compact('breadcrumbs'));
    }

    public function teams()
    {
        $teams = Team::orderBy('id', 'DESC')->get();
        return response()->json(['data' => $teams]);
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
           'name' => 'required',
           'designation' => 'required',
           'image' => 'required|mimes:jpg,jpeg,png,svg',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $team = new Team;
        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->facebook_url = $request->facebook_url;
        $team->twitter_url = $request->twitter_url;
        $team->instagram_url = $request->instagram_url;
        $team->linkin_url = $request->flinkinurl;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('images/teams/team-uploads', $filename);
            $team->image = $filename;
        }
        if ($team->save()) {
            return response()->json(['data' => $team, 'message' => 'Team saved successfully.']);
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $team = Team::find($request->id);
        return response()->json($team);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'required',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $team = Team::find($request->id);
        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->facebook_url = $request->facebook_url;
        $team->twitter_url = $request->twitter_url;
        $team->instagram_url = $request->instagram_url;
        $team->linkin_url = $request->flinkinurl;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('images/teams/team-uploads', $filename);
            $team->image = $filename;
        }
        if ($team->update()) {
            return response()->json(['data' => $team, 'message' => 'Changes saved successfully.']);
        }
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        if ($team->delete()) {
            return response()->json(['data' => $team, 'message' => 'Team deleted successfully.']);
        }
        return false;
    }
}
