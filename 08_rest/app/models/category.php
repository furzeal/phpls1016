<?php
namespace Shop\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends Eloquent
{
    protected $table = 'categories';
    public function products()
    {
        return $this->hasMany('Models\Product');
    }
}