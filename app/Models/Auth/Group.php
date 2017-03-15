<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //table name
    protected $table = 'user_groups';

    // disable timestamps for group table
    public $timestamps = false;
    /**
     * users
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\Auth\User');
    }
}
