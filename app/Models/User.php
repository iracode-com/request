<?php

namespace App\Models;

use App\Enums\RoleEnum;
use App\Enums\Status;
use App\Enums\UserRole;
use App\Models\Organization;
use App\Models\ServiceRequest;
use App\Models\Profile;
use App\Models\UserOrganizationalInformation;
use App\Observers\UserObserver;
use App\Traits\Trait\HasRoles;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

#[ObservedBy(UserObserver::class)]
class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable, HasRoles, HasPanelShield;

    protected $fillable = [
        'name',
        'family',
        'email',
        'password',
        'mobile',
        'mobile_verified_at',
        'avatar_url',
        'user_type',
        'role',
        'ip',
        'agent',
        'last_login',
        'banned_until',
        'must_password_reset',
        'can_password_reset',
        'password_never_expires',
        'status',
        'sso_id',
        'sso_data',
        'sso_synced_at',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at'  => 'datetime',
            'mobile_verified_at' => 'datetime',
            'banned_until'       => 'datetime',
            'password'           => 'hashed',
            'role'               => UserRole::class,
            // 'status'             => Status::class,
            'sso_synced_at'      => 'datetime',
            'sso_data'           => 'array',
        ];
    }

    public const USER_TYPES = [
        1 => 'حقیقی',
        2 => 'حقوقی',
    ];

    public function isActive(): bool
    {
        if ($this->status == Status::INACTIVE) {
            return false;
        }

        if (is_null($this->mobile_verified_at) && is_null($this->sso_synced_at)) {
            return false;
        }

        if (filled($this->banned_until)) {
            return false;
        }

        return true;
    }


    // can access panel if is either `admin` or `active`
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isActive();
        // $this->role == UserRole::ADMIN || $this->isActive();
    }

    public function canResetUsersPassword(): bool
    {
        return $this->isSuperAdmin();
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url($this->avatar_url) : null;
    }

    // Relationships

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function corporationProfile(): HasOne
    {
        return $this->hasOne(CorporationProfile::class);
    }

    public function otps(): HasMany
    {
        return $this->hasMany(Otp::class);
    }
}
