<?php

namespace App\Filament\Resources\AdminUserRequestResource\Pages;

use App\Filament\Resources\AdminUserRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdminUserRequest extends CreateRecord
{
    protected static string $resource = AdminUserRequestResource::class;
}
