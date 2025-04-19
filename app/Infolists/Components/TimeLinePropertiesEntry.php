<?php

namespace App\Infolists\Components;

use App\Enums\QuestionStatus;
use App\Enums\RoleEnum;
use Carbon\Carbon;
use Illuminate\Support\HtmlString;
use Rmsramos\Activitylog\Infolists\Components\TimeLinePropertiesEntry as BaseTimeLinePropertiesEntry;
use Rmsramos\Activitylog\Infolists\Concerns\HasModifyState;
use function App\Support\translate;

class TimeLinePropertiesEntry extends BaseTimeLinePropertiesEntry
{
    use HasModifyState;

    protected function setup(): void
    {
        parent::setup();

        $this->configurePropertiesEntry();
    }

    private function configurePropertiesEntry(): void
    {
        $this
            ->hiddenLabel()
            ->modifyState(fn($state) => $this->modifiedProperties($state));
    }

    private function modifiedProperties($state): ?HtmlString
    {
        $properties = $state['properties'];

        if (! empty($properties)) {
            $changes    = $this->getPropertyChanges($properties);
            $causerName = $this->getCauserName($state['causer']);

            return new HtmlString(sprintf('%s موارد زیر را %s: <br>%s', $causerName, 'ویرایش کرد', implode('<br>', $changes)));
        }

        return null;
    }

    private function getPropertyChanges(array $properties): array
    {
        $changes = [];

        if (isset($properties['old'], $properties['attributes'])) {
            $changes = $this->compareOldAndNewValues($properties['old'], $properties['attributes']);
        } elseif (isset($properties['attributes'])) {
            $changes = $this->getNewValues($properties['attributes']);
        }

        return $changes;
    }

    private function compareOldAndNewValues(array $oldValues, array $newValues): array
    {
        $changes = [];

        foreach ($newValues as $key => $newValue) {
            $oldValue = is_array($oldValues[$key]) ? json_encode($oldValues[$key]) : $oldValues[$key] ?? '-';
            $newValue = $this->formatNewValue($newValue);

            $translatedKey = translate($key);

            if (in_array($key, ['status', 'pending'])) {
                $oldValue = QuestionStatus::getBy($oldValue)->getLabel();
                $newValue = QuestionStatus::getBy($newValue)->getLabel();
            }


            if ($key == 'referred_to') {
                $oldValue = RoleEnum::getBy($oldValue)->getLabel();
                $newValue = RoleEnum::getBy($newValue)->getLabel();
            }

            if (isset($oldValues[$key]) && $oldValues[$key] != $newValue) {
                $changes[] = "- {$translatedKey} از <strong>" . htmlspecialchars($oldValue) . '</strong> به <strong>' . htmlspecialchars($newValue) . '</strong>';
            } else {
                $changes[] = "- {$translatedKey} <strong>" . htmlspecialchars($newValue) . '</strong>';
            }
        }

        return $changes;
    }

    private function getNewValues(array $newValues): array
    {

        $callback = function ($key, $value) use ($newValues) {
            $translatedKey = translate($key);

            if (in_array($key, ['created_at', 'updated_at', 'deleted_at'])) {
                // $value = verta($value)->format(config('filament-activitylog.datetime_format'));
            }

            if (in_array($key, ['status', 'pending']) == 'status') {
                $value = QuestionStatus::getBy($value)->getLabel();
            }

            if ($key == 'referred_to') {
                $value = RoleEnum::getBy($value)->getLabel();
            }

            return "- {$translatedKey} <strong>" . htmlspecialchars($this->formatNewValue($value)) . '</strong>';
        };

        return array_map($callback, array_keys($newValues), $newValues);
    }

    private function formatNewValue($value): string
    {
        return is_array($value) ? json_encode($value) : $value ?? '—';
    }
}
