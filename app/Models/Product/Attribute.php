<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-4-8
 */

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{

    //table name
    protected $table = 'product_attribute';

    //protected $fillable = ['status', 'parent_id', 'group_name'];

    protected $guarded = [];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo('\App\Models\Product\Product', 'product_id');
    }

    public function attribute()
    {
        return $this->belongsTo('\App\Models\Attribute\Attribute', 'attribute_id');
    }

    public function options()
    {
        return $this->hasMany('\App\Models\Product\AttributeOption', 'attribute_id');
    }
}