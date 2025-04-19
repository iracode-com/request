<?php

namespace App\Traits;

use Filament\Tables;
use function Laravel\Prompts\search;

trait HasTableAction
{
    public static function getTableAction()
    {
        $label        = app(self::class)->getTitle();
        $relationship = app(self::class)->getRelationship();

        return Tables\Actions\Action::make($relationship)
            ->label($label)
            ->tooltip($label)
            ->url(fn($record) => self::getUrl(['record' => $record->questionable]))
            ->icon('heroicon-o-paper-clip')
            ->disabled(fn($record) => auth()->user()->isCustomer() && ! $record->questionable->$relationship);
    }

    public static function getActionUrl($record): string
    {
        return self::getUrl(['record' => $record->questionable]);
    }
}
