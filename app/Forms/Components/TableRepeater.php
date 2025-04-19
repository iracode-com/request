<?php

namespace App\Forms\Components;

use Closure;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use App\Forms\Components\TableRepeater\Concerns;

class TableRepeater extends Repeater
{
    use Concerns\CanBeStreamlined;
    use Concerns\HasBreakPoints;
    use Concerns\HasEmptyLabel;
    use Concerns\HasExtraActions;
    use Concerns\HasHeader;

    protected bool|Closure|null $showLabels = null;

    public function getAddActionLabel(): string
    {
        return __('Add');
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->registerActions([
            fn(TableRepeater $component): array => $component->getExtraActions()
        ]);
    }

    public function getChildComponents(): array
    {
        $components = parent::getChildComponents();

        if ($this->shouldShowLabels()) {
            return $components;
        }

        foreach ($components as $component) {
            if (
                method_exists($component, 'hiddenLabel') &&
                ! $component instanceof Placeholder
            ) {
                $component->hiddenLabel();
            }
        }

        return $components;
    }

    public function showLabels(bool|Closure|null $condition = true): static
    {
        $this->showLabels = $condition;

        return $this;
    }

    public function shouldShowLabels(): bool
    {
        return $this->evaluate($this->showLabels) ?? false;
    }

    public function getView(): string
    {
        return 'forms.components.table-repeater';
    }
}
