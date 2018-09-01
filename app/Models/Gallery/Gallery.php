<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-3-26
 */

namespace App\Models\Gallery;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{


    //table name
    protected $table = 'gallery';

    protected $fillable = ['name', 'status'];


    public function images()
    {
        return $this->hasMany('App\Models\Gallery\Image');
        // return $this->belongsToMany(Config::get('auth.model'), Config::get('entrust.role_user_table'));
    }


}