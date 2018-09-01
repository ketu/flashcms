<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-3-26
 */

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    //table name
    protected $table = 'blog_category_translations';

    public $timestamps = false;

    protected $fillable = ['name', 'content', 'locale'];

}