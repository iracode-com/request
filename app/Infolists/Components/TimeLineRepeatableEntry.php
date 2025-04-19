<?php

namespace App\Infolists\Components;

use Filament\Infolists\Components\Entry;

use Rmsramos\Activitylog\Infolists\Components\TimeLineRepeatableEntry as BaseTimeLineRepeatableEntry;
class TimeLineRepeatableEntry extends BaseTimeLineRepeatableEntry
{
    protected string $view = 'infolists.components.time-line-repeatable-entry';
}
