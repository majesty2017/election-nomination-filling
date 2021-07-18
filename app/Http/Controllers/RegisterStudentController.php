<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
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
        $pageConfigs = ['blankPage' => true];

        return view('/auth/register', [
            'pageConfigs' => $pageConfigs
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
//            'student_id' => 'required|string|max:255',
//            'phone' => 'required|string|min:10|max:12',
            'email' => 'required|email|unique:students|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $student = new User();
        $student->name = $request->name;
//        $student->student_id = $request->student_id;
//        $student->phone = $request->phone;
        $student->email = $request->email;
        $student->password = bcrypt($request->password);

        if ($student->save()) {
            return redirect()->route('login');
        }
        return false;
    }
}
