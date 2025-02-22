<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRouteModel extends Model
{
    protected $table = 'permission_router';
    protected $primaryKey = 'id';
    protected $guarded =[];


    public function permission(){
        return $this->belongsTo(Permission::class);
    }
}
