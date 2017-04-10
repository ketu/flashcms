<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-4-8
 */

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{

    //table name
    protected $table = 'product_attribute_option';

    //protected $fillable = ['status', 'parent_id', 'group_name'];

    protected $guarded = [];
    public $timestamps = false;

/*    public function product()
    {
        return $this->belongsTo('\App\Models\Product\Product', 'product_id');
    }*/

    public function option()
    {
        return $this->hasOne('\App\Models\Attribute\AttributeOption', 'attribute_option_id');
    }

    public function attribute()
    {
        return $this->belongsTo('\App\Models\Product\Attribute', 'attribute_id');

    }

}