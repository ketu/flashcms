<?php
/**
 * User: ketu.lai <ketu.lai@gmail.com>
 * Date: 2017/4/3 17:50
 */

namespace App\Models\Blog;

use App\FlashCMS\NestedTree\NestedTreeTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;
    use NestedTreeTrait;

    //table name
    protected $table = 'blog_category';

    //protected $fillable = ['status', 'parent_id', 'group_name'];

    protected $guarded = ['rgt', 'lft', 'depth'];

    protected $hidden = ["name", "content"];

    public $translationModel = 'App\Models\Blog\CategoryTranslation';

    public $translatedAttributes = ['name', 'content'];


    public function children()
    {
     return $this->hasMany('App\Models\Blog\Category');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Blog\Category');
    }

    public function blogs()
    {
        return $this->belongsToMany('\App\Models\Blog\Blog', 'blog_category_relation');
    }

}