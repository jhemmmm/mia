<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function item(){
      return $this->belongsToMany(Item::class, 'category_items')->withPivot('item_value');
    }

}
