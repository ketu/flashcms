<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-3-26
 */

namespace App\Models\Cms;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    //table name
    protected $table = 'cms_page_translations';

    public $timestamps = false;

    protected $fillable = ['name', 'content', 'locale'];

}