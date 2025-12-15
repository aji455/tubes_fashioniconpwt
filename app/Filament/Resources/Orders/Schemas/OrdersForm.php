<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Contracts\FormsSchema;
use App\Enums\ShippingStatus;
use App\Enums\OrderStatus;


class OrdersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pemesan')
                    ->columns(2)
                    ->schema([
                        TextInput::make('full_name')->required()->label('Nama Lengkap'),
                        TextInput::make('phone')->required()->label('Telepon'),
                        TextInput::make('email')->required()->email()->label('Email'),
                        TextInput::make('address')->required()->label('Alamat'),
                        TextInput::make('city')->required()->label('Kota'),
                        TextInput::make('province')->required()->label('Provinsi'),
                        TextInput::make('postal_code')->required()->label('Kode Pos'),
                        Textarea::make('notes')->label('Catatan')->rows(3),
                    ]),

                Section::make('Pengiriman & Total')
                    ->columns(2)
                    ->schema([
                        Select::make('shipping_costs_id')
                            ->relationship('shippingCost', 'name')
                            ->required()
                            ->label('Metode Pengiriman'),

                        TextInput::make('subtotal')->numeric()->required(),
                        TextInput::make('shipping_price')->numeric()->required()->label('Ongkir'),
                        TextInput::make('total')->numeric()->required(),

                        Select::make('shipping_status')
                            ->label('Status Pengiriman')
                            ->options(ShippingStatus::class)
                            ->required(),
                        Select::make('payment_status')
                            ->label('Status Pembayaran')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                            ])
                            ->required(),

                        Select::make('status')
                            ->label('Status Pesanan')
                            ->options(OrderStatus::class)
                            ->required(),
                    ]),

                Section::make('Items Pesanan')
                    ->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                TextInput::make('product_id')->label('Produk ID')->required(),
                                TextInput::make('name')->required(),
                                TextInput::make('size')->required(),
                                TextInput::make('color')->required(),
                                TextInput::make('qty')->numeric()->required(),
                                TextInput::make('price')->numeric()->required(),
                                TextInput::make('subtotal')->numeric()->required(),
                            ])
                            ->columns(3)
                            ->label('Daftar Item'),
                    ]),
            ]);
    }
}
