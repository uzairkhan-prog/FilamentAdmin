<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use App\Filament\Widgets\DashboardStats;
use App\Filament\Widgets\UsersChart;
use App\Filament\Widgets\PermissionsChart;

class Dashboard extends BaseDashboard
{
    public function getTitle(): string
    {
        return 'Admin Dashboard';
    }

    public function getWidgets(): array
    {
        return [
            DashboardStats::class,
            UsersChart::class,
            PermissionsChart::class,
        ];
    }

    public function getColumns(): int|array
    {
        return 3;
    }
}