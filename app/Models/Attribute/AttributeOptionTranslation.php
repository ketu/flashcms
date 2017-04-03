<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-3-26
 */

namespace App\Models\Attribute;

use Illuminate\Database\Eloquent\Model;

class AttributeOptionTranslation extends Model
{
    //table name
    protected $table = 'attribute_option_translations';

    public $timestamps = false;

    protected $fillable = ['label', 'locale'];

}