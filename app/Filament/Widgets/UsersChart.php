<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersChart extends ChartWidget
{
    protected ?string $heading = 'User Distribution by Role';
    protected ?string $description = 'Overview of users assigned to each role';
    
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $admin = User::role('admin')->count();
        $user = User::role('user')->count();
        $unassigned = User::query()
            ->doesntHave('roles')
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Users by Role',
                    'data' => [$admin, $user, $unassigned],
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.8)',    // Blue for Admin
                        'rgba(139, 92, 246, 0.8)',    // Purple for User
                        'rgba(239, 68, 68, 0.8)',     // Red for Unassigned
                    ],
                    'borderColor' => [
                        '#1e40af',
                        '#6d28d9',
                        '#dc2626',
                    ],
                    'borderWidth' => 2,
                    'borderRadius' => 4,
                    'hoverBackgroundColor' => [
                        'rgba(59, 130, 246, 1)',
                        'rgba(139, 92, 246, 1)',
                        'rgba(239, 68, 68, 1)',
                    ],
                ],
            ],
            'labels' => ['Admin', 'User', 'Unassigned'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
            'responsive' => true,
            'maintainAspectRatio' => true,
            'scales' => [
                'x' => [
                    'ticks' => [
                        'stepSize' => 1,
                        'font' => [
                            'size' => 12,
                            'weight' => '500',
                        ],
                    ],
                    'grid' => [
                        'display' => true,
                        'drawBorder' => false,
                        'color' => 'rgba(0, 0, 0, 0.05)',
                    ],
                ],
                'y' => [
                    'ticks' => [
                        'font' => [
                            'size' => 12,
                            'weight' => '600',
                        ],
                    ],
                    'grid' => [
                        'display' => false,
                        'drawBorder' => false,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
                'tooltip' => [
                    'backgroundColor' => 'rgba(0, 0, 0, 0.8)',
                    'titleFont' => ['size' => 14, 'weight' => '600'],
                    'bodyFont' => ['size' => 13],
                    'padding' => 12,
                    'borderRadius' => 6,
                    'displayColors' => false,
                ],
            ],
        ];
    }
}
