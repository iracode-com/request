<?php

namespace App\Plugins\AuthUIEnhancerPlugin\Concerns;

trait HasCustomLayout
{
    public function getLayout(): string
    {
        return 'filament.pages.auth.auth-layout';
    }
}