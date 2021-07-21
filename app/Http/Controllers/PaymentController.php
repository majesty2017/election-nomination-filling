<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Portfolio;
use App\Models\User;
use App\Models\WebSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Paystack;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $setting = WebSetting::all()->first();
        $breadcrumbs = [['link' => "/home", 'name' => "Home"], ['name' => "Payments"]];
        return view('content.payments.index', compact('breadcrumbs', 'setting'));
    }

    public function payments(): \Illuminate\Http\JsonResponse
    {
        $payments = Payment::orderBy('id', 'DESC')
            ->with(['user', 'portfolio'])
            ->where('refund', 0)
            ->get();
        return response()->json(['data' => $payments]);
    }

    public function applicants(): \Illuminate\Http\JsonResponse
    {
        $applicants = User::all()->where('is_admin', 0);
        return response()->json($applicants);
    }

    public function portfolios(): \Illuminate\Http\JsonResponse
    {
        $portfolios = Portfolio::all();
        return response()->json($portfolios);
    }

    public function portfolio(Request $request): \Illuminate\Http\JsonResponse
    {
        $portfolios = Portfolio::find($request->id);
        return response()->json($portfolios);
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
           'student_id' => 'required',
           'portfolio_id' => 'required',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $string = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        $payment = new Payment;
        $payment->student_id = $request->student_id;
        $payment->portfolio_id = $request->portfolio_id;
        $payment->amount = $request->amount;
        $payment->payment_mode = 'Cash';
        $payment->reference_id = substr(str_shuffle($string), 0, 25);
        User::where('id', $request->student_id)->update([
           'payment_status' => 1
        ]);
        if ($payment->save()) {
            return response()->json(['data' => $payment, 'message' => 'Payment saved successfully.']);
        }
        return false;
    }

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }
    }

    /**
     * Obtain Paystack payment information
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

//        dd($paymentDetails['data']);

        $payment = new Payment();
        $payment->student_id = auth()->id();
        $payment->portfolio_id = $paymentDetails['data']['metadata'];
        $payment->amount = $paymentDetails['data']['amount'] / 100;
        $payment->payment_mode = str_replace('_', ' ', ucwords($paymentDetails['data']['channel']));
        $payment->reference_id = $paymentDetails['data']['reference'];
        User::where('id', auth()->id())->update([
            'payment_status' => 1
        ]);
        if ($payment->save()) {
            return redirect()->route('home')->with(['success' => 'Payment made successfully. You can now fill you nomination form.']);
        }
        return false;
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $payment = Payment::with(['user', 'portfolio'])->find($request->id);
        return response()->json($payment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $v = Validator::make($request->all(), [
            'student_id' => 'required',
            'portfolio_id' => 'required',
        ]);
        if ($v->fails()) {
            return response()->json(['status' => 'fail', 'error' => $v->errors()]);
        }
        $payment = Payment::find($request->id);
        $payment->student_id = $request->student_id;
        $payment->portfolio_id = $request->portfolio_id;
        $payment->amount = $request->amount;
        $payment->payment_mode = 'Cash';
        $payment->reference_id = substr(str_shuffle('1234567890'), 0, 8);
        if ($payment->update()) {
            return response()->json(['data' => $payment, 'message' => 'Changes saved successfully.']);
        }
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function refund(Request $request)
    {
        $payment = Payment::find($request->id);
        $payment->refund = 1;
        if ($payment->update()) {
            return response()->json(['data' => $payment, 'message' => 'Payment has been refunded successfully.']);
        }
        return false;
    }
}
