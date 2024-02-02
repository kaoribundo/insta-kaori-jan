<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function follows(){
        return $this->belongsTo(User::class,'follower');
    }
    public function followee(){
        return $this->belongsTo(User::class,'following');
    }
}
