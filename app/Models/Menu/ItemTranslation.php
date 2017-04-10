<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-3-26
 */

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class ItemTranslation extends Model
{
    //table name
    protected $table = 'menu_item_translations';

    public $timestamps = false;

    protected $fillable = ['name', 'locale'];

}