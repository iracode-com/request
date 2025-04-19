<?php

namespace App\Traits\Trait;

use App\Enums\RoleEnum;

trait HasRoles
{
    use \Spatie\Permission\Traits\HasRoles;

    public function isSuperAdmin(): bool
    {
        return $this->hasRole(RoleEnum::SUPER_ADMIN);
    }

    public function isCustomer(): bool
    {
        return $this->hasRole(RoleEnum::USER);
    }

    public function isTechnicalExpert(): bool
    {
        return $this->hasRole(RoleEnum::TECHNICAL_EXPERT);
    }

    public function isAuditor(): bool
    {
        return $this->hasRole(RoleEnum::AUDITOR);
    }

    public function isSuperAuditor(): bool
    {
        return $this->hasRole(RoleEnum::SUPER_AUDITOR);
    }

    public function isTechnicalManager(): bool
    {
        return $this->hasRole(RoleEnum::TECHNICAL_MANAGER);
    }

    public function isManager(): bool
    {
        return $this->hasRole(RoleEnum::MANAGER);
    }

    public function isTechnicalReviewer(): bool
    {
        return $this->hasRole(RoleEnum::TECHNICAL_REVIEWER);
    }
}
