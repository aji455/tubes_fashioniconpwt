<?php

namespace App\Filament\Resources\ShippingCosts;

use App\Filament\Resources\ShippingCosts\Pages\CreateShippingCost;
use App\Filament\Resources\ShippingCosts\Pages\EditShippingCost;
use App\Filament\Resources\ShippingCosts\Pages\ListShippingCosts;
use App\Filament\Resources\ShippingCosts\Schemas\ShippingCostForm;
use App\Filament\Resources\ShippingCosts\Tables\ShippingCostsTable;
use App\Models\ShippingCost;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ShippingCostResource extends Resource
{
    protected static ?string $model = ShippingCost::class;

   protected static ?string $navigationLabel = 'Metode Pengiriman';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-truck';   
    protected static string | UnitEnum | null $navigationGroup = 'Manajemen Toko';

    protected static ?string $recordTitleAttribute = 'ShippingCost';

    public static function form(Schema $schema): Schema
    {
        return ShippingCostForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShippingCostsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListShippingCosts::route('/'),
            'create' => CreateShippingCost::route('/create'),
            'edit' => EditShippingCost::route('/{record}/edit'),
        ];
    }
}
