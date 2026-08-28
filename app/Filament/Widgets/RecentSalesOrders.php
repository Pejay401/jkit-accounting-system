<?php

namespace App\Filament\Widgets;

use App\Models\Sale;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentSalesOrders extends TableWidget
{
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Recent sales orders')
            ->query(Sale::query()->latest('transaction_date')->latest('id'))
            ->columns([
                TextColumn::make('customer_name')
                    ->label('Customer'),
                TextColumn::make('product_or_service')
                    ->label('Product or service'),
                TextColumn::make('amount')
                    ->money('PHP'),
                TextColumn::make('payment_status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Paid', 'Completed' => 'success',
                        'Cancelled' => 'danger',
                        default => 'warning',
                    }),
                TextColumn::make('transaction_date')
                    ->label('Order date')
                    ->date('M d, Y'),
            ])
            ->paginated(false);
    }
}
