<?php

namespace App\Enums;

use App\Filament\Resources\Question\FirstAuditResource;
use App\Filament\Resources\Question\SecondAuditResource;
use App\Filament\Resources\Question\ServiceRequestResource;
use App\Traits\BaseEnum;
use Filament\Support\Contracts\HasLabel;

enum QuestionAction: int implements HasLabel
{
    use BaseEnum;

    case TECHNICAL_QUESTIONNAIRE  = 0;
    case AUDIT_DURATION           = 1;
    case AUDIT_COST               = 2;
    case CONTRACT                 = 3;
    case UPLOAD_DOCUMENTS_BY_USER = 4;
    case FIRST_AUDIT              = 5;
    case AUDIT_DATE_AND_TEAM      = 6;
    case AUDIT_MISSION_ORDER      = 7;
    case AUDIT_WEEKLY_SCHEDULE    = 8;
    case AUDIT_PROGRAM            = 9;
    case AUDIT_REPORT             = 10;
    case AUDIT_RECORD_FORM        = 11;
    case SECOND_AUDIT             = 12;
    case FIRST_CARE               = 13;
    case SECOND_CARE              = 14;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::TECHNICAL_QUESTIONNAIRE  => 'تکمیل پرسشنامه فنی',
            self::AUDIT_DURATION           => 'تکمیل فرم مدت زمان ممیزی',
            self::AUDIT_COST               => 'تکمیل فرم هزینه ممیزی',
            self::CONTRACT                 => 'تکمیل فرم قرارداد با مشتری',
            self::UPLOAD_DOCUMENTS_BY_USER => 'بارگزاری مدارک توسط مشتری',
            self::FIRST_AUDIT              => 'ممیزی مرحله اول',
            self::SECOND_AUDIT             => 'ممیزی مرحله دوم',
            self::AUDIT_DATE_AND_TEAM      => 'تعیین تاریخ و تیم ممیزی',
            self::AUDIT_MISSION_ORDER      => 'تکمیل فرم حکم ماموریت',
            self::AUDIT_WEEKLY_SCHEDULE    => 'بروزرسانی فرم اعلام برنامه ممیزان',
            self::AUDIT_PROGRAM            => 'تکمیل فرم برنامه ممیزی',
            self::AUDIT_REPORT             => 'انجام ممیزی و تکمیل فرم گزارش ممیزی',
            self::AUDIT_RECORD_FORM        => 'تکمیل فرم صورتجلسه تصمیم گیري اعطاي گواهینامه',
            self::FIRST_CARE               => 'ممیزی مراقبتی مرحله اول',
            self::SECOND_CARE              => 'ممیزی مراقبتی مرحله دوم',
        };
    }

    public function getActionUrl($record): ?string
    {
        if ($record->type->is(QuestionTypes::SERVICE_REQUEST)) {
            return match ($this) {
                self::TECHNICAL_QUESTIONNAIRE  => ServiceRequestResource\Pages\TechnicalAttachment::getActionUrl($record),
                self::FIRST_AUDIT              => FirstAuditResource\Pages\CreateFirstAudit::getUrl(['question' => $record->id]),
                self::AUDIT_DURATION           => ServiceRequestResource\Pages\AuditDuration::getActionUrl($record),
                self::AUDIT_COST               => ServiceRequestResource\Pages\AuditCost::getActionUrl($record),
                self::UPLOAD_DOCUMENTS_BY_USER => null,
                default                        => null
            };
        }

        if ($record->type->is([QuestionTypes::FIRST_AUDIT, QuestionTypes::FIRST_CARE, QuestionTypes::SECOND_CARE])) {
            return match ($this) {
                self::FIRST_AUDIT           => FirstAuditResource\Pages\CreateFirstAudit::getUrl(),
                self::AUDIT_DATE_AND_TEAM   => FirstAuditResource\Pages\FirstAuditDateAndTeam::getActionUrl($record),
                self::AUDIT_MISSION_ORDER   => FirstAuditResource\Pages\FirstAuditMissionOrder::getActionUrl($record),
                self::AUDIT_WEEKLY_SCHEDULE => FirstAuditResource\Pages\FirstAuditWeeklySchedule::getActionUrl($record),
                self::AUDIT_PROGRAM         => FirstAuditResource\Pages\FirstAuditProgram::getActionUrl($record),
                self::AUDIT_REPORT          => FirstAuditResource\Pages\FirstAuditReport::getActionUrl($record),
                self::FIRST_CARE            => FirstAuditResource\Pages\CreateFirstAudit::getUrl(['record' => $record->id, 'type' => QuestionTypes::FIRST_CARE, 'question' => $record->questionable?->serviceRequest?->id]),
                self::SECOND_CARE           => FirstAuditResource\Pages\CreateFirstAudit::getUrl(['record' => $record->id, 'type' => QuestionTypes::SECOND_CARE, 'question' => $record->questionable?->serviceRequest?->id]),
                default                     => null
            };
        }

        if ($record->type->is(QuestionTypes::SECOND_AUDIT)) {
            return match ($this) {
                self::SECOND_AUDIT          => SecondAuditResource\Pages\CreateSecondAudit::getUrl(),
                self::AUDIT_DATE_AND_TEAM   => SecondAuditResource\Pages\SecondAuditDateAndTeam::getActionUrl($record),
                self::AUDIT_MISSION_ORDER   => SecondAuditResource\Pages\SecondAuditMissionOrder::getActionUrl($record),
                self::AUDIT_WEEKLY_SCHEDULE => SecondAuditResource\Pages\SecondAuditWeeklySchedule::getActionUrl($record),
                self::AUDIT_PROGRAM         => SecondAuditResource\Pages\SecondAuditProgram::getActionUrl($record),
                self::AUDIT_REPORT          => SecondAuditResource\Pages\SecondAuditReport::getActionUrl($record),
                self::AUDIT_RECORD_FORM     => SecondAuditResource\Pages\SecondAuditRecordForm::getActionUrl($record),
                self::FIRST_CARE            => FirstAuditResource\Pages\CreateFirstAudit::getUrl(['type' => QuestionTypes::FIRST_CARE]),
                self::SECOND_CARE           => FirstAuditResource\Pages\CreateFirstAudit::getUrl(['type' => QuestionTypes::SECOND_CARE]),
                default                     => null
            };
        }

        return null;
    }

    public function performed($record): bool
    {
        return match ($this) {
            self::TECHNICAL_QUESTIONNAIRE  => ! empty($record->questionable->technicalAttachment),
            self::AUDIT_DURATION           => ! empty($record->questionable->auditDuration),
            self::AUDIT_COST               => ! empty($record->questionable->auditCost),
            self::UPLOAD_DOCUMENTS_BY_USER => true,

            self::AUDIT_DATE_AND_TEAM   => ! empty($record->questionable->dateAndTeam),
            self::AUDIT_MISSION_ORDER   => ! empty($record->questionable->missionOrder),
            self::AUDIT_WEEKLY_SCHEDULE => ! empty($record->questionable->weeklySchedule),
            self::AUDIT_PROGRAM         => ! empty($record->questionable->auditProgram),
            self::AUDIT_REPORT          => ! empty($record->questionable->auditReport),
            self::AUDIT_RECORD_FORM     => ! empty($record->questionable->recordForm),

            default => true
        };
    }

    public static function getAction(QuestionStatus $status): ?QuestionAction
    {
        return match ($status) {
            QuestionStatus::REVIEW_BY_TECHNICAL_EXPERT   => self::TECHNICAL_QUESTIONNAIRE,
            QuestionStatus::AUDIT_PERIOD_FORM_COMPLETION => self::AUDIT_DURATION,
            QuestionStatus::AUDIT_COST_FORM_COMPLETION   => self::AUDIT_COST,

            QuestionStatus::SEND_TO_THE_FIRST_AUDIT_STAGE                              => self::FIRST_AUDIT,
            QuestionStatus::REGISTERED_IN_WAITING_FOR_FIRST_LEVEL_AUDIT_CUSTOMERS_LIST => self::FIRST_AUDIT,
            QuestionStatus::DETERMINING_FIRST_STAGE_AUDIT_DATE_AND_TEAM                => self::AUDIT_DATE_AND_TEAM,
            QuestionStatus::COMPLETING_MISSION_ORDER_FORM                              => self::AUDIT_MISSION_ORDER,
            QuestionStatus::UPDATE_AUDITOR_PROGRAM_NOTIFICATION_FORM                   => self::AUDIT_WEEKLY_SCHEDULE,
            QuestionStatus::COMPLETING_AUDIT_PROGRAM_FORM                              => self::AUDIT_PROGRAM,
            QuestionStatus::COMPLETING_FIRST_STAGE_AUDIT                               => self::AUDIT_REPORT,

            QuestionStatus::REGISTERED_IN_WAITING_FOR_SECOND_LEVEL_AUDIT_CUSTOMERS_LIST     => self::SECOND_AUDIT,
            QuestionStatus::DETERMINING_SECOND_STAGE_AUDIT_DATE_AND_TEAM                    => self::AUDIT_DATE_AND_TEAM,
            QuestionStatus::COMPLETING_SECOND_STAGE_AUDIT                                   => self::AUDIT_REPORT,
            QuestionStatus::COMPLETING_THE_CERTIFICATE_GRANTING_DECISION_MAKING_RECORD_FORM => self::AUDIT_RECORD_FORM,

            QuestionStatus::CUSTOMER_APPLIED_TO_RENEW_CERTIFICATE => self::FIRST_AUDIT,

            QuestionStatus::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_FIRST_CARE_AUDIT  => self::FIRST_CARE,
            QuestionStatus::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_SECOND_CARE_AUDIT => self::SECOND_CARE,

            default => null
        };
    }
}
