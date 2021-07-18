<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{

  // Account Settings
  public function account_settings()
  {
    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['name' => "Account Settings"]];
    return view('/content/pages/page-account-settings', ['breadcrumbs' => $breadcrumbs]);
  }

    public function profile_image(Request $request)
    {
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $filename = time().'.'.'jpg';
        $file->move('images/profile/user-uploads', $filename);
        $account = User::find(auth()->id());
        $account->image = $filename;
        if ($account->update()) {
            return response()->json(['status' => 1, 'msg' => 'Profile image saved successfully.']);
        }
        return false;
    }

  // Profile
  public function profile()
  {
    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Profile"]];

    return view('/content/pages/page-profile', ['breadcrumbs' => $breadcrumbs]);
  }

    public function update_profile(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $user = User::find(auth()->id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($user->update()) {
            return response()->json(['data' => $user, 'message' => 'Changes saved successfully.']);
        }
        return false;
    }

    public function update_password(Request $request)
    {
        $v = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $user = User::find(auth()->id());
        $user->password = bcrypt($request->password);
        if ($user->update()) {
            return response()->json(['data' => $user, 'message' => 'Password saved successfully.']);
        }
        return false;
    }

  // FAQ
  public function faq()
  {
    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "FAQ"]];
    return view('/content/pages/page-faq', ['breadcrumbs' => $breadcrumbs]);
  }

  // Knowledge Base
  public function knowledge_base()
  {
    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Knowledge Base"]];
    return view('/content/pages/page-knowledge-base', ['breadcrumbs' => $breadcrumbs]);
  }

  // Knowledge Base Category
  public function kb_category()
  {
    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "/page/knowledge-base", 'name' => "Knowledge Base"], ['name' => "Category"]];
    return view('/content/pages/page-kb-category', ['breadcrumbs' => $breadcrumbs]);
  }

  // Knowledge Base Question
  public function kb_question()
  {
    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "/page/knowledge-base", 'name' => "Knowledge Base"], ['link' => "/page/kb-category", 'name' => "Category"], ['name' => "Question"]];
    return view('/content/pages/page-kb-question', ['breadcrumbs' => $breadcrumbs]);
  }

  // pricing
  public function pricing()
  {
    $pageConfigs = ['pageHeader' => false];
    return view('/content/pages/page-pricing', ['pageConfigs' => $pageConfigs]);
  }

  // blog list
  public function blog_list()
  {
    $pageConfigs = ['contentLayout' => 'content-detached-right-sidebar', 'bodyClass' => 'content-detached-right-sidebar'];

    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "javascript:void(0)", 'name' => "Blog"], ['name' => "List"]];

    return view('/content/pages/page-blog-list', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs]);
  }

  // blog detail
  public function blog_detail()
  {
    $pageConfigs = ['contentLayout' => 'content-detached-right-sidebar', 'bodyClass' => 'content-detached-right-sidebar'];

    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "javascript:void(0)", 'name' => "Blog"], ['name' => "Detail"]];

    return view('/content/pages/page-blog-detail', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs]);
  }

  // blog edit
  public function blog_edit()
  {

    $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['link' => "javascript:void(0)", 'name' => "Blog"], ['name' => "Edit"]];

    return view('/content/pages/page-blog-edit', ['breadcrumbs' => $breadcrumbs]);
  }
}
