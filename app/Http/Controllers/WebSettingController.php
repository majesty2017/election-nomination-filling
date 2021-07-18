<?php

namespace App\Http\Controllers;

use App\Models\WebSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebSettingController extends Controller
{
    public function index()
    {
        $setting = WebSetting::all()->first();
        $breadcrumbs = [['link' => "/home", 'name' => "Home"], ['name' => "Web Settings"]];
        return view('content.web_settings.index', compact('breadcrumbs', 'setting'));
    }

    public function settings()
    {
        $settings = WebSetting::all()->first();
        return response()->json($settings);
    }

    public function store(Request $request)
    {
        if (!empty($request->id)) {
            $v = Validator::make($request->all(), [
                'short_name' => 'required|string|max:50',
                'system_name' => 'required|string|max:255',
                'copyright' => 'required|string|max:255',
            ]);
            if ($v->fails()) {
                return response()->json(['status' => 'fail', 'error' => $v->errors()]);
            }
            $web_setting = WebSetting::find($request->id);
            $web_setting->system_name = $request->system_name;
            $web_setting->short_name = $request->short_name;
            $web_setting->copyright = $request->copyright;
            $web_setting->website = $request->website;

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $file->move('images/web-settings/logos', $filename);
                $web_setting->logo = $filename;
            }

            if ($request->hasFile('favicon')) {
                $iconfile = $request->file('favicon');
                $iconfilename = time().'.ico';
                $iconfile->move('images/web-settings/favicons', $iconfilename);
                $web_setting->favicon = $iconfilename;
            }

            if ($web_setting->update()) {
                return response()->json(['data' => $web_setting, 'message' => 'Web settings saved successfully']);
            }
        }
        $v = Validator::make($request->all(), [
           'logo' => 'required|mimes:png,jpeg,jpg,svg',
           'favicon' => 'required|mimes:png,jpeg,jpg,svg,ico',
           'system_name' => 'required|string|max:255',
            'short_name' => 'required|string|max:50',
           'copyright' => 'required|string|max:255',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $web_setting = new WebSetting;
        $web_setting->system_name = $request->system_name;
        $web_setting->short_name = $request->short_name;
        $web_setting->copyright = $request->copyright;
        $web_setting->website = $request->website;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('images/web-settings/logos', $filename);
            $web_setting->logo = $filename;
        }

        if ($request->hasFile('favicon')) {
            $iconfile = $request->file('favicon');
            $iconfilename = time().'.ico';
            $iconfile->move('images/web-settings/favicons', $iconfilename);
            $web_setting->favicon = $iconfilename;
        }

        if ($web_setting->save()) {
            return response()->json(['data' => $web_setting, 'message' => 'Web settings saved successfully']);
        }
        return false;
    }
}
