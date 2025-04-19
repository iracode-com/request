<?php

namespace App\Filament\Resources\AdminUserRequestResource\Pages;

use App\Filament\Resources\AdminUserRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdminUserRequests extends ListRecords
{
    protected static string $resource = AdminUserRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
