<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-3-26
 */

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    //table name
    protected $table = 'product_translations';

    public $timestamps = false;

    protected $fillable = ['name', 'description', 'locale'];

}