<?php

namespace App\Observers;

use App\Models\Organization\Organization;
use App\Models\Organization\Structure;

class StructureObserver
{
    public function creating(Structure $structure): void
    {
        $structure->organization_id = Organization::query()->first()->id;
    }
}
