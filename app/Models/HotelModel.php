<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelModel extends Model
{
    protected $table = 'hotels';
    protected $primaryKey = 'id';
    protected $guarded=[];
}
