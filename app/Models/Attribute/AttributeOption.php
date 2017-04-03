<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-3-26
 */

namespace App\Models\Attribute;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    use Translatable;

    //table name
    protected $table = 'attribute_option';

    //protected $fillable = [];

    public $translationModel = 'App\Models\Attribute\AttributeOptionTranslation';

    public $translatedAttributes = ['label'];


    public function attribute()
    {
        $this->belongsTo('Attribute');
    }
}