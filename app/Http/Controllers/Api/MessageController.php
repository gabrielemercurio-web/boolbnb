<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Message;

class MessageController extends Controller
{
    public function index($id) {
        $messages = DB::table('messages')
            ->join('houses', 'houses.id', '=', 'messages.house_id')
            ->where('messages.house_id', '=', $id)
            ->orderBy('messages.created_at', 'DESC')
            ->get();

        return response()->json([
            'success' => true,
            'count' => $messages->count(),
            'data' => $messages,
        ]);
    }
}
