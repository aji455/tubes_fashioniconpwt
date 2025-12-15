<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Filters\SelectFilter;

use App\Enums\OrderStatus;
use App\Enums\ShippingStatus;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('user.name')->label('Pelanggan')->sortable()->searchable(),
                TextColumn::make('full_name')->label('Nama Lengkap')->sortable(),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('phone')->label('Telepon'),

                SelectColumn::make('shipping_status')
                    ->label('Status Pengiriman')
                    ->options(ShippingStatus::class)
                    ->sortable(),

                SelectColumn::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                    ])
                    ->sortable(),

                SelectColumn::make('status')
                    ->label('Status Pesanan')
                    ->options(OrderStatus::class)
                    ->sortable(),

                TextColumn::make('total')->label('Total')->money('IDR', true),
                TextColumn::make('created_at')->label('Tanggal')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('status')->options(OrderStatus::class),
                SelectFilter::make('shipping_status')->options(ShippingStatus::class),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
