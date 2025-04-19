<?php

namespace App\Filament\Resources\RejectReasonResource\Pages;

use App\Filament\Resources\RejectReasonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRejectReason extends EditRecord
{
    protected static string $resource = RejectReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
