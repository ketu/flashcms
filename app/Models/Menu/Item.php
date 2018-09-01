<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-4-10
 */

namespace App\Models\Menu;

use App\FlashCMS\NestedTree\NestedTreeTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use NestedTreeTrait;
    use Translatable;

    protected $table = 'menu_item';

    protected $guarded = [];

    public $translationModel = 'App\Models\Menu\ItemTranslation';

    public $translatedAttributes = ['name'];

    public function menu()
    {
        return $this->belongsTo('\App\Models\Menu\Menu', 'menu_id');
    }

    public function children()
    {
        return $this->hasMany('\App\Models\Menu\Item');
    }

    public function parent()
    {
        return $this->belongsTo('\App\Models\Menu\Item');
    }


}