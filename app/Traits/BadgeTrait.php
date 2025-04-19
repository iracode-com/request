<?php
namespace App\Traits;

use App\Models\Like;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait BadgeTrait
{
    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->count();
    }
}
