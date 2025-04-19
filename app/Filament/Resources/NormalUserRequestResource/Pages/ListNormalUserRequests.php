<?php

namespace App\Filament\Resources\NormalUserRequestResource\Pages;

use App\Filament\Resources\NormalUserRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNormalUserRequests extends ListRecords
{
    protected static string $resource = NormalUserRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
