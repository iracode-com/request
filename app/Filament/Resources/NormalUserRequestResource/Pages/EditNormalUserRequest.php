<?php

namespace App\Filament\Resources\NormalUserRequestResource\Pages;

use App\Filament\Resources\NormalUserRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNormalUserRequest extends EditRecord
{
    protected static string $resource = NormalUserRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
