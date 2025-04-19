<?php

$roles = \Illuminate\Support\Arr::map(
    auth()->user()->roles->pluck('name')->toArray(),
    fn($item) => $item->getLabel()
);

?>

<x-filament::badge>
    {{ implode(', ', $roles) }}
</x-filament::badge>