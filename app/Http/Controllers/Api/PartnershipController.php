<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partnership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PartnershipController extends Controller
{
    public function form($type) {
        return response()->json([
            'fields' => config('partnership_field')[$type]
        ]);
    }
    public function submit(Request $request) {
        $user = User::where('token', $request->token)->first();

        $saveData = Partnership::create([
            'user_id' => $user->id,
            'type' => $request->type,
            'record' => json_encode($request->record),
        ]);

        return response()->json([
            'ok'
        ]);
    }
}
