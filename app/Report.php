<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Hashidable;

class Report extends Model
{
    //Connection
    protected $connection = 'mysql2';
    //Table name
    protected $table = 'reports';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
}

