<?php

namespace App\Filament\Resources\SalesOrders;

use App\Filament\Resources\SalesOrders\Pages\CreateSale;
use App\Filament\Resources\SalesOrders\Pages\EditSale;
use App\Filament\Resources\SalesOrders\Pages\ListSales;
use App\Models\Product;
use App\Models\Sale;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationLabel = 'Sales Orders';

    protected static ?string $modelLabel = 'Sales Order';

    protected static ?string $pluralModelLabel = 'Sales Orders';

    protected static string | \UnitEnum | null $navigationGroup = 'Sales';

    protected static ?int $navigationSort = 7;

    protected static ?string $slug = 'sales-orders';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Order details')
                    ->description('Record a customer order and its current payment status.')
                    ->schema([
                        TextInput::make('customer_name')
                            ->label('Customer')
                            ->required()
                            ->maxLength(255),
                        Select::make('product_or_service')
                            ->label('Product or service')
                            ->options(fn (): array => Product::query()
                                ->where('is_active', true)
                                ->orderBy('type')
                                ->orderBy('name')
                                ->get()
                                ->groupBy('type')
                                ->map(fn ($items): array => $items->pluck('name', 'name')->all())
                                ->all())
                            ->searchable()
                            ->native(false)
                            ->live()
                            ->afterStateUpdated(function (?string $state, Set $set): void {
                                $price = Product::query()
                                    ->where('is_active', true)
                                    ->where('name', $state)
                                    ->value('price');

                                $set('amount', $price !== null ? number_format((float) $price, 2, '.', '') : null);
                            })
                            ->required()
                            ->placeholder('Select a product or service'),
                        Select::make('amount')
                            ->label('Order amount')
                            ->prefix('PHP')
                            ->options(function (Get $get): array {
                                $selectedItem = $get('product_or_service');

                                if (filled($selectedItem)) {
                                    $price = Product::query()
                                        ->where('is_active', true)
                                        ->where('name', $selectedItem)
                                        ->value('price');

                                    return $price === null
                                        ? []
                                        : [number_format((float) $price, 2, '.', '') => 'PHP ' . number_format((float) $price, 2)];
                                }

                                return Product::query()
                                    ->where('is_active', true)
                                    ->orderBy('price')
                                    ->pluck('price')
                                    ->mapWithKeys(fn ($price): array => [
                                        number_format((float) $price, 2, '.', '') => 'PHP ' . number_format((float) $price, 2),
                                    ])
                                    ->all();
                            })
                            ->native(false)
                            ->required(),
                        DatePicker::make('transaction_date')
                            ->label('Order date')
                            ->default(now())
                            ->required(),
                        Select::make('payment_status')
                            ->label('Payment status')
                            ->options([
                                'Pending' => 'Pending',
                                'Paid' => 'Paid',
                                'Completed' => 'Completed',
                                'Cancelled' => 'Cancelled',
                            ])
                            ->default('Pending')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('product_or_service')
                    ->label('Product or service')
                    ->searchable(),
                TextColumn::make('amount')
                    ->money('PHP')
                    ->sortable(),
                TextColumn::make('transaction_date')
                    ->label('Order date')
                    ->date('M d, Y')
                    ->sortable(),
                TextColumn::make('payment_status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Paid', 'Completed' => 'success',
                        'Cancelled' => 'danger',
                        default => 'warning',
                    })
                    ->searchable(),
            ])
            ->defaultSort('transaction_date', 'desc')
            ->recordActions([
                \Filament\Actions\EditAction::make(),
            ])
            ->toolbarActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSales::route('/'),
            'create' => CreateSale::route('/create'),
            'edit' => EditSale::route('/{record}/edit'),
        ];
    }
}
