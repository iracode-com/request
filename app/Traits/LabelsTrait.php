<?php
namespace App\Traits;

use App\Models\Like;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait LabelsTrait
{
    public static function getNavigationLabel(): string
    {
        $class = str(__CLASS__)->afterLast('\\');
        $class = pascal_case_to_spaces($class);
        return __(str($class)->replace('Resource','')->trim()->plural()->value());
    }

    public static function getLabel(): string
    {
        $class = str(__CLASS__)->afterLast('\\');
        $class = pascal_case_to_spaces($class);
        return __(str($class)->replace('Resource','')->trim()->value());
    }

    public static function getPluralLabel(): string
    {
        $class = str(__CLASS__)->afterLast('\\');
        $class = pascal_case_to_spaces($class);
        return __(str($class)->replace('Resource','')->trim()->plural()->value());
    }
}
