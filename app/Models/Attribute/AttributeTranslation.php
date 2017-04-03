<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-3-26
 */

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class AttributeTranslation extends Model
{
    //table name
    protected $table = 'attribute_translations';

    public $timestamps = false;

    protected $fillable = ['name', 'value', 'locale'];

}