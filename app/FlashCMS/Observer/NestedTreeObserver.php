<?php
/**
 * User: ketu.lai <ketu.lai@gmail.com>
 * Date: 2017/4/7 11:45
 */

namespace App\FlashCMS\Observer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

            $model->$leftColumn = 1;
            $model->$rightColumn = 2;
            $model->$depthColumn = 0;
            if (is_null($model->$groupColumn)) {
                $model->$groupColumn = Uuid::uuid4()->toString();
            }

        } else { // parent set


            try {

                DB::beginTransaction();

                $parent = $model->findOrFail(
                    $model->$parentColumn,
                    array_filter([
                        $leftColumn,
                        $rightColumn,
                        $depthColumn,
                        $groupColumn,
                    ])
                );

                $model->$leftColumn = $parent->$rightColumn;
                $model->$rightColumn = $parent->$rightColumn + 1;

                $model::where($groupColumn, '=', $parent->$groupColumn)
                    ->where($rightColumn, '>=', $parent->$rightColumn)
                    ->increment($rightColumn, 2);
                $model::where($groupColumn, '=', $parent->$groupColumn)
                    ->where($leftColumn, '>=', $parent->$rightColumn)
                    ->increment($leftColumn, 2);

                $model->$depthColumn = $parent->$depthColumn + 1;
                $model->$groupColumn = $parent->$groupColumn;

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw new \Exception('Can not insert node to parent');
            }

        }

        return true;

    }

    //updating event
    public function updating(Model $model)
    {
        $pkColumn = $model->getKeyName();
        $leftColumn = $model->getLeftColumn();
        $rightColumn = $model->getRightColumn();
        $parentColumn = $model->getParentColumn();
        $depthColumn = $model->getDepthColumn();
        $groupColumn = $model->getGroupColumn();
        $parent = null;

        $originalParentId = $model->getOriginal($parentColumn);
        $originalLft = $model->getOriginal($leftColumn);
        $originalRgt = $model->getOriginal($rightColumn);
        $originalGroupName = $model->getOriginal($groupColumn);

        $originalDescendants = ($originalRgt - $originalLft - 1) / 2;

        // not update parent, just return
        if ($originalParentId == $model->$parentColumn) {
            return true;
        }

        $newParent = $model->findOrFail(
            $model->$parentColumn,
            array_filter([
                $leftColumn,
                $rightColumn,
                $depthColumn,
                $groupColumn,
            ])
        );


        // update new parent path
        $model::where($groupColumn, '=', $newParent->$groupColumn)
            ->where($rightColumn, '>=', $newParent->$rightColumn)
            ->increment($rightColumn, 2 * ($originalDescendants + 1));

        // find max sbling right
        $currentMaxRight = $model::where($groupColumn, '=', $newParent->$groupColumn)
            ->where($rightColumn, '<', $newParent->$rightColumn)->max($rightColumn);

        $newLeft = $currentMaxRight + 1;
        $newRight = $currentMaxRight + 2 + ($originalDescendants) * 2;
        $model->$leftColumn = $newLeft;
        $model->$rightColumn = $newRight;
        $model->$depthColumn = $newParent->$depthColumn + 1;
        $model->$groupColumn = $newParent->$groupColumn;


        $children = $model::where($groupColumn, '=', $originalGroupName)
            ->where($rightColumn, '<', $originalRgt)->get();

        foreach ($children as $child) {
            echo $originalChildDescendants = ($child->$rightColumn - $child->$leftColumn - 1) / 2;

            echo $newChildLeft = $newLeft + ($originalDescendants - $originalChildDescendants) * 1;


            echo $newChildRight = $newChildLeft + 1 + ($originalChildDescendants) * 2;


            $newChildGroupName = $newParent->$groupColumn;

            $model::find($child->$pkColumn)->increment($leftColumn, $child->$leftColumn - $newChildLeft);
            $model::find($child->$pkColumn)->increment($rightColumn, $child->$rightColumn - $newChildRight);
            $model::find($child->$pkColumn)->increment($depthColumn, $child->$depthColumn - $model->$depthColumn +
                $originalDescendants - $originalChildDescendants + 1);
            $model::find($child->$pkColumn)
                ->update(
                    [
                        $groupColumn => $newChildGroupName
                    ]
                );
        }


        //update original parent path
        $model::where($groupColumn, '=', $originalGroupName)
            ->where($rightColumn, '>', $originalRgt)
            ->decrement($rightColumn, 2 * ($originalDescendants + 1));


        return true;

    }

    // deleting event
    public function deleting(Model $model)
    {

    }
}