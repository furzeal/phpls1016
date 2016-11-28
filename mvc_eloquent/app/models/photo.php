<?php
namespace Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Photo extends Eloquent
{
    public function photos()
    {
        return $this->belongsTo('Models\User','id_user','id');
    }
}