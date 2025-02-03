<?php

namespace App\Services;

use App\Models\HotelModel;

class HotelServices
{

    public function add($request)
    {


        $image = $request['image'];
        $extension = $image->getClientOriginalExtension();

        $path = $image->storeAs('hotel_images', time()."." . $extension, 'public');
        HotelModel::create([
            'name'          => $request['name'],
            'description'          => $request['description'],
            'location'          => $request['location'],
            'image'          => $path,
        ]);
    }
}
