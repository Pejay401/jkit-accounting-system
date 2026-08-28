<?php

namespace App\Filament\Widgets;

use App\Models\Sale;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SalesOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalOrders = Sale::query()->count();
        $totalValue = Sale::query()->sum('amount');
        $pendingValue = Sale::query()->where('payment_status', 'Pending')->sum('amount');

        return [
            Stat::make('Total orders', number_format($totalOrders))
                ->description('Sales orders recorded')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color('primary'),
            Stat::make('Total sales', 'PHP ' . number_format((float) $totalValue, 2))
                ->description('Value of all orders')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Pending value', 'PHP ' . number_format((float) $pendingValue, 2))
                ->description('Orders awaiting payment')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }
}
