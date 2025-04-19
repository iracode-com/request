<?php

namespace App\Enums;

use App\Traits\BaseEnum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum QuestionStatus: int implements HasLabel, HasColor
{
    use BaseEnum;

    case COMPLETING_INFORMATION                                          = 0;
    case REVIEW_BY_TECHNICAL_EXPERT                                      = 1;
    case REVIEW_BY_TECHNICAL_MANAGER                                     = 2;
    case ACCEPTED_BY_TECHNICAL_MANAGER                                   = 3;
    case REJECTED_BY_TECHNICAL_MANAGER                                   = 4;
    case REGISTERED_IN_DISQUALIFIED_CUSTOMERS_LIST                       = 5;
    case AUDIT_PERIOD_FORM_COMPLETION                                    = 6;
    case AUDIT_COST_FORM_COMPLETION                                      = 7;
    case CHECKING_AUDIT_FORM_BY_CUSTOMER                                 = 8;
    case ACCEPTED_AUDIT_FORM_BY_CUSTOMER                                 = 9;
    case REJECTED_AUDIT_FORM_BY_CUSTOMER                                 = 10;
    case REGISTERED_IN_UNSUCCESSFUL_CUSTOMERS_LIST                       = 11;
    case COMPLETING_THE_CONTRACT                                         = 12;
    case REGISTERED_IN_SUCCESSFUL_CUSTOMERS_LIST                         = 13;
    case WAITING_FOR_UPLOADING_DOCUMENTS                                 = 14;
    case DOCUMENTS_UPLOADED_BY_CUSTOMER                                  = 15;
    case SEND_TO_THE_FIRST_AUDIT_STAGE                                   = 16;
    case REGISTERED_IN_WAITING_FOR_FIRST_LEVEL_AUDIT_CUSTOMERS_LIST      = 17;
    case DETERMINING_FIRST_STAGE_AUDIT_DATE_AND_TEAM                     = 18;
    case CHECKING_BY_AUDIT                                               = 19;
    case ACCEPTED_BY_AUDIT                                               = 20;
    case REJECTED_BY_AUDIT                                               = 21;
    case SELECT_THE_ALTERNATIVE_AUDIT                                    = 22;
    case COMPLETING_MISSION_ORDER_FORM                                   = 23;
    case CHECKING_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER                = 24;
    case ACCEPTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER                = 25;
    case REJECTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER                = 26;
    case UPDATE_AUDITOR_PROGRAM_NOTIFICATION_FORM                        = 27;
    case UPLOAD_AUDIT_PACKAGE                                            = 28;
    case COMPLETING_AUDIT_PROGRAM_FORM                                   = 29;
    case CHECKING_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER                     = 30;
    case ACCEPTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER                     = 31;
    case REJECTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER                     = 32;
    case ACCESS_AUDIT_PROGRAM_ANNOUNCEMENT_LETTER                        = 33;
    case ACCESS_AUDIT_DATE_ANNOUNCEMENT_LETTER                           = 34;
    case COMPLETING_FIRST_STAGE_AUDIT                                    = 35;
    case UPLOADING_FIRST_AUDIT_DOCUMENTS                                 = 36;
    case CHECKING_DOCUMENTS_BY_TECHNICAL_MANAGER                         = 37;
    case ACCEPTED_DOCUMENTS_BY_TECHNICAL_MANAGER                         = 38;
    case REJECTED_DOCUMENTS_BY_TECHNICAL_MANAGER                         = 39;
    case CHECKING_NONE_COMPLIANCE                                        = 40;
    case HAS_COMPLIANCE                                                  = 41;
    case HAS_NOT_COMPLIANCE                                              = 42;
    case WAITING_FOR_CORRECTIVE_ACTIONS                                  = 43;
    case CHECKING_CORRECTIVE_ACTIONS                                     = 44;
    case ACCEPTED_CORRECTIVE_ACTIONS                                     = 45;
    case REJECTED_CORRECTIVE_ACTIONS                                     = 46;
    case REGISTERED_IN_WAITING_FOR_SECOND_LEVEL_AUDIT_CUSTOMERS_LIST     = 47;
    case DETERMINING_SECOND_STAGE_AUDIT_DATE_AND_TEAM                    = 48;
    case COMPLETING_SECOND_STAGE_AUDIT                                   = 49;
    case UPLOADING_SECOND_AUDIT_DOCUMENTS                                = 50;
    case SELECT_TECHNICAL_REVIEW_TEAM                                    = 51;
    case CHECKING_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM                = 52;
    case ACCEPTED_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM                = 53;
    case REJECTED_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM                = 54;
    case REGISTER_IN_SPECIAL_CUSTOMERS_LIST                              = 55;
    case COMPLETING_THE_CERTIFICATE_GRANTING_DECISION_MAKING_RECORD_FORM = 56;
    case COMPLETING_CUSTOMER_CONFIRMATION_FORM                           = 57;
    case CHECKING_CUSTOMER_CONFIRMATION_FORM                             = 58;
    case ACCEPTED_CUSTOMER_CONFIRMATION_FORM                             = 59;
    case REJECTED_CUSTOMER_CONFIRMATION_FORM                             = 60;
    case COMPLETING_THE_DRAFT_CERTIFICATE                                = 61;
    case CHECKING_THE_DRAFT_CERTIFICATE                                  = 62;
    case ACCEPTED_THE_DRAFT_CERTIFICATE                                  = 63;
    case REJECTED_THE_DRAFT_CERTIFICATE                                  = 64;
    case CERTIFICATE_ISSUING                                             = 65;
    case REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_FIRST_CARE_AUDIT          = 66;
    case CUSTOMER_ACTION_TO_RENEW_CERTIFICATE                            = 67;
    case CUSTOMER_APPLIED_TO_RENEW_CERTIFICATE                           = 68;
    case CUSTOMER_NOT_APPLIED_TO_RENEW_CERTIFICATE                       = 69;
    case SEND_SMS_TO_CUSTOMER_AND_IT_MANAGER                             = 70;
    case RENEW_CERTIFICATE                                               = 71;
    case REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_SECOND_CARE_AUDIT         = 72;
    case NEED_FOR_AUDIT_ANNOUNCEMENT                                     = 73;
    case CERTIFICATE_SUSPENSION                                          = 74;
    case CERTIFICATE_REVOKE                                              = 75;


    public function getLabel(): ?string
    {
        return match ($this) {
            self::COMPLETING_INFORMATION                                          => 'تکمیل اطلاعات',
            self::REVIEW_BY_TECHNICAL_EXPERT                                      => 'بررسی توسط کارشناس فنی',
            self::REVIEW_BY_TECHNICAL_MANAGER                                     => 'بررسی توسط مدیر فنی',
            self::ACCEPTED_BY_TECHNICAL_MANAGER                                   => 'تایید شده توسط مدیر فنی',
            self::REJECTED_BY_TECHNICAL_MANAGER                                   => 'رد شده توسط مدیر فنی',
            self::REGISTERED_IN_DISQUALIFIED_CUSTOMERS_LIST                       => 'ثبت در لیست مشتریان خارج از صلاحیت',
            self::AUDIT_PERIOD_FORM_COMPLETION                                    => 'درحال تکمیل فرم مدت زمان ممیزی',
            self::AUDIT_COST_FORM_COMPLETION                                      => 'درحال تکمیل فرم هزینه ممیزی',
            self::CHECKING_AUDIT_FORM_BY_CUSTOMER                                 => 'بررسی فرم ممیزی توسط مشتری',
            self::ACCEPTED_AUDIT_FORM_BY_CUSTOMER                                 => 'فرم ممیزی توسط مشتری تایید شده',
            self::REJECTED_AUDIT_FORM_BY_CUSTOMER                                 => 'فرم ممیزی توسط مشتری رد شده',
            self::REGISTERED_IN_UNSUCCESSFUL_CUSTOMERS_LIST                       => 'ثبت در لیست مشتریان ناموفق',
            self::COMPLETING_THE_CONTRACT                                         => 'درحال تکمیل فرم قرار داد توسط مدیر فنی',
            self::REGISTERED_IN_SUCCESSFUL_CUSTOMERS_LIST                         => 'ثبت در لیست مشتریان موفق',
            self::WAITING_FOR_UPLOADING_DOCUMENTS                                 => 'درحال انتظار برای بارگزاری مدارک',
            self::DOCUMENTS_UPLOADED_BY_CUSTOMER                                  => 'مستندات توسط مشتری بارگزاری شدند',
            self::SEND_TO_THE_FIRST_AUDIT_STAGE                                   => 'انتقال به مرحله اول ممیزی',
            self::REGISTERED_IN_WAITING_FOR_FIRST_LEVEL_AUDIT_CUSTOMERS_LIST      => 'ثبت در فهرست مشتریان در انتظار ممیزي اول',
            self::DETERMINING_FIRST_STAGE_AUDIT_DATE_AND_TEAM                     => 'تعیین تاریخ و تیم ممیزي مرحله اول',
            self::CHECKING_BY_AUDIT                                               => 'بررسی توسط ممیز',
            self::ACCEPTED_BY_AUDIT                                               => 'تایید توسط ممیز',
            self::REJECTED_BY_AUDIT                                               => 'رد توسط ممیز',
            self::SELECT_THE_ALTERNATIVE_AUDIT                                    => 'انتخاب ممیز جایگزین',
            self::COMPLETING_MISSION_ORDER_FORM                                   => 'تکمیل فرم حکم ماموریت',
            self::CHECKING_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER                => 'بررسی فرم حکم ماموریت توسط مدیر فنی',
            self::ACCEPTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER                => 'تایید فرم حکم ماموریت توسط مدیر فنی',
            self::REJECTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER                => 'رد فرم حکم ماموریت توسط مدیر فنی',
            self::UPDATE_AUDITOR_PROGRAM_NOTIFICATION_FORM                        => 'برروزرسانی فرم اعلام برنامه ممیزان',
            self::UPLOAD_AUDIT_PACKAGE                                            => 'آپلود بسته ممیزی',
            self::COMPLETING_AUDIT_PROGRAM_FORM                                   => 'تکمیل فرم برنامه ممیزی',
            self::UPLOADING_FIRST_AUDIT_DOCUMENTS                                 => 'بارگزاری مدارک ممیزی اول',
            self::CHECKING_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER                     => 'بررسی برنامه ممیزی توسط مدیر فنی',
            self::ACCEPTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER                     => 'تایید برنامه ممیزی توسط مدیر فنی',
            self::REJECTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER                     => 'رد برنامه ممیزی توسط مدیر فنی',
            self::ACCESS_AUDIT_PROGRAM_ANNOUNCEMENT_LETTER                        => 'دسترسی به نامه اعلام برنامه ممیزی',
            self::ACCESS_AUDIT_DATE_ANNOUNCEMENT_LETTER                           => 'دسترسی به نامه اعلام تاریخ روز ممیزی',
            self::COMPLETING_FIRST_STAGE_AUDIT                                    => 'انجام ممیزی اول و تکمیل فرم گزارش ممیزی',
            self::CHECKING_DOCUMENTS_BY_TECHNICAL_MANAGER                         => 'بررسی مدارک توسط مدیر فنی',
            self::ACCEPTED_DOCUMENTS_BY_TECHNICAL_MANAGER                         => 'تایید مدارک توسط مدیر فنی',
            self::REJECTED_DOCUMENTS_BY_TECHNICAL_MANAGER                         => 'رد مدارک توسط مدیر فنی',
            self::CHECKING_NONE_COMPLIANCE                                        => 'بررسی عدم انطباق',
            self::HAS_COMPLIANCE                                                  => 'انطباق دارد',
            self::HAS_NOT_COMPLIANCE                                              => 'انطباق ندارد',
            self::WAITING_FOR_CORRECTIVE_ACTIONS                                  => 'در انتظار اقدامات اصلاحی',
            self::CHECKING_CORRECTIVE_ACTIONS                                     => 'بررسی اقدامات اصلاحی',
            self::ACCEPTED_CORRECTIVE_ACTIONS                                     => 'تایید اقدامات اصلاحی',
            self::REJECTED_CORRECTIVE_ACTIONS                                     => 'رد اقدامات اصلاحی',
            self::REGISTERED_IN_WAITING_FOR_SECOND_LEVEL_AUDIT_CUSTOMERS_LIST     => 'ثبت در فهرست مشتریان در انتظار ممیزي دوم',
            self::DETERMINING_SECOND_STAGE_AUDIT_DATE_AND_TEAM                    => 'تعیین تاریخ و تیم ممیزي مرحله دوم',
            self::UPLOADING_SECOND_AUDIT_DOCUMENTS                                => 'بارگزاری مدارک ممیزی دوم',
            self::COMPLETING_SECOND_STAGE_AUDIT                                   => 'انجام ممیزی دوم و تکمیل فرم گزارش ممیزی',
            self::SELECT_TECHNICAL_REVIEW_TEAM                                    => 'انتخاب تیم بازبین فنی شامل مدیر گواهی کردن بصورت ثابت و یک سرممیز',
            self::CHECKING_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM                => 'بررسی فرایند ممیزي و بازبینی فنی',
            self::ACCEPTED_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM                => 'تایید فرایند ممیزي و بازبینی فنی',
            self::REJECTED_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM                => 'رد فرایند ممیزي و بازبینی فنی',
            self::REGISTER_IN_SPECIAL_CUSTOMERS_LIST                              => 'ثبت در فهرست مشتریان خاص',
            self::COMPLETING_THE_CERTIFICATE_GRANTING_DECISION_MAKING_RECORD_FORM => 'تکمیل فرم صورتجلسه تصمیم گیري اعطاي گواهینامه',
            self::COMPLETING_CUSTOMER_CONFIRMATION_FORM                           => 'تکمیل فرم تاییدیه مشتري',
            self::CHECKING_CUSTOMER_CONFIRMATION_FORM                             => 'بررسی فرم تاییدیه مشتري',
            self::ACCEPTED_CUSTOMER_CONFIRMATION_FORM                             => 'تایید فرم تاییدیه مشتري',
            self::REJECTED_CUSTOMER_CONFIRMATION_FORM                             => 'رد فرم تاییدیه مشتري',
            self::COMPLETING_THE_DRAFT_CERTIFICATE                                => 'تکمیل پیش نویس گواهینامه',
            self::CHECKING_THE_DRAFT_CERTIFICATE                                  => 'بررسی پیش نویس',
            self::ACCEPTED_THE_DRAFT_CERTIFICATE                                  => 'تایید پیش نویس',
            self::REJECTED_THE_DRAFT_CERTIFICATE                                  => 'رد پیش نویس',
            self::CERTIFICATE_ISSUING                                             => 'صدور گواهینامه',
            self::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_FIRST_CARE_AUDIT          => 'ثبت مشتری در فهرست در انتظار ممیزی مراقبتی اول',
            self::CUSTOMER_ACTION_TO_RENEW_CERTIFICATE                            => 'اقدام کاربر جهت تمدید گواهینامه',
            self::CUSTOMER_APPLIED_TO_RENEW_CERTIFICATE                           => 'کاربر جهت تمدید گواهینامه اقدام کرده است',
            self::CUSTOMER_NOT_APPLIED_TO_RENEW_CERTIFICATE                       => 'کاربر جهت تمدید گواهینامه اقدام نکرده است',
            self::SEND_SMS_TO_CUSTOMER_AND_IT_MANAGER                             => 'ارسال پیامک براي مشتري و مدیر آي تی',
            self::RENEW_CERTIFICATE                                               => 'تمدید گواهینامه',
            self::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_SECOND_CARE_AUDIT         => 'ثبت در فهرست مشتریان در انتظار ممیزي مراقبتی دوم',
            self::NEED_FOR_AUDIT_ANNOUNCEMENT                                     => 'اعلام ضرورت انجام ممیزي بصورت ارسال پیامک',
            self::CERTIFICATE_SUSPENSION                                          => 'تعلیق گواهینامه',
            self::CERTIFICATE_REVOKE                                              => 'باطل کردن گواهینامه',
        };
    }

    public function getNextEnabledOptions(QuestionTypes $type, bool $toArray = false): self|array
    {
        $enabledOptions = [];

        if ($type->is(QuestionTypes::SERVICE_REQUEST)) {
            $enabledOptions = match ($this) {
                self::COMPLETING_INFORMATION                    => self::REVIEW_BY_TECHNICAL_EXPERT,
                self::REVIEW_BY_TECHNICAL_EXPERT                => self::REVIEW_BY_TECHNICAL_MANAGER,
                self::REVIEW_BY_TECHNICAL_MANAGER               => [
                    self::ACCEPTED_BY_TECHNICAL_MANAGER,
                    self::REJECTED_BY_TECHNICAL_MANAGER
                ],
                self::ACCEPTED_BY_TECHNICAL_MANAGER             => self::AUDIT_PERIOD_FORM_COMPLETION,
                self::REJECTED_BY_TECHNICAL_MANAGER             => self::REGISTERED_IN_DISQUALIFIED_CUSTOMERS_LIST,
                self::REGISTERED_IN_DISQUALIFIED_CUSTOMERS_LIST => [],
                self::AUDIT_PERIOD_FORM_COMPLETION              => self::AUDIT_COST_FORM_COMPLETION,
                self::AUDIT_COST_FORM_COMPLETION                => self::CHECKING_AUDIT_FORM_BY_CUSTOMER,
                self::CHECKING_AUDIT_FORM_BY_CUSTOMER           => [
                    self::REJECTED_AUDIT_FORM_BY_CUSTOMER,
                    self::ACCEPTED_AUDIT_FORM_BY_CUSTOMER
                ],
                self::REJECTED_AUDIT_FORM_BY_CUSTOMER           => self::REGISTERED_IN_UNSUCCESSFUL_CUSTOMERS_LIST,
                self::REGISTERED_IN_UNSUCCESSFUL_CUSTOMERS_LIST => [],
                self::ACCEPTED_AUDIT_FORM_BY_CUSTOMER           => self::COMPLETING_THE_CONTRACT,
                self::COMPLETING_THE_CONTRACT                   => self::REGISTERED_IN_SUCCESSFUL_CUSTOMERS_LIST,
                self::REGISTERED_IN_SUCCESSFUL_CUSTOMERS_LIST   => self::WAITING_FOR_UPLOADING_DOCUMENTS,
                self::WAITING_FOR_UPLOADING_DOCUMENTS           => self::DOCUMENTS_UPLOADED_BY_CUSTOMER,
                self::DOCUMENTS_UPLOADED_BY_CUSTOMER            => self::SEND_TO_THE_FIRST_AUDIT_STAGE,
                self::SEND_TO_THE_FIRST_AUDIT_STAGE             => self::REGISTERED_IN_WAITING_FOR_FIRST_LEVEL_AUDIT_CUSTOMERS_LIST,
                default                                         => []
            };
        }

        if ($type->is([QuestionTypes::FIRST_AUDIT, QuestionTypes::FIRST_CARE, QuestionTypes::SECOND_CARE])) {
            $enabledOptions = match ($this) {
                self::REGISTERED_IN_WAITING_FOR_FIRST_LEVEL_AUDIT_CUSTOMERS_LIST => self::DETERMINING_FIRST_STAGE_AUDIT_DATE_AND_TEAM,
                self::DETERMINING_FIRST_STAGE_AUDIT_DATE_AND_TEAM                => self::CHECKING_BY_AUDIT,
                self::CHECKING_BY_AUDIT                                          => [
                    self::REJECTED_BY_AUDIT,
                    self::ACCEPTED_BY_AUDIT
                ],
                self::REJECTED_BY_AUDIT                                          => self::SELECT_THE_ALTERNATIVE_AUDIT,
                self::SELECT_THE_ALTERNATIVE_AUDIT                               => self::CHECKING_BY_AUDIT,
                self::ACCEPTED_BY_AUDIT                                          => self::COMPLETING_MISSION_ORDER_FORM,
                self::COMPLETING_MISSION_ORDER_FORM                              => self::CHECKING_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                self::CHECKING_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER           => [
                    self::REJECTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                    self::ACCEPTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER
                ],
                self::REJECTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER           => self::SELECT_THE_ALTERNATIVE_AUDIT,
                self::ACCEPTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER           => self::UPDATE_AUDITOR_PROGRAM_NOTIFICATION_FORM,
                self::UPDATE_AUDITOR_PROGRAM_NOTIFICATION_FORM                   => self::UPLOAD_AUDIT_PACKAGE,
                self::UPLOAD_AUDIT_PACKAGE                                       => self::COMPLETING_AUDIT_PROGRAM_FORM,
                self::COMPLETING_AUDIT_PROGRAM_FORM                              => self::CHECKING_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                self::CHECKING_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER                => [
                    self::REJECTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                    self::ACCEPTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER
                ],
                self::REJECTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER                => self::COMPLETING_AUDIT_PROGRAM_FORM,
                self::ACCEPTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER                => self::ACCESS_AUDIT_PROGRAM_ANNOUNCEMENT_LETTER,
                self::ACCESS_AUDIT_PROGRAM_ANNOUNCEMENT_LETTER                   => self::ACCESS_AUDIT_DATE_ANNOUNCEMENT_LETTER,
                self::ACCESS_AUDIT_DATE_ANNOUNCEMENT_LETTER                      => self::COMPLETING_FIRST_STAGE_AUDIT,
                self::COMPLETING_FIRST_STAGE_AUDIT                               => self::UPLOADING_FIRST_AUDIT_DOCUMENTS,
                self::UPLOADING_FIRST_AUDIT_DOCUMENTS                            => self::CHECKING_DOCUMENTS_BY_TECHNICAL_MANAGER,
                self::CHECKING_DOCUMENTS_BY_TECHNICAL_MANAGER                    => [
                    self::REJECTED_DOCUMENTS_BY_TECHNICAL_MANAGER,
                    self::ACCEPTED_DOCUMENTS_BY_TECHNICAL_MANAGER
                ],
                self::REJECTED_DOCUMENTS_BY_TECHNICAL_MANAGER                    => self::UPLOADING_FIRST_AUDIT_DOCUMENTS,
                self::ACCEPTED_DOCUMENTS_BY_TECHNICAL_MANAGER                    => self::CHECKING_NONE_COMPLIANCE,
                self::CHECKING_NONE_COMPLIANCE                                   => [
                    self::HAS_COMPLIANCE,
                    self::HAS_NOT_COMPLIANCE
                ],
                self::HAS_COMPLIANCE                                             => self::REGISTERED_IN_WAITING_FOR_SECOND_LEVEL_AUDIT_CUSTOMERS_LIST,
                self::HAS_NOT_COMPLIANCE                                         => self::WAITING_FOR_CORRECTIVE_ACTIONS,
                self::WAITING_FOR_CORRECTIVE_ACTIONS                             => self::CHECKING_CORRECTIVE_ACTIONS,
                self::CHECKING_CORRECTIVE_ACTIONS                                => [
                    self::REJECTED_CORRECTIVE_ACTIONS,
                    self::ACCEPTED_CORRECTIVE_ACTIONS
                ],
                self::REJECTED_CORRECTIVE_ACTIONS                                => self::WAITING_FOR_CORRECTIVE_ACTIONS,
                self::ACCEPTED_CORRECTIVE_ACTIONS                                => self::REGISTERED_IN_WAITING_FOR_SECOND_LEVEL_AUDIT_CUSTOMERS_LIST,
                default                                                          => []
            };
        }

        if ($type->is(QuestionTypes::SECOND_AUDIT)) {
            $enabledOptions = match ($this) {
                self::REGISTERED_IN_WAITING_FOR_SECOND_LEVEL_AUDIT_CUSTOMERS_LIST     => self::DETERMINING_SECOND_STAGE_AUDIT_DATE_AND_TEAM,
                self::DETERMINING_SECOND_STAGE_AUDIT_DATE_AND_TEAM                    => self::CHECKING_BY_AUDIT,
                self::CHECKING_BY_AUDIT                                               => [
                    self::REJECTED_BY_AUDIT,
                    self::ACCEPTED_BY_AUDIT
                ],
                self::REJECTED_BY_AUDIT                                               => self::SELECT_THE_ALTERNATIVE_AUDIT,
                self::SELECT_THE_ALTERNATIVE_AUDIT                                    => self::CHECKING_BY_AUDIT,
                self::ACCEPTED_BY_AUDIT                                               => self::COMPLETING_MISSION_ORDER_FORM,
                self::COMPLETING_MISSION_ORDER_FORM                                   => self::CHECKING_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                self::CHECKING_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER                => [
                    self::REJECTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
                    self::ACCEPTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER
                ],
                self::REJECTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER                => self::SELECT_THE_ALTERNATIVE_AUDIT,
                self::ACCEPTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER                => self::UPDATE_AUDITOR_PROGRAM_NOTIFICATION_FORM,
                self::UPDATE_AUDITOR_PROGRAM_NOTIFICATION_FORM                        => self::UPLOAD_AUDIT_PACKAGE,
                self::UPLOAD_AUDIT_PACKAGE                                            => self::COMPLETING_AUDIT_PROGRAM_FORM,
                self::COMPLETING_AUDIT_PROGRAM_FORM                                   => self::CHECKING_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                self::CHECKING_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER                     => [
                    self::REJECTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER,
                    self::ACCEPTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER
                ],
                self::REJECTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER                     => self::COMPLETING_AUDIT_PROGRAM_FORM,
                self::ACCEPTED_AUDIT_PROGRAM_BY_TECHNICAL_MANAGER                     => self::ACCESS_AUDIT_PROGRAM_ANNOUNCEMENT_LETTER,
                self::ACCESS_AUDIT_PROGRAM_ANNOUNCEMENT_LETTER                        => self::ACCESS_AUDIT_DATE_ANNOUNCEMENT_LETTER,
                self::ACCESS_AUDIT_DATE_ANNOUNCEMENT_LETTER                           => self::COMPLETING_SECOND_STAGE_AUDIT,
                self::COMPLETING_SECOND_STAGE_AUDIT                                   => self::UPLOADING_SECOND_AUDIT_DOCUMENTS,
                self::UPLOADING_SECOND_AUDIT_DOCUMENTS                                => self::CHECKING_DOCUMENTS_BY_TECHNICAL_MANAGER,
                self::CHECKING_DOCUMENTS_BY_TECHNICAL_MANAGER                         => [
                    self::REJECTED_DOCUMENTS_BY_TECHNICAL_MANAGER,
                    self::ACCEPTED_DOCUMENTS_BY_TECHNICAL_MANAGER
                ],
                self::REJECTED_DOCUMENTS_BY_TECHNICAL_MANAGER                         => self::UPLOADING_SECOND_AUDIT_DOCUMENTS,
                self::ACCEPTED_DOCUMENTS_BY_TECHNICAL_MANAGER                         => self::CHECKING_NONE_COMPLIANCE,
                self::CHECKING_NONE_COMPLIANCE                                        => [
                    self::HAS_COMPLIANCE,
                    self::HAS_NOT_COMPLIANCE
                ],
                self::HAS_COMPLIANCE                                                  => self::SELECT_TECHNICAL_REVIEW_TEAM,
                self::HAS_NOT_COMPLIANCE                                              => self::WAITING_FOR_CORRECTIVE_ACTIONS,
                self::WAITING_FOR_CORRECTIVE_ACTIONS                                  => self::CHECKING_CORRECTIVE_ACTIONS,
                self::CHECKING_CORRECTIVE_ACTIONS                                     => [
                    self::REJECTED_CORRECTIVE_ACTIONS,
                    self::ACCEPTED_CORRECTIVE_ACTIONS
                ],
                self::REJECTED_CORRECTIVE_ACTIONS                                     => self::WAITING_FOR_CORRECTIVE_ACTIONS,
                self::ACCEPTED_CORRECTIVE_ACTIONS                                     => self::SELECT_TECHNICAL_REVIEW_TEAM,
                self::SELECT_TECHNICAL_REVIEW_TEAM                                    => self::CHECKING_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM,
                self::CHECKING_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM                => [
                    self::ACCEPTED_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM,
                    self::REJECTED_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM,
                ],
                self::ACCEPTED_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM                => self::COMPLETING_THE_CERTIFICATE_GRANTING_DECISION_MAKING_RECORD_FORM,
                self::REJECTED_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM                => self::REGISTER_IN_SPECIAL_CUSTOMERS_LIST,
                self::REGISTER_IN_SPECIAL_CUSTOMERS_LIST                              => self::REGISTERED_IN_SUCCESSFUL_CUSTOMERS_LIST,
                self::REGISTERED_IN_SUCCESSFUL_CUSTOMERS_LIST                         => [],
                self::COMPLETING_THE_CERTIFICATE_GRANTING_DECISION_MAKING_RECORD_FORM => self::COMPLETING_CUSTOMER_CONFIRMATION_FORM,
                self::COMPLETING_CUSTOMER_CONFIRMATION_FORM                           => self::CHECKING_CUSTOMER_CONFIRMATION_FORM,
                self::CHECKING_CUSTOMER_CONFIRMATION_FORM                             => [
                    self::ACCEPTED_CUSTOMER_CONFIRMATION_FORM,
                    self::REJECTED_CUSTOMER_CONFIRMATION_FORM,
                ],
                self::ACCEPTED_CUSTOMER_CONFIRMATION_FORM                             => self::COMPLETING_THE_DRAFT_CERTIFICATE,
                self::REJECTED_CUSTOMER_CONFIRMATION_FORM                             => self::COMPLETING_CUSTOMER_CONFIRMATION_FORM,
                self::COMPLETING_THE_DRAFT_CERTIFICATE                                => self::CHECKING_THE_DRAFT_CERTIFICATE,
                self::CHECKING_THE_DRAFT_CERTIFICATE                                  => [
                    self::ACCEPTED_THE_DRAFT_CERTIFICATE,
                    self::REJECTED_THE_DRAFT_CERTIFICATE,
                ],
                self::ACCEPTED_THE_DRAFT_CERTIFICATE                                  => self::CERTIFICATE_ISSUING,
                self::REJECTED_THE_DRAFT_CERTIFICATE                                  => self::COMPLETING_THE_DRAFT_CERTIFICATE,
                self::CERTIFICATE_ISSUING                                             => self::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_FIRST_CARE_AUDIT,
                self::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_FIRST_CARE_AUDIT          => [],
                default                                                               => []
            };
        }

        if ($type->is([QuestionTypes::FIRST_CARE])) {
            $enabledOptions = match ($this) {
                self::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_FIRST_CARE_AUDIT  => self::CUSTOMER_ACTION_TO_RENEW_CERTIFICATE,
                self::CUSTOMER_ACTION_TO_RENEW_CERTIFICATE                    => [
                    self::CUSTOMER_APPLIED_TO_RENEW_CERTIFICATE,
                    self::CUSTOMER_NOT_APPLIED_TO_RENEW_CERTIFICATE,
                ],
                self::CUSTOMER_APPLIED_TO_RENEW_CERTIFICATE                   => self::DETERMINING_FIRST_STAGE_AUDIT_DATE_AND_TEAM,
                self::CUSTOMER_NOT_APPLIED_TO_RENEW_CERTIFICATE               => [
                    self::NEED_FOR_AUDIT_ANNOUNCEMENT,
                    self::CERTIFICATE_SUSPENSION,
                    self::CERTIFICATE_REVOKE,
                ],
                self::NEED_FOR_AUDIT_ANNOUNCEMENT                             => [
                    self::CUSTOMER_APPLIED_TO_RENEW_CERTIFICATE,
                    self::CUSTOMER_NOT_APPLIED_TO_RENEW_CERTIFICATE,
                ],
                self::CERTIFICATE_SUSPENSION                                  => self::SEND_SMS_TO_CUSTOMER_AND_IT_MANAGER,
                self::SEND_SMS_TO_CUSTOMER_AND_IT_MANAGER                     => [
                    self::CUSTOMER_APPLIED_TO_RENEW_CERTIFICATE,
                    self::CUSTOMER_NOT_APPLIED_TO_RENEW_CERTIFICATE,
                ],
                self::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_SECOND_CARE_AUDIT => self::RENEW_CERTIFICATE,
                self::RENEW_CERTIFICATE                                       => self::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_SECOND_CARE_AUDIT,
                default                                                       => []
            };
        }

        if ($type->is([QuestionTypes::SECOND_CARE])) {
            $enabledOptions = match ($this) {
                self::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_FIRST_CARE_AUDIT => self::CUSTOMER_ACTION_TO_RENEW_CERTIFICATE,
                self::CUSTOMER_ACTION_TO_RENEW_CERTIFICATE                   => [
                    self::CUSTOMER_APPLIED_TO_RENEW_CERTIFICATE,
                    self::CUSTOMER_NOT_APPLIED_TO_RENEW_CERTIFICATE,
                ],
                self::CUSTOMER_APPLIED_TO_RENEW_CERTIFICATE                  => self::DETERMINING_FIRST_STAGE_AUDIT_DATE_AND_TEAM,
                self::CUSTOMER_NOT_APPLIED_TO_RENEW_CERTIFICATE              => [
                    self::NEED_FOR_AUDIT_ANNOUNCEMENT,
                    self::CERTIFICATE_SUSPENSION,
                    self::CERTIFICATE_REVOKE,
                ],
                self::NEED_FOR_AUDIT_ANNOUNCEMENT                            => [
                    self::CUSTOMER_APPLIED_TO_RENEW_CERTIFICATE,
                    self::CUSTOMER_NOT_APPLIED_TO_RENEW_CERTIFICATE,
                ],
                self::CERTIFICATE_SUSPENSION                                 => self::SEND_SMS_TO_CUSTOMER_AND_IT_MANAGER,
                self::SEND_SMS_TO_CUSTOMER_AND_IT_MANAGER                    => [
                    self::CUSTOMER_APPLIED_TO_RENEW_CERTIFICATE,
                    self::CUSTOMER_NOT_APPLIED_TO_RENEW_CERTIFICATE,
                ],
                self::RENEW_CERTIFICATE                                      => self::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_SECOND_CARE_AUDIT,
                default                                                      => []
            };
        }

        if ($toArray) {
            return self::toArray($enabledOptions);
        }

        return $enabledOptions;
    }

    public static function getOptions(bool $toArray = false): array
    {
        return RoleEnum::getRoleOptions($toArray);
    }

    public function getPending(QuestionTypes $type): int|array|null|self
    {
        if ($this->finished($type)) {
            return null;
        }

        return is_array($this->getNextEnabledOptions($type))
            ? $this
            : $this->getNextEnabledOptions($type);
    }

    public function getReferrer(): ?RoleEnum
    {
        foreach (RoleEnum::getRoleOptions() as $key => $value) {
            if (in_array($this, $value)) {
                return RoleEnum::getBy($key);
            }
        }

        return null;
    }

    public function getAction(): ?QuestionAction
    {
        return QuestionAction::getAction($this);
    }

    public function getColor(): ?string
    {
        return $this->getReferrer()?->getColor();
    }

    public static function commentableOptions(): array
    {
        return [
            self::REJECTED_BY_TECHNICAL_MANAGER,
            self::REJECTED_AUDIT_FORM_BY_CUSTOMER,
            self::REJECTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
            self::REJECTED_MISSION_ORDER_FORM_BY_TECHNICAL_MANAGER,
            self::REJECTED_AUDIT_PROCESS_AND_TECHNICAL_REVIEW_TEAM,
        ];
    }

    public static function hasToComment(null|string|self $value): bool
    {
        if (! $value instanceof self) {
            $value = self::getBy($value);
        }

        return in_array($value, self::commentableOptions());
    }

    public function finished(QuestionTypes $type): bool
    {
        return match ($this) {
            self::REGISTERED_IN_WAITING_FOR_FIRST_LEVEL_AUDIT_CUSTOMERS_LIST  => $type->is(QuestionTypes::SERVICE_REQUEST),

            self::REGISTERED_IN_WAITING_FOR_SECOND_LEVEL_AUDIT_CUSTOMERS_LIST => $type->is(QuestionTypes::FIRST_AUDIT),

            self::REGISTERED_IN_SUCCESSFUL_CUSTOMERS_LIST,
            self::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_FIRST_CARE_AUDIT      => $type->is(QuestionTypes::SECOND_AUDIT),

            self::REGISTER_CUSTOMER_IN_WAITING_LIST_FOR_SECOND_CARE_AUDIT,
            self::CERTIFICATE_REVOKE                                          => $type->is(QuestionTypes::FIRST_CARE),

            self::RENEW_CERTIFICATE,
            self::CERTIFICATE_REVOKE                                          => $type->is(QuestionTypes::SECOND_CARE),

            default                                                           => false,
        };
    }
}
