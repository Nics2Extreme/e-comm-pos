<?php

namespace App\Filament\Resources\CartUserResource\Pages;

use App\Filament\Resources\CartUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCartUser extends CreateRecord
{
    protected static string $resource = CartUserResource::class;
}
