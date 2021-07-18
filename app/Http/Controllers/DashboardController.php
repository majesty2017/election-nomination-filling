<?php

namespace App\Http\Controllers;

use App\Models\NominationFilling;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Dashboard - Analytics
  public function dashboardAnalytics()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-analytics', compact('pageConfigs'));
  }

    public function store(Request $request)
    {
        if (!empty($request->id)) {
            $v = Validator::make($request->all(), [
//                'programme_id' => 'required',
                'department_id' => 'required',
                'dob' => 'required',
                'phone' => 'required',
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
            $filling->student_id = auth()->id();
            $filling->programme_id = $request->programme_id;
            $filling->department_id = $request->department_id;
            $filling->dob = $request->dob;
            $filling->father_name = $request->father_name;
            $filling->mother_name = $request->mother_name;
            $filling->address = $request->address;
            $filling->hall_name = $request->hall_name;
            $filling->denomination = $request->denomination;
            $filling->position_occupied = $request->position_occupied;
            $filling->working_experience = $request->working_experience;
            $portfolio = Payment::where('student_id', auth()->id())->first();
            $filling->portfolio_id = $portfolio->portfolio_id;
            User::where('id', auth()->id())->update(['phone' => $request->phone]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $file->move('images/profile/user-uploads', $filename);
                $filling->image = $filename;
            }
            if ($filling->update()) {
                return response()->json(['data' => $filling, 'message' => 'Changes saved successfully.']);
            }
        }

        $v = Validator::make($request->all(), [
            'programme_id' => 'required',
            'department_id' => 'required',
            'dob' => 'required',
            'phone' => 'required',
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
        $filling->student_id = auth()->id();
        $filling->programme_id = $request->programme_id;
        $filling->department_id = $request->department_id;
        $filling->dob = $request->dob;
        $filling->father_name = $request->father_name;
        $filling->mother_name = $request->mother_name;
        $filling->address = $request->address;
        $filling->hall_name = $request->hall_name;
        $filling->denomination = $request->denomination;
        $filling->position_occupied = $request->position_occupied;
        $filling->working_experience = $request->working_experience;
        $portfolio = Payment::where('student_id', auth()->id())->first();
        $filling->portfolio_id = $portfolio->portfolio_id;
        User::where('id', auth()->id())->update(['phone' => $request->phone]);

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

    public function filling()
    {
        $filling = NominationFilling::where('student_id', auth()->id())->first();
        return response()->json($filling);
    }

    public function count_payments()
    {
        $count = Payment::all()->count();
        return response()->json($count);
    }

    public function count_fillings()
    {
        $count = NominationFilling::all()->count();
        return response()->json($count);
    }

  // Dashboard - Ecommerce
  public function dashboardEcommerce()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
  }

}
