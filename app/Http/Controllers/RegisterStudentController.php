<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\WebSetting;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class RegisterStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Register
    public function showRegistrationForm()
    {
        $setting = WebSetting::all()->first();
        $pageConfigs = ['blankPage' => true];

        return view('/auth/register', compact('pageConfigs', 'setting'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $student = new User();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = bcrypt($request->password);

        if ($student->save()) {
            return redirect()->route('login')->with('info', 'Account created successful. You may now log in!');
        }
        return false;
    }
}
