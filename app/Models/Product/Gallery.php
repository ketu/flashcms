<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-4-8
 */

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    //table name
    protected $table = 'product_gallery';

    //protected $fillable = ['status', 'parent_id', 'group_name'];

    protected $guarded = [];


    public function product()
    {
        return $this->belongsTo('\App\Models\Product\Product', 'product_id');
    }

}