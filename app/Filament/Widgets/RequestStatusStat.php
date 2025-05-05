<?php

namespace App\Filament\Widgets;

use App\Enums\UserRequestState;
use App\Enums\UserRole;
use App\Models\UserRequest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RequestStatusStat extends BaseWidget
{
    protected static bool $isLazy = false;
    protected function getStats(): array
    {
        $isAdmin = current_user_has_role(UserRole::ADMIN);
        $lastRequestTitle = UserRequest::when($isAdmin, fn($query)=>$query->where('admin_user_id', auth()->id()))->when(!$isAdmin, fn($query)=>$query->where('user_id', auth()->id()))->orderBy('created_at','desc')->first()?->title;
        return [
            Stat::make(__("You Total Requests Count"), UserRequest::when($isAdmin, fn($query)=>$query->where('admin_user_id', auth()->id()))->when(!$isAdmin, fn($query)=>$query->where('user_id', auth()->id()))->count())
                ->chart([5,5,5,5]),
            Stat::make(__("You Pending Requests Count"), UserRequest::when($isAdmin, fn($query)=>$query->where('admin_user_id', auth()->id()))->when(!$isAdmin, fn($query)=>$query->where('user_id', auth()->id()))->where('status', UserRequestState::PENDING)->count())
                ->color('warning')
                ->chart([5,5,5,5]),
            Stat::make(__("You Approved Requests Count"), UserRequest::when($isAdmin, fn($query)=>$query->where('admin_user_id', auth()->id()))->when(!$isAdmin, fn($query)=>$query->where('user_id', auth()->id()))->where('status', UserRequestState::APPROVED)->count())
                ->color('success')
                ->chart([5,5,5,5]),
            Stat::make(__("You Rejected Requests Count"), UserRequest::when($isAdmin, fn($query)=>$query->where('admin_user_id', auth()->id()))->when(!$isAdmin, fn($query)=>$query->where('user_id', auth()->id()))->where('status', UserRequestState::REJECTED)->count())
                ->color('danger')
                ->chart([5,5,5,5]),
            Stat::make(__("You Closed Requests Count"), UserRequest::when($isAdmin, fn($query)=>$query->where('admin_user_id', auth()->id()))->when(!$isAdmin, fn($query)=>$query->where('user_id', auth()->id()))->where('status', UserRequestState::CLOSED)->count())
                ->chart([5,5,5,5]),
            Stat::make(__("Last Request"), $lastRequestTitle && strlen($lastRequestTitle) > 15 ? substr($lastRequestTitle, 0, 15).' ...' : ($lastRequestTitle ?? "---"))
                ->color('primary')
                ->chart([5,5,5,5]),
        ];
    }
}
