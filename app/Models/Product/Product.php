<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-4-8
 */

namespace App\Models\Product;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Translatable;

    //table name
    protected $table = 'product';

    //protected $fillable = ['status', 'parent_id', 'group_name'];

    protected $guarded = [];

    public $translationModel = 'App\Models\Product\ProductTranslation';

    public $translatedAttributes = ['name', 'description'];


    public function categories()
    {
        return $this->belongsToMany('\App\Models\Category\Category', 'category_product_relation');
    }


    public function attributes()
    {
        return $this->hasMany('\App\Models\Product\Attribute');
    }

    public function galleries()
    {
        return $this->hasMany('\App\Models\Product\Gallery');
    }

    public function videos()
    {
        return $this->hasMany('\App\Models\Product\Video');
    }
}