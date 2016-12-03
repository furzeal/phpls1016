<?php
namespace Shop\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
    public function category()
    {
        return $this->belongsTo('Shop\Models\Category','id_category','id');
    }
}