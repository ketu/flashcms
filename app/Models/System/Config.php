<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    //table name
    protected $table = 'system_config';


    // disable timestamps for system_config table
    public $timestamps = false;

}
