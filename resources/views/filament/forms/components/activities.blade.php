<span class="text-sm mb-4 font-medium leading-6 text-gray-950 dark:text-white block">
    Order Status
</span>

@foreach ($getState() as $order)
    @if($order->order_status == 'pending')
        <div class="flex mb-4 p-4 border rounded-md border-gray-600">
            <div class="flex-1">
                <div class="flex gap-8">
                    <img src="{{ asset('assets/img/placed.png') }}" width="10%" alt="icon">
                    <div class="my-5">
                        <p class="text-3xl mx-5">You order has been placed!</p>
                        <p>Order {{ $order->invoice_no }} is being processed. Thank you!</p>
                    </div>
                </div>
            </div>
        </div>
    @elseif($order->order_status == 'delivery')
        <div class="flex mb-4 p-4 border rounded-md border-gray-600">
            <div class="flex-1">
                <div class="flex gap-8">
                    <img src="{{ asset('assets/img/delivery.png') }}" width="10%" alt="icon">
                    <div class="p-5">
                        <p class="text-3xl mx-auto">You order is on the way!</p>
                        <p>Order {{ $order->invoice_no }} has been dispatched. Thank you!</p>
                    </div>
                </div>
            </div>
        </div>
    @elseif($order->order_status == 'complete')
        <div class="flex mb-4 p-4 border rounded-md border-gray-600">
            <div class="flex-1">
                <div class="flex gap-8">
                    <img src="{{ asset('assets/img/complete.png') }}" width="10%" alt="icon">
                    <div class="p-5">
                        <p class="text-3xl mx-auto">You order has been completed!</p>
                        <p>Order {{ $order->invoice_no }} has been delivered. Thank you!</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach