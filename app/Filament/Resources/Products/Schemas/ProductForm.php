<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use App\Models\Category;
use Filament\Forms\Components\TagsInput;

class ProductForm
{

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->required(),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->reactive(),
        
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->rows(4),

                TextInput::make('price')
                    ->numeric()
                    ->required(),

                TextInput::make('stock')
                    ->numeric()
                    ->required(),

                TagsInput::make('size')
                    ->label('Size Tersedia')
                    ->placeholder('Tambahkan size...'),

                TagsInput::make('color')
                    ->label('Color Tersedia')
                    ->placeholder('Tambahkan color...'),

                FileUpload::make('main_image')
                    ->label('Gambar Utama')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->nullable(),
            ]);
    }
}
