<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RejectReason;
use Illuminate\Auth\Access\HandlesAuthorization;

class RejectReasonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_reject::reason');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RejectReason $rejectReason): bool
    {
        return $user->can('view_reject::reason');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_reject::reason');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RejectReason $rejectReason): bool
    {
        return $user->can('update_reject::reason');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RejectReason $rejectReason): bool
    {
        return $user->can('delete_reject::reason');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_reject::reason');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, RejectReason $rejectReason): bool
    {
        return $user->can('force_delete_reject::reason');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_reject::reason');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, RejectReason $rejectReason): bool
    {
        return $user->can('restore_reject::reason');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_reject::reason');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, RejectReason $rejectReason): bool
    {
        return $user->can('replicate_reject::reason');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_reject::reason');
    }
}
