<?php

namespace App\Filament\Resources\CartUserResource\Pages;

use App\Filament\Resources\CartUserResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListCartUsers extends ListRecords
{
    protected static string $resource = CartUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Checkout')->url(route('order.index'))
        ];
    }
}
