<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('defaults.content.index');
    }



    public function teams()
    {
        $teams = Team::orderBy('id', 'ASC')->get();
        return response()->json(['data' => $teams]);
    }

    public function contact()
    {
        return view('defaults.content.contact');
    }

    public function about()
    {
        return view('defaults.content.about');
    }

    public function portfolio()
    {
        return view('defaults.content.portfolio');
    }

    public function team()
    {
        return view('defaults.content.team');
    }

    public function service()
    {
        return view('defaults.content.service');
    }

    public function history()
    {
        return view('defaults.content.history');
    }
}
