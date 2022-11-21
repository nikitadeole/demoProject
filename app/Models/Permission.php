<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function roles() {
        $this->belongsToMany('App\Models\Role');
    }

    public function users() {
        $this->belongsToMany('App\Models\User');
    }

}
