<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-4-8
 */

namespace App\Models\Blog;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use Translatable;

    //table name
    protected $table = 'blog';

    //protected $fillable = ['status', 'parent_id', 'group_name'];

    protected $guarded = [];

    public $translationModel = 'App\Models\Blog\BlogTranslation';

    public $translatedAttributes = ['name', 'description'];

    public function categories()
    {
        return $this->belongsToMany('\App\Models\Blog\Category', 'blog_category_relation');
    }

}