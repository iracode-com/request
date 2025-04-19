<?php

namespace App\Filament\Resources\RejectReasonResource\Pages;

use App\Filament\Resources\RejectReasonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRejectReasons extends ListRecords
{
    protected static string $resource = RejectReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
