<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsChart extends ChartWidget
{
    protected ?string $heading = 'Permissions per Role';
    protected ?string $description = 'Number of permissions assigned to each role';
    
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $roles = Role::all();
        $roleNames = [];
        $permissionCounts = [];
        $colors = [
            'rgba(59, 130, 246, 0.8)',      // Blue
            'rgba(139, 92, 246, 0.8)',      // Purple
            'rgba(6, 182, 212, 0.8)',       // Cyan
            'rgba(236, 72, 153, 0.8)',      // Pink
            'rgba(245, 158, 11, 0.8)',      // Amber
            'rgba(34, 197, 94, 0.8)',       // Green
        ];
        $borderColors = [
            '#1e40af',
            '#6d28d9',
            '#0891b2',
            '#be185d',
            '#d97706',
            '#15803d',
        ];

        foreach ($roles as $index => $role) {
            $roleNames[] = ucfirst($role->name);
            $permissionCounts[] = $role->permissions()->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Permissions Count',
                    'data' => $permissionCounts,
                    'backgroundColor' => array_slice($colors, 0, count($roleNames)),
                    'borderColor' => array_slice($borderColors, 0, count($roleNames)),
                    'borderWidth' => 2,
                    'borderRadius' => 4,
                    'hoverBackgroundColor' => array_map(fn ($c) => str_replace('0.8)', '1)', $c), array_slice($colors, 0, count($roleNames))),
                ],
            ],
            'labels' => $roleNames,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => true,
            'indexAxis' => 'x',
            'scales' => [
                'y' => [
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
                'x' => [
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

