<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\WebSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
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
        $setting = WebSetting::all()->first();
        $breadcrumbs = [['link' => "/home", 'name' => "Home"], ['name' => "Portfolios"]];
        return view('content.portfolios.index', compact('breadcrumbs', 'setting'));
    }

    public function portfolios(): \Illuminate\Http\JsonResponse
    {
        $portfolios = Portfolio::orderBy('id', 'DESC')->get();
        return response()->json(['data' => $portfolios]);
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
           'name' => 'required|string|max:255',
           'amount' => 'required|numeric'
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $portfolio = new Portfolio;
        $portfolio->portfolio_id = substr(str_shuffle('1234567890qwertyuiopasdfghjklzxcvbnm'), 0, 8);
        $portfolio->name = $request->name;
        $portfolio->amount = $request->amount;
        if ($portfolio->save()) {
            return response()->json(['data' => $portfolio, 'message' => 'Portfolio saved successfully']);
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request): \Illuminate\Http\JsonResponse
    {
        $portfolio = Portfolio::find($request->id);
        return response()->json($portfolio);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $portfolio = Portfolio::find($request->id);
        $portfolio->portfolio_id = substr(str_shuffle('1234567890qwertyuiopasdfghjklzxcvbnm'), 0, 8);
        $portfolio->name = $request->name;
        $portfolio->amount = $request->amount;
        if ($portfolio->update()) {
            return response()->json(['data' => $portfolio, 'message' => 'Changes saved successfully']);
        }
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::find($id);
        if ($portfolio->delete()) {
            return response()->json(['data' => $portfolio, 'message' => 'Portfolio deleted successfully']);
        }
        return false;
    }
}
