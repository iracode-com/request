<?php

namespace App\Enums;

use App\Filament\Resources\Question\FirstAuditResource\Pages\CreateFirstAudit;
use App\Filament\Resources\Question\SecondAuditResource\Pages\CreateSecondAudit;
use App\Filament\Resources\Question\ServiceRequestResource\Pages\CreateServiceRequest;
use App\Traits\BaseEnum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Facades\Vite;

enum QuestionTypes: int implements HasLabel, HasDescription, HasColor
{
    use BaseEnum;

    case SERVICE_REQUEST = 0;
    case FIRST_AUDIT     = 1;
    case SECOND_AUDIT    = 2;
    case FIRST_CARE      = 3;
    case SECOND_CARE     = 4;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::SERVICE_REQUEST => 'ثبت اولیه',
            self::FIRST_AUDIT     => 'ممیزی مرحله اول',
            self::SECOND_AUDIT    => 'ممیزی مرحله دوم',
            self::FIRST_CARE      => 'ممیزی مراقبتی اول',
            self::SECOND_CARE     => 'ممیزی مراقبتی دوم',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::SERVICE_REQUEST => 'پرسشنامه درخواست ارائه خدمات ممیزی و صدور گواهینامه',
            self::FIRST_AUDIT     => 'تعیین تاریخ و تیم ممیزی مرحله اول',
            self::SECOND_AUDIT    => 'تعیین تاریخ و تیم ممیزی مرحله دوم',
            self::FIRST_CARE      => '(مراقبتی اول) تعیین تاریخ و تیم ممیزی مرحله اول',
            self::SECOND_CARE     => '(مراقبتی دوم) تعیین تاریخ و تیم ممیزی مرحله اول',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::SERVICE_REQUEST => 'warning',
            self::FIRST_AUDIT     => 'fuchsia',
            self::SECOND_AUDIT    => 'purple',
            self::FIRST_CARE      => 'cyan',
            self::SECOND_CARE     => 'teal',
        };
    }

    public function getOptions(): array
    {
        return match ($this) {
            self::SERVICE_REQUEST => [
                QuestionStatus::COMPLETING_INFORMATION,
                QuestionStatus::REVIEW_BY_TECHNICAL_EXPERT,
                QuestionStatus::REVIEW_BY_TECHNICAL_MANAGER,
                QuestionStatus::ACCEPTED_BY_TECHNICAL_MANAGER,
                QuestionStatus::REJECTED_BY_TECHNICAL_MANAGER,
                QuestionStatus::AUDIT_PERIOD_FORM_COMPLETION,
                QuestionStatus::REGISTERED_IN_DISQUALIFIED_CUSTOMERS_LIST,
                QuestionStatus::AUDIT_COST_FORM_COMPLETION,
                QuestionStatus::CHECKING_AUDIT_FORM_BY_CUSTOMER,
                QuestionStatus::REJECTED_AUDIT_FORM_BY_CUSTOMER,
                QuestionStatus::REGISTERED_IN_UNSUCCESSFUL_CUSTOMERS_LIST,
                QuestionStatus::ACCEPTED_AUDIT_FORM_BY_CUSTOMER,
                QuestionStatus::COMPLETING_THE_CONTRACT,
                QuestionStatus::REGISTERED_IN_SUCCESSFUL_CUSTOMERS_LIST,
                QuestionStatus::WAITING_FOR_UPLOADING_DOCUMENTS,
                QuestionStatus::DOCUMENTS_UPLOADED_BY_CUSTOMER,
                QuestionStatus::SEND_TO_THE_FIRST_AUDIT_STAGE,
                QuestionStatus::REGISTERED_IN_WAITING_FOR_FIRST_LEVEL_AUDIT_CUSTOMERS_LIST,
            ],
            self::SECOND_AUDIT    => [
                QuestionStatus::DETERMINING_SECOND_STAGE_AUDIT_DATE_AND_TEAM,
                QuestionStatus::CHECKING_BY_AUDIT,
                QuestionStatus::REJECTED_BY_AUDIT,
                QuestionStatus::SELECT_THE_ALTERNATIVE_AUDIT,
                QuestionStatus::ACCEPTED_BY_AUDIT,
                QuestionStatus::COMPLETING_MISSION_ORDER_FORM,
                QuestionStatus::CHECKING_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                QuestionStatus::REJECTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                QuestionStatus::ACCEPTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                QuestionStatus::UPDATE_AUDITOR_PROGRAM_NOTIFICATION_FORM,
                QuestionStatus::UPLOAD_AUDIT_PACKAGE,
                QuestionStatus::COMPLETING_AUDIT_PROGRAM_FORM,
                QuestionStatus::CHECKING_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                QuestionStatus::REJECTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                QuestionStatus::ACCESS_AUDIT_PROGRAM_ANNOUNCEMENT_LETTER,
                QuestionStatus::ACCESS_AUDIT_DATE_ANNOUNCEMENT_LETTER,
                QuestionStatus::COMPLETING_SECOND_STAGE_AUDIT,
                QuestionStatus::UPLOADING_SECOND_AUDIT_DOCUMENTS,
                QuestionStatus::CHECKING_DOCUMENTS_BY_TECHNICAL_MANAGER,
                QuestionStatus::REJECTED_DOCUMENTS_BY_TECHNICAL_MANAGER,
                QuestionStatus::ACCEPTED_DOCUMENTS_BY_TECHNICAL_MANAGER,
                QuestionStatus::CHECKING_NONE_COMPLIANCE,
                QuestionStatus::HAS_COMPLIANCE,
                QuestionStatus::SELECT_TECHNICAL_REVIEW_TEAM,
                QuestionStatus::HAS_NOT_COMPLIANCE,
                QuestionStatus::WAITING_FOR_CORRECTIVE_ACTIONS,
                QuestionStatus::CHECKING_CORRECTIVE_ACTIONS,
                QuestionStatus::REJECTED_CORRECTIVE_ACTIONS,
                QuestionStatus::ACCEPTED_CORRECTIVE_ACTIONS,
                QuestionStatus::CHECKING_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM,
                QuestionStatus::ACCEPTED_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM,
                QuestionStatus::REJECTED_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM,
                QuestionStatus::REGISTER_IN_SPECIAL_CUSTOMERS_LIST,
                QuestionStatus::REGISTERED_IN_SUCCESSFUL_CUSTOMERS_LIST,
                QuestionStatus::COMPLETING_THE_CERTIFICATE_GRANTING_DECISION_MAKING_RECORD_FORM,
                QuestionStatus::COMPLETING_CUSTOMER_CONFIRMATION_FORM,
                QuestionStatus::CHECKING_CUSTOMER_CONFIRMATION_FORM,
                QuestionStatus::ACCEPTED_CUSTOMER_CONFIRMATION_FORM,
                QuestionStatus::COMPLETING_THE_DRAFT_CERTIFICATE,
                QuestionStatus::REJECTED_CUSTOMER_CONFIRMATION_FORM,
                QuestionStatus::CHECKING_THE_DRAFT_CERTIFICATE,
                QuestionStatus::ACCEPTED_THE_DRAFT_CERTIFICATE,
                QuestionStatus::CERTIFICATE_ISSUING,
                QuestionStatus::REJECTED_THE_DRAFT_CERTIFICATE,
                QuestionStatus::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_FIRST_CARE_AUDIT,
            ],
            self::FIRST_AUDIT     => [
                QuestionStatus::DETERMINING_FIRST_STAGE_AUDIT_DATE_AND_TEAM,
                QuestionStatus::CHECKING_BY_AUDIT,
                QuestionStatus::REJECTED_BY_AUDIT,
                QuestionStatus::ACCEPTED_BY_AUDIT,
                QuestionStatus::COMPLETING_MISSION_ORDER_FORM,
                QuestionStatus::CHECKING_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                QuestionStatus::REJECTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                QuestionStatus::SELECT_THE_ALTERNATIVE_AUDIT,
                QuestionStatus::ACCEPTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                QuestionStatus::UPDATE_AUDITOR_PROGRAM_NOTIFICATION_FORM,
                QuestionStatus::UPLOAD_AUDIT_PACKAGE,
                QuestionStatus::COMPLETING_AUDIT_PROGRAM_FORM,
                QuestionStatus::CHECKING_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                QuestionStatus::REJECTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                QuestionStatus::ACCEPTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                QuestionStatus::ACCESS_AUDIT_PROGRAM_ANNOUNCEMENT_LETTER,
                QuestionStatus::ACCESS_AUDIT_DATE_ANNOUNCEMENT_LETTER,
                QuestionStatus::COMPLETING_FIRST_STAGE_AUDIT,
                QuestionStatus::CHECKING_DOCUMENTS_BY_TECHNICAL_MANAGER,
                QuestionStatus::REJECTED_DOCUMENTS_BY_TECHNICAL_MANAGER,
                QuestionStatus::UPLOADING_FIRST_AUDIT_DOCUMENTS,
                QuestionStatus::ACCEPTED_DOCUMENTS_BY_TECHNICAL_MANAGER,
                QuestionStatus::CHECKING_NONE_COMPLIANCE,
                QuestionStatus::HAS_COMPLIANCE,
                QuestionStatus::REGISTERED_IN_WAITING_FOR_SECOND_LEVEL_AUDIT_CUSTOMERS_LIST,
                QuestionStatus::HAS_NOT_COMPLIANCE,
                QuestionStatus::WAITING_FOR_CORRECTIVE_ACTIONS,
                QuestionStatus::CHECKING_CORRECTIVE_ACTIONS,
                QuestionStatus::REJECTED_CORRECTIVE_ACTIONS,
                QuestionStatus::ACCEPTED_CORRECTIVE_ACTIONS,
            ],
            self::FIRST_CARE      => [
                QuestionStatus::CUSTOMER_ACTION_TO_RENEW_CERTIFICATE,
                QuestionStatus::DETERMINING_FIRST_STAGE_AUDIT_DATE_AND_TEAM,
                QuestionStatus::CHECKING_BY_AUDIT,
                QuestionStatus::REJECTED_BY_AUDIT,
                QuestionStatus::ACCEPTED_BY_AUDIT,
                QuestionStatus::COMPLETING_MISSION_ORDER_FORM,
                QuestionStatus::CHECKING_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                QuestionStatus::REJECTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                QuestionStatus::SELECT_THE_ALTERNATIVE_AUDIT,
                QuestionStatus::ACCEPTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                QuestionStatus::UPDATE_AUDITOR_PROGRAM_NOTIFICATION_FORM,
                QuestionStatus::UPLOAD_AUDIT_PACKAGE,
                QuestionStatus::COMPLETING_AUDIT_PROGRAM_FORM,
                QuestionStatus::CHECKING_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                QuestionStatus::REJECTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                QuestionStatus::ACCEPTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                QuestionStatus::ACCESS_AUDIT_PROGRAM_ANNOUNCEMENT_LETTER,
                QuestionStatus::ACCESS_AUDIT_DATE_ANNOUNCEMENT_LETTER,
                QuestionStatus::COMPLETING_FIRST_STAGE_AUDIT,
                QuestionStatus::CHECKING_DOCUMENTS_BY_TECHNICAL_MANAGER,
                QuestionStatus::REJECTED_DOCUMENTS_BY_TECHNICAL_MANAGER,
                QuestionStatus::UPLOADING_FIRST_AUDIT_DOCUMENTS,
                QuestionStatus::ACCEPTED_DOCUMENTS_BY_TECHNICAL_MANAGER,
                QuestionStatus::CHECKING_NONE_COMPLIANCE,
                QuestionStatus::HAS_COMPLIANCE,
                QuestionStatus::REGISTERED_IN_WAITING_FOR_SECOND_LEVEL_AUDIT_CUSTOMERS_LIST,
                QuestionStatus::HAS_NOT_COMPLIANCE,
                QuestionStatus::WAITING_FOR_CORRECTIVE_ACTIONS,
                QuestionStatus::CHECKING_CORRECTIVE_ACTIONS,
                QuestionStatus::REJECTED_CORRECTIVE_ACTIONS,
                QuestionStatus::ACCEPTED_CORRECTIVE_ACTIONS,
                QuestionStatus::CUSTOMER_APPLIED_TO_RENEW_CERTIFICATE,
                QuestionStatus::CUSTOMER_NOT_APPLIED_TO_RENEW_CERTIFICATE,
                QuestionStatus::RENEW_CERTIFICATE,
                QuestionStatus::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_SECOND_CARE_AUDIT,
                QuestionStatus::NEED_FOR_AUDIT_ANNOUNCEMENT,
                QuestionStatus::CERTIFICATE_SUSPENSION,
                QuestionStatus::CERTIFICATE_REVOKE,
            ],
            self::SECOND_CARE     => [
                QuestionStatus::CUSTOMER_ACTION_TO_RENEW_CERTIFICATE,
                QuestionStatus::DETERMINING_FIRST_STAGE_AUDIT_DATE_AND_TEAM,
                QuestionStatus::CHECKING_BY_AUDIT,
                QuestionStatus::REJECTED_BY_AUDIT,
                QuestionStatus::ACCEPTED_BY_AUDIT,
                QuestionStatus::COMPLETING_MISSION_ORDER_FORM,
                QuestionStatus::CHECKING_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                QuestionStatus::REJECTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                QuestionStatus::SELECT_THE_ALTERNATIVE_AUDIT,
                QuestionStatus::ACCEPTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                QuestionStatus::UPDATE_AUDITOR_PROGRAM_NOTIFICATION_FORM,
                QuestionStatus::UPLOAD_AUDIT_PACKAGE,
                QuestionStatus::COMPLETING_AUDIT_PROGRAM_FORM,
                QuestionStatus::CHECKING_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                QuestionStatus::REJECTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                QuestionStatus::ACCEPTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                QuestionStatus::ACCESS_AUDIT_PROGRAM_ANNOUNCEMENT_LETTER,
                QuestionStatus::ACCESS_AUDIT_DATE_ANNOUNCEMENT_LETTER,
                QuestionStatus::COMPLETING_FIRST_STAGE_AUDIT,
                QuestionStatus::CHECKING_DOCUMENTS_BY_TECHNICAL_MANAGER,
                QuestionStatus::REJECTED_DOCUMENTS_BY_TECHNICAL_MANAGER,
                QuestionStatus::UPLOADING_FIRST_AUDIT_DOCUMENTS,
                QuestionStatus::ACCEPTED_DOCUMENTS_BY_TECHNICAL_MANAGER,
                QuestionStatus::CHECKING_NONE_COMPLIANCE,
                QuestionStatus::HAS_COMPLIANCE,
                QuestionStatus::REGISTERED_IN_WAITING_FOR_SECOND_LEVEL_AUDIT_CUSTOMERS_LIST,
                QuestionStatus::HAS_NOT_COMPLIANCE,
                QuestionStatus::WAITING_FOR_CORRECTIVE_ACTIONS,
                QuestionStatus::CHECKING_CORRECTIVE_ACTIONS,
                QuestionStatus::REJECTED_CORRECTIVE_ACTIONS,
                QuestionStatus::ACCEPTED_CORRECTIVE_ACTIONS,
                QuestionStatus::CUSTOMER_APPLIED_TO_RENEW_CERTIFICATE,
                QuestionStatus::CUSTOMER_NOT_APPLIED_TO_RENEW_CERTIFICATE,
                QuestionStatus::RENEW_CERTIFICATE,
                QuestionStatus::NEED_FOR_AUDIT_ANNOUNCEMENT,
                QuestionStatus::CERTIFICATE_SUSPENSION,
                QuestionStatus::CERTIFICATE_REVOKE,
            ],
        };
    }

    public function getImage(): ?string
    {
        return match ($this) {
            self::SERVICE_REQUEST => Vite::asset('resources/assets/images/questionnaire.jpeg'),
            self::FIRST_AUDIT     => Vite::asset('resources/assets/images/audit.jpg'),
            self::SECOND_AUDIT    => Vite::asset('resources/assets/images/second-audit.png'),
            self::FIRST_CARE      => Vite::asset('resources/assets/images/first-care.jpg'),
            self::SECOND_CARE     => Vite::asset('resources/assets/images/second-care.jpg'),
        };
    }

    public function getAction(): ?string
    {
        return match ($this) {
            self::SERVICE_REQUEST => CreateServiceRequest::getUrl(),
            self::FIRST_AUDIT     => CreateFirstAudit::getUrl(),
            self::SECOND_AUDIT    => CreateSecondAudit::getUrl(),
            self::FIRST_CARE      => CreateFirstAudit::getUrl(['type' => QuestionTypes::FIRST_CARE]),
            self::SECOND_CARE     => CreateFirstAudit::getUrl(['type' => QuestionTypes::SECOND_CARE]),
        };
    }

    public function getInformation(): ?string
    {
        return match ($this) {
            self::SERVICE_REQUEST => '<span>شماره سند: IHA/MC/FO/15</span><span>شماره بازنگری: 04</span>',
            self::FIRST_AUDIT     => '<span>شماره سند: IHA/MC/FO/20</span><span>شماره بازنگری: 04</span>',
            self::SECOND_AUDIT    => '<span>شماره سند: IHA/MC/FO/20</span><span>شماره بازنگری: 04</span>',
            self::FIRST_CARE      => '<span>شماره سند: IHA/MC/FO/20</span><span>شماره بازنگری: 04</span>',
            self::SECOND_CARE     => '<span>شماره سند: IHA/MC/FO/20</span><span>شماره بازنگری: 04</span>',
        };
    }

    public function canView(): bool
    {
        return match ($this) {
            self::SERVICE_REQUEST => true,
            self::FIRST_AUDIT     => ! auth()->user()->isCustomer(),
            self::SECOND_AUDIT    => ! auth()->user()->isCustomer(),
            self::FIRST_CARE      => ! auth()->user()->isCustomer(),
            self::SECOND_CARE     => ! auth()->user()->isCustomer(),
        };
    }
}