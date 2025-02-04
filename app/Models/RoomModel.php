<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomModel extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'id';
    protected $guarded=[];


    public function hotel()
    {
        return $this->belongsTo(HotelModel::class, 'hotel_id', 'id');
    }
}
