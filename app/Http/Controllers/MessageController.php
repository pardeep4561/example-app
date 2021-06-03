<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use PhpParser\Node\Stmt\TryCatch;
use Twilio\Rest\Client;

use function Ramsey\Uuid\v2;

class MessageController extends Controller
{
    function index()
    {
        $users  = User::where('id', "<>", Auth::id())->get();
        return view('messages.index', compact('users'));
    }

    function chat($id, Request $request)
    {
        $otherUser = User::find($id)->select('email', 'id')->firstOrFail();

        $client = new Client(env('TWILIO_AUTH_SID'), env('TWILIO_AUTH_TOKEN'));
        $ids = Auth::id() . "-" . $id;
        $users  = User::where('id', "<>", Auth::id())->get();
        //fetch or create new chat channel 
        try {

            $chanel = $client->chat->v2->services(env('TWILIO_SERVICE_SID'))->channels($ids)->fetch();
        } catch (\Twilio\Exceptions\RestException $e) {
            $channel = $client->chat->v2->services(env('TWILIO_SERVICE_SID'))
                ->channels
                ->create([
                    'uniqueName' => $ids,
                    'type' => 'private',
                ]);
        }

        //Add first chanel
        try {

            $client->chat->v2->services(env('TWILIO_SERVICE_SID'))
                ->channels($ids)
                ->members(auth()->user()->email)
                ->fetch();

        } catch (\Twilio\Exceptions\RestException $e) {
            $member = $client->chat->v2->services(env('TWILIO_SERVICE_SID'))
                ->channels($ids)
                ->members
                ->create(auth()->user()->email);
        }

        //Add first chanel
        try {

            $client->chat->v2->services(env('TWILIO_SERVICE_SID'))
                ->channels($ids)
                ->members($otherUser->email)
                ->fetch();

        } catch (\Twilio\Exceptions\RestException $e) {
            $member = $client->chat->v2->services(env('TWILIO_SERVICE_SID'))
                ->channels($ids)
                ->members
                ->create($otherUser->email);
        }
        return view('messages.index', compact('users'));
    }
}
