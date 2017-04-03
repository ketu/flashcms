<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-3-26
 */

namespace App\Models\Attribute;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use Translatable;

    //table name
    protected $table = 'attribute';

    protected $fillable = ['code', 'type', 'status'];

    public $translationModel = 'App\Models\Attribute\AttributeTranslation';

    public $translatedAttributes = ['name', 'value'];


    public function options()
    {
        return $this->hasMany('AttributeOption');
        // return $this->belongsToMany(Config::get('auth.model'), Config::get('entrust.role_user_table'));
    }
}