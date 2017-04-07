<?php
/**
 * User: ketu.lai <ketu.lai@gmail.com>
 * Date: 2017/4/3 17:50
 */

namespace App\Models\Category;

use App\FlashCMS\Utils\NestedTreeTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;
    use NestedTreeTrait;

    //table name
    protected $table = 'category';

    protected $fillable = ['status', 'parent_id', 'group_name'];

    public $translationModel = 'App\Models\Category\CategoryTranslation';

    public $translatedAttributes = ['name'];



}