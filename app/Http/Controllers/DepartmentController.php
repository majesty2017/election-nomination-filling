<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
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
        $breadcrumbs = [['link' => "/home", 'name' => "Home"], ['name' => "Departments List"]];
        return view('content.departments.index', compact('breadcrumbs'));
    }

    public function departments()
    {
        $departments = Department::orderBy('id', 'DESC')->get();
        return response()->json(['data' => $departments]);
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
     * @return false
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
           'name' => 'required|string|unique:departments|max:255',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $department = new Department;
        $department->department_id = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 8);
        $department->name = $request->name;
        if ($department->save()) {
            return response()->json(['data' => $department, 'message' => 'Department saved successfully.'], 201);
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $department): \Illuminate\Http\JsonResponse
    {
        $department = Department::find($department->id);
        return response()->json($department);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $department = Department::find($request->id);
        $department->name = $request->name;
        if ($department->update()) {
            return response()->json(['data' => $department, 'message' => 'Department saved successfully.']);
        }
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        if ($department->delete()) {
            return response()->json(['data' => $department, 'message' => 'Department saved successfully.']);
        }
        return false;
    }
}
