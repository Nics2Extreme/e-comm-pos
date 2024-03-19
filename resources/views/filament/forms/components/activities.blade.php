<span class="text-sm font-medium leading-6 text-gray-950 dark:text-white block">
Order Activities
</span>
@foreach ($getState() as $order)
{{$order->product->product_name}}<br/>
@endforeach