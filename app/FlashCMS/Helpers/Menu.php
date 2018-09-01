<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-6-12
 */

namespace App\FlashCMS\Helpers;

use App;
use Illuminate\Support\Facades\Request;
use App\Models\Menu\Menu as MenuModel;
use App\Models\Menu\Item as ItemModel;

class Menu
{
    public static function isActive($url = '', $backend = true)
    {
        if ($backend) {
            $prefix = FlashCMS::getBackendPrefix();
            $url = $prefix . ($url? '/'.ltrim($url, '/'):"");
        }

        return Request::is($url);
    }



    private static function parseTree($tree, $root = null)
    {
        $return = array();
    
        foreach($tree as $child) {
            if($child["parent_id"] == $root["id"]) {
                # Remove item from tree (we don't need to traverse this again)
                //unset($tree[$child]);
                # Append the child into result array and parse its children
                $return[] = array(
                    'item' => $child,
                    'children' => self::parseTree($tree, $child)
                );
            }
        }
        return empty($return) ? null : $return;    
    }

    public static function tree() 
    {
        $locale = App::getLocale();

        $menu = MenuModel::where("code", $locale)->first();
        $items = [];
        if ($menu) {
            $items = ItemModel::tree()->where('menu_id', $menu->id)->get();
        }

        return self::parseTree($items);
    }

    public static function renderTree($tree, $parentId = 0) 
    {
        if(!is_null($tree) && count($tree) > 0) {
            echo '<ul>';
            foreach($tree as $node) {
                echo '<li>';
                echo '<a href="'.$node["item"]->link.'">';
                echo $node['item']->name;
                echo '</a>';
                self::renderTree($node['children']);
                echo '</li>';
            }
            echo '</ul>';
        }
    }


}