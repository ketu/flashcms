<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-4-10
 */

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table = 'menu';

    protected $guarded = [];


    public function items()
    {
        return $this->hasMany('\App\Models\Menu\Item');
    }
}