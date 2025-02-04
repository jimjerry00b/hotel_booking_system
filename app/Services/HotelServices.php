<?php

namespace App\Services;

use App\Models\HotelModel;
use Exception;

class HotelServices
{

    public function add($request)
    {
        $image = null;
        $file = $request['image'];


        if($file->isValid()) {
            $image = $this->fileUpload($file);
        }


        HotelModel::create([
            'name'          => $request['name'],
            'description'          => $request['description'],
            'location'          => $request['location'],
            'image'          => $image,
        ]);
    }

    function update($data, $hotel){

        if (isset($data['image'])) {
            $data['image'] = $this->fileUpload($data['image']);
            if (file_exists($hotel['image'])) {
                unlink($hotel['image']);
            }
        }

        $hotel->update(collect($data)->toArray());
    }

    function fileUpload($file){
        $destinationPath = 'storage/images/hotel/';
        $filename = $destinationPath . time() .".".$file->extension();
        $file->move($destinationPath, $filename);
        return $filename;
    }

    function delete($hotel)
    {
        try {
            $hotel->delete();
            if (file_exists($hotel['image'])) {
                unlink($hotel['image']);
            }
        } catch (Exception $e) {
            throw new Exception("Something was wrong.", 500);
        }
    }


}
