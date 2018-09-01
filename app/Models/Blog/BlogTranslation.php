<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-3-26
 */

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    //table name
    protected $table = 'blog_translations';

    public $timestamps = false;

    protected $fillable = ['name', 'description', 'locale'];

}