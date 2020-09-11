<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Hit;

class HitController extends Controller
{
    public function index($id) {
        $hits = DB::table('hits')
            ->join('houses', 'houses.id', '=', 'hits.house_id')
            ->where('hits.house_id', '=', $id)
            ->orderBy('hits.created_at', 'DESC')
            ->get();

        return response()->json([
            'success' => true,
            'count' => $hits->count(),
            'data' => $hits,
        ]);
    }
}
