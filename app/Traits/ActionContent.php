<?php

namespace App\Traits;

use App\Infolists\Components\TimeLineRepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Rmsramos\Activitylog\Actions\Concerns\ActionContent as BaseActionContent;
use Rmsramos\Activitylog\Infolists\Components\TimeLineIconEntry;
use App\Infolists\Components\TimeLinePropertiesEntry;
use App\Infolists\Components\TimeLineTitleEntry;

trait ActionContent
{
    use BaseActionContent;

    private function getSchema(): array
    {
        return [
            TimeLineRepeatableEntry::make('activities')
                ->schema([
                    TimeLineIconEntry::make('activityData.event')
                        ->icon(function ($state) {
                            return $this->getTimelineIcons()[$state] ?? 'heroicon-o-check';
                        })
                        ->color(function ($state) {
                            return $this->getTimelineIconColors()[$state] ?? 'primary';
                        }),

                    TimeLineTitleEntry::make('activityData')
                        ->configureTitleUsing($this->modifyTitleUsing)
                        ->shouldConfigureTitleUsing($this->shouldModifyTitleUsing),

                    TimeLinePropertiesEntry::make('activityData'),

                    TextEntry::make('log_name')
                        ->hiddenLabel()
                        ->badge(),

                    TextEntry::make('updated_at')
                        ->hiddenLabel()
                        ->since()
                        ->badge(),
                ]),
        ];
    }
}
