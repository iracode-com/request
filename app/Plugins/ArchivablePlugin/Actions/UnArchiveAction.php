<?php

namespace App\Plugins\ArchivablePlugin\Actions;

use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Illuminate\Database\Eloquent\Model;

class UnArchiveAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'unarchive';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('filament-archivable/actions.unarchive.single.label'));

        $this->modalHeading(fn (): string => __('filament-archivable/actions.unarchive.single.modal.heading', ['label' => $this->getRecordTitle()]));

        $this->modalSubmitActionLabel(__('filament-archivable/actions.unarchive.single.modal.actions.unarchive.label'));

        $this->successNotificationTitle(__('filament-archivable/actions.unarchive.single.notifications.unarchived.title'));

        $this->color('gray');

        $this->icon('heroicon-o-arrow-uturn-left');

        $this->requiresConfirmation();

        $this->modalIcon('heroicon-o-arrow-uturn-left');

        $this->action(function (Model $record): void {
            if (! method_exists($record, 'unArchive')) {
                // @codeCoverageIgnoreStart
                $this->failure();

                return;
                // @codeCoverageIgnoreEnd
            }

            $result = $this->process(static fn () => $record->unArchive());

            if (! $result) {
                // @codeCoverageIgnoreStart
                $this->failure();

                return;
                // @codeCoverageIgnoreEnd
            }

            $this->success();
        });

        $this->visible(static function (Model $record): bool {
            if (! method_exists($record, 'isArchived')) {
                // @codeCoverageIgnoreStart
                return false;
                // @codeCoverageIgnoreEnd
            }

            return $record->isArchived();
        });
    }
}
