<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Notifications\Message as NotificationsMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:10|string',
            "email" => "required|email",
            "number" => "required|min:10",
            "message" => "required|min:50"
        ]);
        if ($validator->fails()) {
            return redirect("/#contact")->withErrors($validator);
        }
        $message = Message::create($request->all());

        $admins = User::all()->where("user_type", "admin");
        Notification::send($admins, new NotificationsMessage($message->name));

        return redirect()->back()->with("message", "Thanks for your message we will reply on neerly");
    }
    public function show()
    {
        return view("admin.message", ["messages" => Message::all()]);
    }
}
