<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TokenService
{

    public function create(User $user, string $name, bool $clearOldToken = true): string
    {
        if ($clearOldToken) {
            $this->revokeAll($user, $name);
        }

        return $user->createToken($name)->plainTextToken;
    }

    public function revokeAll(User $user, ?string $name = null): void
    {
        $user->tokens()
            ->when(
                $name,
                fn(Builder $query) => $query->where('name', $name)
            )
            ->delete();
    }
}
