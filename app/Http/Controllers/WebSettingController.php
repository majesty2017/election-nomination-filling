<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebSettingController extends Controller
{
    public function index()
    {
        $breadcrumbs = [['link' => "/home", 'name' => "Home"], ['name' => "Web Settings"]];
        return view('content.web_settings.index', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request)
    {
        //
    }

    public function update(Request $request)
    {
        //
    }
}
