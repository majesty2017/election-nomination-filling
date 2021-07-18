<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('content.users.index');
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:10',
            'email' => 'required|email|unique:users|max:255',
            'is_admin' => 'required',
            'password' => 'required|string|min:8|same:password_confirmation',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $user = new User;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->is_admin = $request->is_admin;
        $user->password = bcrypt($request->password);
        if ($request->hasFile('image')) {
            $v = Validator::make($request->all(), [
                'image' => 'required|mimes:jpg,png,svg,jpeg'
            ]);
            if ($v->fails()) {
                return response()->json(['status' => 'fail', 'error' => $v->errors()]);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('images/profile/user-uploads', $filename);
            $user->image = $filename;
        }
        if ($user->save()) {
            return response()->json(['data' => $user, 'message' => 'Record saved successfully.']);
        }
        return false;
    }

    public function users(): \Illuminate\Http\JsonResponse
    {
        $users = User::orderBy('id', 'DESC')->where('is_admin', 1)->get();
        return response()->json(['data' => $users]);
    }

    public function show(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::find($request->id);
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:10',
            'email' => 'required|email|max:255',
            'is_admin' => 'required',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->is_admin = $request->is_admin;
        if (!empty($request->password)) {
            $v = Validator::make($request->all(), [
                'password' => 'required|string|min:8',
            ]);
            if ($v->fails()) {
                return response()->json(['status' => 'fail', 'error' => $v->errors()]);
            }
            $user->password = bcrypt($request->password);
        }
        if ($request->hasFile('image')) {
            $v = Validator::make($request->all(), [
                'image' => 'required|mimes:jpg,png,svg,jpeg'
            ]);
            if ($v->fails()) {
                return response()->json(['status' => 'fail', 'error' => $v->errors()]);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('images/profile/user-uploads', $filename);
            $user->image = $filename;
        }
        if ($user->update()) {
            return response()->json(['data' => $user, 'message' => 'Changes saved successfully.']);
        }
        return false;
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            return response()->json(['data' => $user, 'message' => 'User deleted successfully.']);
        }
        return false;
    }
}
