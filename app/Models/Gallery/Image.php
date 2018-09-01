<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-4-10
 */

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $table = 'gallery_image';

    protected $guarded = [];


    public function gallery()
    {
        return $this->belongsTo('\App\Models\Gallery\Gallery', 'gallery_id');
    }
}