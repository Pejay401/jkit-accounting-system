<?php

namespace App\Filament\Resources\Services;

use App\Filament\Resources\Services\Pages\CreateService;
use App\Filament\Resources\Services\Pages\EditService;
use App\Filament\Resources\Services\Pages\ListServices;
use App\Models\Product;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationLabel = 'Services';
    protected static ?string $modelLabel = 'Service';
    protected static ?string $pluralModelLabel = 'Services';
    protected static string | \UnitEnum | null $navigationGroup = 'Sales';
    protected static ?int $navigationSort = 4;
    protected static ?string $slug = 'services';

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('type', 'Service');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Service details')
                ->description('Maintain the services available for your sales workflow.')
                ->schema([
                    TextInput::make('name')->label('Service name')->required()->maxLength(255),
                    TextInput::make('sku')->label('Service code')->required()->unique(ignoreRecord: true)->maxLength(100),
                    Select::make('type')->options(['Service' => 'Service'])->default('Service')->required(),
                    Textarea::make('description')->rows(3)->columnSpanFull(),
                    TextInput::make('price')->numeric()->prefix('PHP')->minValue(0)->required(),
                    TextInput::make('stock_quantity')->label('Availability')->numeric()->integer()->minValue(0)->default(0)->required(),
                    Toggle::make('is_active')->label('Active service')->default(true),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->label('Service')->searchable()->sortable(),
            TextColumn::make('sku')->label('Service code')->searchable(),
            TextColumn::make('price')->money('PHP')->sortable(),
            IconColumn::make('is_active')->label('Active')->boolean(),
            TextColumn::make('updated_at')->label('Updated')->dateTime('M d, Y')->sortable(),
        ])->defaultSort('name')->recordActions([
            \Filament\Actions\EditAction::make(),
        ])->toolbarActions([
            \Filament\Actions\BulkActionGroup::make([
                \Filament\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServices::route('/'),
            'create' => CreateService::route('/create'),
            'edit' => EditService::route('/{record}/edit'),
        ];
    }
}
