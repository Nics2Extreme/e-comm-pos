<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\CartUser;
use App\Models\Product;
use Filament\Actions\ActionGroup;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('product_image')->label('Product Image')
                    ->getStateUsing(function (Product $record) {
                        $url = "";

                        if ($record->product_image === NULL) {
                            $url = "https://placehold.co/600x400/png";
                        } else {
                            $path = $record->product_image;
                            $url = asset('storage/products/' . $path . '');
                        }

                        return '<img src="' . $url . '" style="height: 7rem;"/>';
                    })
                    ->html(),
                TextColumn::make('product_name')->label('Product Name'),
                TextColumn::make('selling_price')->label('Price')
                    ->getStateUsing(function (Product $record) {
                        $data = 'P' . $record->stock;
                        return $data;
                    }),
                TextColumn::make('stock')->label('In Stock')
                    ->getStateUsing(function (Product $record) {
                        $data = $record->stock . ' pcs left';
                        return $data;
                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Action::make('addToCart')
                    ->label(function (Product $record) {
                        $check = CartUser::where('customer_id', auth()->user()->id)
                            ->where('product_id', $record->id)
                            ->first();
                        if (!$check) {
                            return 'Add to cart';
                        } else {
                            return 'Remove from cart';
                        }
                    })
                    ->action(function (Product $record) {

                        $check = CartUser::where('customer_id', auth()->user()->id)
                            ->where('product_id', $record->id)
                            ->first();

                        if (!$check) {
                            // Insert cart user
                            $data = [
                                'product_id' => $record->id,
                                'customer_id' => auth()->user()->id,
                                'quantity' => 1
                            ];

                            CartUser::create($data);
                        } else {
                            // Update cart user
                            // $data = [
                            //     'product_id' => $check->id,
                            //     'customer_id' => auth()->user()->id,
                            //     'quantity' => $check->quantity + 1,
                            // ];

                            // CartUser::where('id', $check->id)->update($data);
                            CartUser::where('id', $check->id)->delete();
                        }

                        Notification::make()
                            ->title('Successfully added to cart!')
                            ->success()
                            ->send();
                    }),
                //Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            //'create' => Pages\CreateProduct::route('/create'),
            //'view' => Pages\ViewProduct::route('/{record}'),
            //'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
