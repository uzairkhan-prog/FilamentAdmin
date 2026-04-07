<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Filament\Support\Enums\IconPosition;

class DashboardStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('All registered users')
                ->descriptionIcon('heroicon-m-users', IconPosition::Before)
                ->color('primary')
                ->icon('heroicon-o-users'),
            
            Stat::make('Total Roles', Role::count())
                ->description('System roles available')
                ->descriptionIcon('heroicon-m-shield-check', IconPosition::Before)
                ->color('success')
                ->icon('heroicon-o-shield-check'),
            
            Stat::make('Total Permissions', Permission::count())
                ->description('Defined permissions')
                ->descriptionIcon('heroicon-m-lock-closed', IconPosition::Before)
                ->color('warning')
                ->icon('heroicon-o-lock-closed'),
            
            Stat::make('Admin Users', User::role('admin')->count())
                ->description('Super administrators')
                ->descriptionIcon('heroicon-m-star', IconPosition::Before)
                ->color('danger')
                ->icon('heroicon-o-star'),
        ];
    }
}

