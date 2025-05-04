<?php

namespace App\Filament\Resources\NormalUserRequestResource\Pages;

use App\Filament\Resources\NormalUserRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNormalUserRequest extends EditRecord
{
    protected static string $resource = NormalUserRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Generated with ClaudeAI
        $user = auth()->user();
        
        // Fill profile data
        if ($user->user_type == 1 && $user->profile) {
            $data['profile_national_code'] = $user->profile->national_code ?? null;
            $data['profile_birthdate'] = $user->profile->birthdate ?? null;
            $data['profile_fathername'] = $user->profile->fathername ?? null;
        } 
        // Fill corporation profile data
        elseif ($user->user_type == 2 && $user->corporationProfile) {
            $data['corp_company_code'] = $user->corporationProfile->company_code ?? null;
            $data['corp_company_name'] = $user->corporationProfile->company_name ?? null;
            $data['corp_company_owner_name'] = $user->corporationProfile->company_owner_name ?? null;
            $data['corp_company_owner_birthdate'] = $user->corporationProfile->company_owner_birthdate ?? null;
            $data['corp_company_owner_mobile'] = $user->corporationProfile->company_owner_mobile ?? null;
            $data['corp_company_owner_national_code'] = $user->corporationProfile->company_owner_national_code ?? null;
            $data['corp_phone'] = $user->corporationProfile->phone ?? null;
            $data['corp_address'] = $user->corporationProfile->address ?? null;
        }
        
        return $data;
    }
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Generated with ClaudeAI
        // Get user profile data
        $profileData = [];
        $corpProfileData = [];
        
        // Extract profile data based on user type
        $user = auth()->user();
        
        if ($user->user_type == 1) {
            // Extract individual profile data
            if (isset($data['profile_national_code'])) {
                $profileData['national_code'] = $data['profile_national_code'];
                unset($data['profile_national_code']);
            }
            
            if (isset($data['profile_birthdate'])) {
                $profileData['birthdate'] = $data['profile_birthdate'];
                unset($data['profile_birthdate']);
            }
            
            if (isset($data['profile_fathername'])) {
                $profileData['fathername'] = $data['profile_fathername'];
                unset($data['profile_fathername']);
            }
            
            // Save profile data if we have any
            if (!empty($profileData)) {
                $user->profile()->updateOrCreate(
                    ['user_id' => $user->id],
                    $profileData
                );
            }
        } elseif ($user->user_type == 2) {
            // Extract corporation profile data
            $corpFields = [
                'corp_company_code' => 'company_code',
                'corp_company_name' => 'company_name',
                'corp_company_owner_name' => 'company_owner_name',
                'corp_company_owner_birthdate' => 'company_owner_birthdate',
                'corp_company_owner_mobile' => 'company_owner_mobile',
                'corp_company_owner_national_code' => 'company_owner_national_code',
                'corp_phone' => 'phone',
                'corp_address' => 'address'
            ];
            
            foreach ($corpFields as $formField => $dbField) {
                if (isset($data[$formField])) {
                    $corpProfileData[$dbField] = $data[$formField];
                    unset($data[$formField]);
                }
            }
            
            // Save corporation profile data if we have any
            if (!empty($corpProfileData)) {
                $user->corporationProfile()->updateOrCreate(
                    ['user_id' => $user->id],
                    $corpProfileData
                );
            }
        }
        
        return $data;
    }
}
