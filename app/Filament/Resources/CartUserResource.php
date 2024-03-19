<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CartUserResource\Pages;
use App\Filament\Resources\CartUserResource\RelationManagers;
use App\Models\CartUser;
use App\Models\Customer;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CartUserResource extends Resource
{
    protected static ?string $label = 'Cart';

    protected static ?string $model = CartUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                //
                Select::make('product_id')
                    ->label('Product')
                    ->native(false)
                    ->reactive()
                    ->options(function (): array {
                        return Product::all()->mapWithKeys(function ($product) {
                            return [$product->id => $product->product_name];
                        })->toArray();
                    }),

                Select::make('customer_id')
                    ->label('Customer')
                    ->native(false)
                    ->lazy()
                    ->options(function (): array {
                        return Customer::all()->where('id', auth()->user()->id)->mapWithKeys(function ($user) {
                            return [$user->id => $user->name];
                        })->toArray();
                    })
                    ->hidden(),
                TextInput::make('quantity')
                    ->type('number'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('product.product_name')->label('Product Name'),
                TextColumn::make('quantity'),
                TextColumn::make('quantityXprice')->label('Price')
                    ->getStateUsing(function (CartUser $record) {
                        $product = Product::where('id', $record->product_id)->first();

                        $quantity = $record->quantity * $product->selling_price;

                        return 'P' . $quantity;
                    }),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListCartUsers::route('/'),
            // 'create' => Pages\CreateCartUser::route('/create'),
            'edit' => Pages\EditCartUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('customer_id', auth()->user()->id);
    }
}
