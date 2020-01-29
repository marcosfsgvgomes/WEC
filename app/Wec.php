<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wec extends Model
{
    //Table name
    protected $table = 'wecs';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
}
