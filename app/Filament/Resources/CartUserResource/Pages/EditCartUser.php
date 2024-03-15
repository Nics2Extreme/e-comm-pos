<?php

namespace App\Filament\Resources\CartUserResource\Pages;

use App\Filament\Resources\CartUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCartUser extends EditRecord
{
    protected static string $resource = CartUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
