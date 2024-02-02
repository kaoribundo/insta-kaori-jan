<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CategoryPost extends Model
{
    use HasFactory;
    protected $table = 'category_post'; // set up connection to the table
    public $timestamps = false; //turn off timestamps
    protected $fillable = ['category_id','post_id']; //allows the columns written inside the brackets to accept data from the array

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
