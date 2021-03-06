<?php
/**
 * User: ketu.lai <ketu.lai@gmail.com>
 * Date: 2017/4/7 11:45
 */

namespace App\FlashCMS\NestedTree;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class NestedTreeObserver
{
    // creating event
    public function creating(Model $model)
    {
        //$pkColumn = $model->getKeyName();

        $cls = get_class($model);
        $leftColumn = $model->getLeftColumn();
        $rightColumn = $model->getRightColumn();
        $parentColumn = $model->getParentColumn();
        $depthColumn = $model->getDepthColumn();
        $groupColumn = $model->getGroupColumn();

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

                $cls::where($groupColumn, '=', $parent->$groupColumn)
                    ->where($rightColumn, '>=', $parent->$rightColumn)
                    ->increment($rightColumn, 2);
                $cls::where($groupColumn, '=', $parent->$groupColumn)
                    ->where($leftColumn, '>=', $parent->$rightColumn)
                    ->increment($leftColumn, 2);

                $model->$depthColumn = $parent->$depthColumn + 1;
                $model->$groupColumn = $parent->$groupColumn;

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

        }

        return true;

    }

    //updating event
    public function updating(Model $model)
    {
        $cls = get_class($model);
        $pkColumn = $model->getKeyName();
        $leftColumn = $model->getLeftColumn();
        $rightColumn = $model->getRightColumn();
        $parentColumn = $model->getParentColumn();
        $depthColumn = $model->getDepthColumn();
        $groupColumn = $model->getGroupColumn();


        $originalParentId = $model->getOriginal($parentColumn);
        $originalLft = $model->getOriginal($leftColumn);
        $originalRgt = $model->getOriginal($rightColumn);
        $originalGroupName = $model->getOriginal($groupColumn);

        $originalDescendants = ($originalRgt - $originalLft - 1) / 2;

        // not update parent, just return
        if ($originalParentId == $model->$parentColumn) {
            return true;
        }
        try {
            DB::beginTransaction();

            $children = $cls::where($groupColumn, '=', $originalGroupName)
                ->where($rightColumn, '<', $originalRgt)
                ->where($leftColumn, '>', $originalLft)
                ->get();

            if (!is_null($originalParentId)) {

                //update original parent path
                $cls::where($groupColumn, '=', $originalGroupName)
                    ->where($rightColumn, '>', $originalRgt)
                    ->decrement($rightColumn, 2 * ($originalDescendants + 1));


                $cls::where($groupColumn, '=', $originalGroupName)
                    ->where($leftColumn, '>', $originalRgt)
                    ->decrement($leftColumn, 2 * ($originalDescendants + 1));
            }





            if (!is_null($model->$parentColumn)) {
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
                $cls::where($groupColumn, '=', $newParent->$groupColumn)
                    ->where($rightColumn, '>=', $newParent->$rightColumn)
                    ->increment($rightColumn, 2 * ($originalDescendants + 1));
                $cls::where($groupColumn, '=', $newParent->$groupColumn)
                    ->where($leftColumn, '>', $newParent->$rightColumn)
                    ->increment($leftColumn, 2 * ($originalDescendants + 1));

                // find max sbling right
                /*$currentMaxRight = $cls::where($groupColumn, '=', $newParent->$groupColumn)
                    ->where($rightColumn, '<', $newParent->$rightColumn)->max($rightColumn);*/


                $newLeft = $newParent->$leftColumn + 1;
                $newRight = $newParent->$leftColumn + 2 + $originalDescendants * 2;
                $newGroupName =  $newParent->$groupColumn;
                $newDepth = $newParent->$depthColumn + 1;
            } else {
                $newLeft = 1;
                $newRight = 2 * $originalDescendants + 2;
                $newDepth = 0;
                if ($model->$groupColumn == $originalGroupName) {
                    $newGroupName = Uuid::uuid4()->toString();
                } else {
                    $newGroupName = $model->$groupColumn;
                }
            }
            $model->$leftColumn = $newLeft;
            $model->$rightColumn = $newRight;
            $model->$depthColumn = $newDepth;
            $model->$groupColumn = $newGroupName;





            $cls::unguard();
            foreach ($children as $child) {
                $originalChildDescendants = ($child->$rightColumn - $child->$leftColumn - 1) / 2;
                $newChildLeft = $newLeft + ($originalDescendants - $originalChildDescendants) * 1;

                $newChildRight = $newChildLeft + 1 + ($originalChildDescendants) * 2;
                $newChildGroupName = $newGroupName;
                $cls::find($child->$pkColumn)->update(
                    [
                        $depthColumn => $model->$depthColumn + $originalChildDescendants + 1,
                        $leftColumn => $newChildLeft,
                        $rightColumn => $newChildRight,
                        $groupColumn => $newChildGroupName
                    ]
                );
            }
            $cls::reguard();


            DB::commit();

            return true;
        }catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

    }

    // deleting event
    public function deleting(Model $model)
    {
        $cls = get_class($model);
        $pkColumn = $model->getKeyName();
        $leftColumn = $model->getLeftColumn();
        $rightColumn = $model->getRightColumn();
        $parentColumn = $model->getParentColumn();
        $depthColumn = $model->getDepthColumn();
        $groupColumn = $model->getGroupColumn();

        $originalParentId = $model->getOriginal($parentColumn);
        $originalLft = $model->getOriginal($leftColumn);
        $originalRgt = $model->getOriginal($rightColumn);
        $originalGroupName = $model->getOriginal($groupColumn);

        $originalDescendants = ($originalRgt - $originalLft - 1) / 2;

        try {
            DB::beginTransaction();

            $cls::where($groupColumn, '=', $originalGroupName)
                ->where($leftColumn, '>', $originalLft)
                ->where($rightColumn, '<', $originalRgt)
                ->delete();
            if (!is_null($originalParentId)) {
                $parent = $model->findOrFail(
                    $originalParentId,
                    array_filter([
                        $leftColumn,
                        $rightColumn,
                        $depthColumn,
                        $groupColumn,
                    ])
                );

                $cls::where($groupColumn, '=', $originalGroupName)
                    ->where($rightColumn, '>', $originalRgt)
                    ->decrement($rightColumn, 2 * ($originalDescendants + 1));
            }
            DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}