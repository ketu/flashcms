<?php
/**
 * User: ketu.lai <ketu.lai@gmail.com>
 * Date: 2017/4/7 11:45
 */

namespace App\FlashCMS\Observer;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class NestedTreeObserver
{
    // creating event
    public function creating(Model $model)
    {
        //$pkColumn = $model->getKeyName();
        $leftColumn = $model->getLeftColumn();
        $rightColumn = $model->getRightColumn();
        $parentColumn = $model->getParentColumn();
        $depthColumn = $model->getDepthColumn();
        $groupColumn = $model->getGroupColumn();
        $parent = null;
        if (is_null($model->$parentColumn)) {

            $model->$leftColumn =  1;
            $model->$rightColumn =  2;
            $model->$depthColumn = 0;
            if (is_null($model->$groupColumn)) {
                $model->$groupColumn = Uuid::uuid4()->toString();
            }

        } else { // parent set
            $parent = $model->findOrFail(
                $model->$parentColumn,
                array_filter([
                    $leftColumn,
                    $rightColumn,
                    $depthColumn,
                    $groupColumn,
                ])
            );
            $model->$leftColumn = $parent->$rightColumn+1;
            $model->$rightColumn = $parent->$rightColumn + 2;
            $model::where($groupColumn, '=', $model->$groupColumn)
                ->where($rightColumn, '>=', $parent->$rightColumn)
                ->increment($rightColumn, 2);
            $model::where($groupColumn, '=', $model->$groupColumn)
                ->where($leftColumn, '>=', $parent->$rightColumn)
                ->increment($leftColumn, 2);
            $model->$depthColumn = $parent->$depthColumn + 1;
            $model->$groupColumn = $parent->$groupColumn;

        }



        return true;

    }

    //updating event
    public function updating(Model $model)
    {

    }

    // deleting event
    public function deleting(Model $model)
    {

    }
}