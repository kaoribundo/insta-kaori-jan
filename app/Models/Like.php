<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $table = 'likes'; // set up connection to the table
    public $timestamps = false; //turn off timestamps
    protected $fillable = ['post_id','user_id']; //allows the columns written inside the brackets to accept data from the array

    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
