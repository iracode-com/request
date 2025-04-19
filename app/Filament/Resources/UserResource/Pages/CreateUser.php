<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserResource\Schemas;
use App\Services\PermissionService;
use Filament\Forms;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource    = UserResource::class;
    public ?array           $permissions = [];

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    public function create(bool $another = false): void
    {
        parent::create($another);

        app(PermissionService::class)
            ->syncPermissions($this->getRecord(), $this->form->getState()['permissions']);
    }
}
