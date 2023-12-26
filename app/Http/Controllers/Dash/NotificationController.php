<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    //
    public function readNotifications(Request $request)
    {

        try {
            DB::table('notifications')->update(['read_at' => now()]);
            return response()->json(['data' => 'ok']);
        } catch (\Exception $ex) {
            return response()->json(['data' => $ex->getMessage()]);
        }

    }
}
