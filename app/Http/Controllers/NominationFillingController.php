<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\NominationFilling;
use App\Models\Payment;
use App\Models\Programme;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NominationFillingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/home", 'name' => "Home"], ['name' => "Nomination Fillings"]];
        return view('content.fillings.index', compact('breadcrumbs'));
    }

    public function fillings()
    {
        $fillings = NominationFilling::orderBy('id', 'DESC')
            ->with(['user', 'portfolio', 'programme', 'department'])
            ->get();
        return response()->json(['data' => $fillings]);
    }

    public function programmes()
    {
        $programmes = Programme::orderBy('name', 'asc')->get();
        return response()->json($programmes);
    }

    public function departments()
    {
        $departments = Department::orderBy('name', 'asc')->get();
        return response()->json($departments);
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
           'applicant_id' => 'required',
           'programme_id' => 'required',
            'department_id' => 'required',
            'portfolio_id' => 'required',
            'dob' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,svg',
            'father_name' => 'required',
            'mother_name' => 'required',
            'address' => 'required',
            'hall_name' => 'required',
            'denomination' => 'required',
            'position_occupied' => 'required',
            'working_experience' => 'required',
        ]);

        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $filling = new NominationFilling;
        $filling->student_id = $request->applicant_id;
        $filling->programme_id = $request->programme_id;
        $filling->portfolio_id = $request->portfolio_id;
        $filling->department_id = $request->department_id;
        $filling->dob = $request->dob;
        $filling->father_name = $request->father_name;
        $filling->mother_name = $request->mother_name;
        $filling->address = $request->address;
        $filling->hall_name = $request->hall_name;
        $filling->denomination = $request->denomination;
        $filling->position_occupied = $request->position_occupied;
        $filling->working_experience = $request->working_experience;

        if (auth()->user()->is_admin === 0) {
            $portfolio = Payment::where('student_id', auth()->id())->first();
            $filling->portfolio_id = $portfolio->portfolio_id;
            User::where('id', auth()->id())->update(['phone' => $request->phone]);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('images/profile/user-uploads', $filename);
            $filling->image = $filename;
        }
        if ($filling->save()) {
            return response()->json(['data' => $filling, 'message' => 'Nomination filling saved successfully.']);
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NominationFilling  $nominationFilling
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $filling = NominationFilling::with(['user', 'portfolio', 'programme', 'department'])
            ->find($request->id);
        return response()->json($filling);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NominationFilling  $nominationFilling
     * @return \Illuminate\Http\Response
     */
    public function edit(NominationFilling $nominationFilling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NominationFilling  $nominationFilling
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {

        $v = Validator::make($request->all(), [
            'applicant_id' => 'required',
            'programme_id' => 'required',
            'department_id' => 'required',
            'portfolio_id' => 'required',
            'dob' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'address' => 'required',
            'hall_name' => 'required',
            'denomination' => 'required',
            'position_occupied' => 'required',
            'working_experience' => 'required',
        ]);

        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $filling = NominationFilling::find($request->id);
        $filling->student_id = $request->applicant_id;
        $filling->programme_id = $request->programme_id;
        $filling->portfolio_id = $request->portfolio_id;
        $filling->department_id = $request->department_id;
        $filling->dob = $request->dob;
        $filling->father_name = $request->father_name;
        $filling->mother_name = $request->mother_name;
        $filling->address = $request->address;
        $filling->hall_name = $request->hall_name;
        $filling->denomination = $request->denomination;
        $filling->position_occupied = $request->position_occupied;
        $filling->working_experience = $request->working_experience;

        if ($request->hasFile('image')) {
            $v = Validator::make($request->all(), [
                'image' => 'required|mimes:jpg,jpeg,png,svg',
            ]);

            if ($v->fails()) {
                return response()->json(['status' => 'fail', 'error' => $v->errors()]);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('images/profile/user-uploads', $filename);
            $filling->image = $filename;
        }
        if ($filling->save()) {
            return response()->json(['data' => $filling, 'message' => 'Changes saved successfully.']);
        }
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NominationFilling  $nominationFilling
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $filling = NominationFilling::find($request->id);
        if ($filling->delete()) {
            return response()->json(['data' => $filling, 'message' => 'Nomination filling deleted successfully.']);
        }
        return false;
    }
}
