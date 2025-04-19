<?php

namespace App\Enums;

use App\Traits\BaseEnum;
use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum RoleEnum: string implements HasLabel, HasColor
{
    use BaseEnum;

    case SUPER_ADMIN           = 'super_admin';
    case TECHNICAL_EXPERT      = 'technical_expert';
    case AUDITOR               = 'auditor';
    case SUPER_AUDITOR         = 'super_auditor';
    case TECHNICAL_MANAGER     = 'technical_manager';
    case TECHNICAL_REVIEWER    = 'technical_reviewer';
    case MANAGER               = 'manager';
    case USER                  = 'user';
    case CERTIFICATION_MANAGER = 'certification_manager';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::USER                  => 'کاربر',
            self::SUPER_ADMIN           => 'مدیر سیستم',
            self::TECHNICAL_EXPERT      => 'کارشناس فنی',
            self::AUDITOR               => 'ممیز',
            self::SUPER_AUDITOR         => 'سرممیز',
            self::TECHNICAL_MANAGER     => 'مدیر فنی',
            self::TECHNICAL_REVIEWER    => 'بازبین فنی',
            self::MANAGER               => 'مدیر عامل',
            self::CERTIFICATION_MANAGER => 'مدیر گواهی کردن',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::SUPER_ADMIN           => 'danger',
            self::USER                  => 'success',
            self::TECHNICAL_EXPERT      => 'orange',
            self::AUDITOR               => 'fuchsia',
            self::SUPER_AUDITOR         => 'cyan',
            self::TECHNICAL_MANAGER     => 'info',
            self::TECHNICAL_REVIEWER    => 'yellow',
            self::MANAGER               => 'gray',
            self::CERTIFICATION_MANAGER => 'yellow',
        };
    }

    public function getOptions(bool $toArray = false): array
    {
        $options = match ($this) {
            self::TECHNICAL_EXPERT   => [
                QuestionStatus::COMPLETING_INFORMATION,
                QuestionStatus::REVIEW_BY_TECHNICAL_EXPERT,
                QuestionStatus::AUDIT_PERIOD_FORM_COMPLETION,
                QuestionStatus::AUDIT_COST_FORM_COMPLETION,
                QuestionStatus::DOCUMENTS_UPLOADED_BY_CUSTOMER,
                QuestionStatus::REJECTED_AUDIT_FORM_BY_CUSTOMER,
                QuestionStatus::SEND_TO_THE_FIRST_AUDIT_STAGE,
                QuestionStatus::DETERMINING_FIRST_STAGE_AUDIT_DATE_AND_TEAM,
                QuestionStatus::REGISTERED_IN_WAITING_FOR_FIRST_LEVEL_AUDIT_CUSTOMERS_LIST,
                QuestionStatus::REJECTED_BY_AUDIT,
                QuestionStatus::REJECTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                QuestionStatus::SELECT_THE_ALTERNATIVE_AUDIT,
                QuestionStatus::REGISTERED_IN_WAITING_FOR_SECOND_LEVEL_AUDIT_CUSTOMERS_LIST,
                QuestionStatus::CUSTOMER_APPLIED_TO_RENEW_CERTIFICATE,
            ],

            self::TECHNICAL_MANAGER  => [
                QuestionStatus::REVIEW_BY_TECHNICAL_MANAGER,
                QuestionStatus::COMPLETING_THE_CONTRACT,
                QuestionStatus::ACCEPTED_BY_TECHNICAL_MANAGER,
                QuestionStatus::REJECTED_BY_TECHNICAL_MANAGER,
                QuestionStatus::REGISTERED_IN_SUCCESSFUL_CUSTOMERS_LIST,
                QuestionStatus::ACCEPTED_AUDIT_FORM_BY_CUSTOMER,
                QuestionStatus::CHECKING_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                QuestionStatus::CHECKING_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                QuestionStatus::CHECKING_DOCUMENTS_BY_TECHNICAL_MANAGER,
                QuestionStatus::SELECT_TECHNICAL_REVIEW_TEAM,
                QuestionStatus::COMPLETING_THE_CERTIFICATE_GRANTING_DECISION_MAKING_RECORD_FORM,
                QuestionStatus::COMPLETING_CUSTOMER_CONFIRMATION_FORM,
                QuestionStatus::COMPLETING_THE_DRAFT_CERTIFICATE,
                QuestionStatus::ACCEPTED_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM,
                QuestionStatus::ACCEPTED_CUSTOMER_CONFIRMATION_FORM
            ],

            self::USER               => [
                QuestionStatus::CHECKING_AUDIT_FORM_BY_CUSTOMER,
                QuestionStatus::WAITING_FOR_UPLOADING_DOCUMENTS,
                QuestionStatus::WAITING_FOR_CORRECTIVE_ACTIONS,
                QuestionStatus::CHECKING_CUSTOMER_CONFIRMATION_FORM,
                QuestionStatus::ACCESS_AUDIT_PROGRAM_ANNOUNCEMENT_LETTER,
                QuestionStatus::ACCESS_AUDIT_DATE_ANNOUNCEMENT_LETTER
            ],

            self::AUDITOR            => [
                QuestionStatus::CHECKING_BY_AUDIT,
                QuestionStatus::ACCEPTED_BY_AUDIT,
                QuestionStatus::COMPLETING_MISSION_ORDER_FORM,
            ],

            self::SUPER_AUDITOR      => [
                QuestionStatus::UPLOAD_AUDIT_PACKAGE,
                QuestionStatus::COMPLETING_AUDIT_PROGRAM_FORM,
                QuestionStatus::COMPLETING_FIRST_STAGE_AUDIT,
                QuestionStatus::ACCEPTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                QuestionStatus::UPDATE_AUDITOR_PROGRAM_NOTIFICATION_FORM,
                QuestionStatus::REJECTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,

                // ask ?
                QuestionStatus::ACCEPTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                QuestionStatus::ACCESS_AUDIT_PROGRAM_ANNOUNCEMENT_LETTER,
                QuestionStatus::ACCESS_AUDIT_DATE_ANNOUNCEMENT_LETTER,
                QuestionStatus::UPLOADING_FIRST_AUDIT_DOCUMENTS,
                QuestionStatus::REJECTED_DOCUMENTS_BY_TECHNICAL_MANAGER,
                QuestionStatus::ACCEPTED_DOCUMENTS_BY_TECHNICAL_MANAGER,
                QuestionStatus::CHECKING_NONE_COMPLIANCE,
                QuestionStatus::HAS_NOT_COMPLIANCE,
                QuestionStatus::HAS_COMPLIANCE,
                QuestionStatus::REJECTED_CORRECTIVE_ACTIONS,
                QuestionStatus::ACCEPTED_CORRECTIVE_ACTIONS,
                QuestionStatus::CHECKING_CORRECTIVE_ACTIONS,
            ],

            self::TECHNICAL_REVIEWER => [
                QuestionStatus::CHECKING_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM,
                QuestionStatus::REGISTER_IN_SPECIAL_CUSTOMERS_LIST,
                QuestionStatus::REJECTED_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM
            ],

            self::MANAGER            => [
                QuestionStatus::CHECKING_THE_DRAFT_CERTIFICATE,
                QuestionStatus::REJECTED_THE_DRAFT_CERTIFICATE,
                QuestionStatus::ACCEPTED_THE_DRAFT_CERTIFICATE,
                QuestionStatus::CERTIFICATE_ISSUING,
                QuestionStatus::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_FIRST_CARE_AUDIT
            ],

            default                  => []
        };

        if ($toArray) {
            $options = self::toArray($options);
        }

        return $options;
    }

    public static function getRoleOptions(): array
    {
        return [
            self::TECHNICAL_EXPERT->value   => self::TECHNICAL_EXPERT->getOptions(),
            self::TECHNICAL_MANAGER->value  => self::TECHNICAL_MANAGER->getOptions(),
            self::USER->value               => self::USER->getOptions(),
            self::AUDITOR->value            => self::AUDITOR->getOptions(),
            self::SUPER_AUDITOR->value      => self::SUPER_AUDITOR->getOptions(),
            self::TECHNICAL_REVIEWER->value => self::TECHNICAL_REVIEWER->getOptions(),
            self::MANAGER->value            => self::MANAGER->getOptions()
        ];
    }

    public static function getUserOptions(bool $toArray = false): array
    {
        $user = auth()->user();

        if ($user->isTechnicalExpert()) {
            $status = self::TECHNICAL_EXPERT->getOptions($toArray);
        }

        if ($user->isTechnicalManager()) {
            $status = self::TECHNICAL_MANAGER->getOptions($toArray);
        }

        if ($user->isAuditor()) {
            $status = self::AUDITOR->getOptions($toArray);
        }

        if ($user->isSuperAuditor()) {
            $status = self::SUPER_AUDITOR->getOptions($toArray);
        }

        if ($user->isCustomer()) {
            $status = self::USER->getOptions($toArray);
        }

        if ($user->isTechnicalReviewer()) {
            $status = self::TECHNICAL_REVIEWER->getOptions($toArray);
        }

        if ($user->isManager()) {
            $status = self::MANAGER->getOptions($toArray);
        }

        return $status ?? [];
    }
}
