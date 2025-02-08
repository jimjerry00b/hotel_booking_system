<?php

namespace App\Services;

use App\Models\BookingModel;
use App\Models\RoomModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingServices
{

    function add($request)
    {

        $result = RoomModel::where('is_available' , 1)->find($request->room_id);

        $booking = BookingModel::create([
            'user_id' => Auth::user()->id,
            'room_id' => $request->room_id,
            'check_in_date' => session('check_in'),
            'check_out_date' => session('check_out'),
            'status' => 'pending',
            'total_price' => $result->price,
        ]);

        if($booking){
            $result->update(['is_available' => 0]);
            return true;
        }


        return false;


    }
}
