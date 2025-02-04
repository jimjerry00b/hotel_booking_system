<?php

namespace App\Services;

use App\Models\RoomModel;
use Exception;

class RoomServices
{
    function add($request){
        RoomModel::create([
            'hotel_id' => $request['hotel_id'],
            'room_number' => $request['room_number'],
            'type' => $request['type'],
            'price' => $request['price'],
            'capacity' => $request['capacity']
        ]);

    }

    function update($data, $room){
        $room->update(collect($data)->toArray());
    }

    function delete($room){
        try {
            $room->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }
}
