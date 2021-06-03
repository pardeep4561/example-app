<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class SMSController extends Controller
{
    private $otp;
    function index()
    {
    }


    public function sentOtp(Request $request)
    {

        if (request()->ajax()) {

            $validator = Validator::make($request->all(), [
                'mobile_code' => 'required',
                'number' => 'required|numeric|unique:users,phone_number',
            ], [
                "mobile_code.required" => "Please enter a country code",
                "number.required" => "mobile number can't be blank",
                "number.unique" => "This number is already taken",
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => true, 'errors' => $validator->errors()]);
            }
        }

        $number = (request()->ajax()) ? $request->mobile_code . $request->number : $request->number;

        $client = new Client(config('services.twilio.sid'), config('services.twilio.token'));
        $otp = rand(1000, 9999);
        //this property not working
        $this->otp = $otp;
         //getting this by session 
         Session::flash('otp', $otp); 

        $message = $client->messages->create(
            $number,
            [
                'from' => '+1 860 264 4033', // From a valid Twilio number
                'body' => "Your OTP is " . $this->otp
            ]
        );

        if (request()->ajax()) return view('auth.register_steps.otp_sent', compact('number'));
    }


    public function verifyOtp(Request $request)
    {
         echo $request->otp." sent otp".Session::get('otp');
    }

    function test(Request $request){
        print_r($request->file('file'));
    }
}
