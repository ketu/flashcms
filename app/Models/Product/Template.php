<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-4-9
 */

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Template extends Model
{
    use Translatable;

    //table name
    protected $table = 'product_template';

    //protected $fillable = ['status', 'parent_id', 'group_name'];

    protected $guarded = [];

    public $translationModel = 'App\Models\Product\ProductTemplateTranslation';

    public $translatedAttributes = ['name'];



    public function attributes()
    {
        return $this->belongsToMany('\App\Models\Product\Attribute', 'product_template_attribute');
    }
}