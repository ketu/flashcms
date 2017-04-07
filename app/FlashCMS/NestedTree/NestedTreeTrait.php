<?php
/**
 * User: ketu.lai <ketu.lai@gmail.com>
 * Date: 2017/4/7 11:28
 */

namespace App\FlashCMS\NestedTree;

use App\FlashCMS\NestedTree\NestedTreeObserver;
use Illuminate\Database\Eloquent\Builder;

trait NestedTreeTrait
{

    protected $nestedTreeColumns = [
        'left' => 'lft',
        'right' => 'rgt',
        'parent' => 'parent_id',
        'depth' => 'depth',
        'group' => 'group_name'
    ];

    private $requiredColumns = [
        'left',
        'right',
        'parent',
        'depth',
        'group'
    ];

    public static function boot()
    {
        parent::boot();
        self::observe(new NestedTreeObserver());
    }

    public function getLeftColumn()
    {
        return $this->getColumnName('left');
    }

    public function getRightColumn()
    {
        return $this->getColumnName('right');
    }

    public function getParentColumn()
    {
        return $this->getColumnName('parent');
    }

    public function getDepthColumn()
    {
        return $this->getColumnName('depth');
    }

    public function getGroupColumn()
    {
        return $this->getColumnName('group');

    }

    public function getRequiredColumn()
    {
        return $this->requiredColumns;
    }

    private function getColumnName($columnName)
    {
        $requiredColumns = array_diff($this->requiredColumns, array_keys($this->nestedTreeColumns));

        if ($requiredColumns) {
            throw new \UnexpectedValueException(sprintf('Required column(%s) cannot be found in ' . get_class($this),
                \join(', ', $requiredColumns)));
        }

        if (!isset($this->nestedTreeColumns[$columnName])) {
            throw new \UnexpectedValueException('"' . $columnName . '" column cannot be empty in ' . get_class($this));
        }
        return $this->nestedTreeColumns[$columnName];
    }

    private function mergeTranslatableTranslation(Builder $queryBuilder)
    {
        if (method_exists($this, 'scopeWithTranslation')) {
            $queryBuilder->withTranslation();
        }

        return $queryBuilder;
    }

    public static function rebuildTree()
    {

    }

    public function renderTree($onlyChild = false)
    {

        $diffLft = 0;
        if ($onlyChild) {
            $diffLft = 1;
        }

        $groupColumn = $this->getGroupColumn();
        $leftColumn = $this->getLeftColumn();
        $rightColumn = $this->getRightColumn();
        $queryBuilder = self::where($this->getGroupColumn(), '=', $this->$groupColumn)
            ->whereBetween($leftColumn, [$this->$leftColumn + $diffLft, $this->$rightColumn - $diffLft])
            ->orderBy($this->getLeftColumn());
        $queryBuilder = $this->mergeTranslatableTranslation($queryBuilder);
        return $queryBuilder;
    }
}