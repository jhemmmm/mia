<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  protected $dates = ['time', 'updated_at', 'created_at'];
    //
    public function category(){
      return $this->belongsToMany(Category::class, 'book_categories')->withPivot('category_quantity');
    }

    public function user(){
      return $this->belongsTo(User::class);
    }
}
