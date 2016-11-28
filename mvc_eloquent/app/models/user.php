<?php
namespace Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    public function photos()
    {
        return $this->hasMany('Models\Photo');
    }
}