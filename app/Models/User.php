<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }
}
