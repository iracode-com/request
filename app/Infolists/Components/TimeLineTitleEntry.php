<?php

namespace App\Infolists\Components;

use Carbon\Carbon;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Rmsramos\Activitylog\Infolists\Components\TimeLineTitleEntry as BaseTimeLineTitleEntry;
use Rmsramos\Activitylog\Infolists\Concerns\HasModifyState;
use function App\Support\translate;

class TimeLineTitleEntry extends BaseTimeLineTitleEntry
{
    use HasModifyState;

    protected function setUp(): void
    {
        parent::setUp();

        $this->configureTitleEntry();
    }

    private function configureTitleEntry(): void
    {
        $this
            ->hiddenLabel()
            ->modifyState(fn($state) => $this->modifiedTitle($state));
    }

    private function modifiedTitle($state): string|HtmlString
    {
        if ($this->configureTitleUsing !== null && $this->shouldConfigureTitleUsing !== null && $this->evaluate($this->shouldConfigureTitleUsing)) {
            return $this->evaluate($this->configureTitleUsing);
        } else {
            if ($state['description'] == $state['event']) {
                $className  = str(class_basename($state['subject']))->snake(' ')->lower()->value();
                $causerName = $this->getCauserName($state['causer']);
                $updated_at = verta($state['update'])->format(config('filament-activitylog.datetime_format'));

                return new HtmlString(
                    sprintf(
                        '<strong>%s</strong> توسط <strong>%s</strong> <strong>%s</strong>. <br><small> بروزرسانی در: <strong>%s</strong></small>',
                        translate($className),
                        $causerName,
                        translate($state['event']),
                        $updated_at
                    )
                );
            }
        }

        return '';
    }
}
