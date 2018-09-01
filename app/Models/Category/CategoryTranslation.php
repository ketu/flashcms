<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-3-26
 */

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    //table name
    protected $table = 'category_translations';

    public $timestamps = false;

    protected $fillable = ['name', 'locale'];

}