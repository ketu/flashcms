<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-3-26
 */

namespace App\Models\Cms;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Translatable;


    //table name
    protected $table = 'cms_page';

    protected $fillable = ['slug', 'status', 'first_create_user', 'last_update_user'];

    public $translationModel = 'App\Models\Cms\PageTranslation';

    public $translatedAttributes = ['name', 'content'];


}