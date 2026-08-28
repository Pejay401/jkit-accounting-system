<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages\CreateSale;
use App\Filament\Resources\SaleResource\Pages\EditSale;
use App\Filament\Resources\SaleResource\Pages\ListSales;
use App\Models\Sale;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
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
                        TextInput::make('product_or_service')
                            ->label('Product or service')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('amount')
                            ->label('Order amount')
                            ->numeric()
                            ->prefix('PHP')
                            ->minValue(0)
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
