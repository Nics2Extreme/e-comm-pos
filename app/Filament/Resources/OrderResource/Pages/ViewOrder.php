<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Pages\ViewRecord;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        $schema = [
            ViewField::make('activities')
                ->view('filament.forms.components.activities')
                ->formatStateUsing(function (Order $record) { //adds the initial state on page load
                    $data = Order::where('customer_id', auth()->user()->id)
                                    ->where('id', $record->id)
                                    ->get();

                    return $data;
                })
                ->columnSpan(2),
            Select::make('customer_id')
                ->label('Customer')
                ->native(false)
                ->lazy()
                ->options(function (): array {
                    return Customer::all()->where('id', auth()->user()->id)->mapWithKeys(function ($user) {
                        return [$user->id => $user->name];
                    })->toArray();
                }),
            TextInput::make('payment_type')->label('Payment Type'),
            TextInput::make('invoice_no')->label('Invoice #'),
            TextInput::make('total')->label('Total Amount'),
            DateTimePicker::make('order_date')->label('Order Date'),
            ViewField::make('image')
                ->view('filament.forms.components.order_details')
                ->formatStateUsing(function (Order $record) { //adds the initial state on page load
                    $data = OrderDetails::where('order_id', $record->id)->get();
                    return $data;
                })
                ->columnSpan(2),
        ];
        return $form->schema($schema);
    }
}
