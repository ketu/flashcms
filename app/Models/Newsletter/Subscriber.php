<?php
/**
 * User: ketu.lai <ketu.lai@gmail.com>
 * Date: 2017/4/10 10:50
 */

namespace App\Models\Newsletter;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $table = 'newsletter_subscriber';
    protected $fillable = ['email', 'status', 'locale'];
}