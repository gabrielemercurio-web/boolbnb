<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        // Get messages sent to logged on user
        $messages = DB::table('messages')
            ->join('houses', 'houses.id', '=', 'messages.house_id')
            ->where('houses.user_id', '=', Auth::user()->id)
            ->orderBy('messages.created_at', 'DESC')
            ->get();

        return view('upr.messages.index', compact('messages'));
    }
}
