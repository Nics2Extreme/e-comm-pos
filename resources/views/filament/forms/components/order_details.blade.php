<div class="w-100">
    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white block">
        Order Product(s)
    </span>
    <div class="flex mb-4">
        @foreach ($getState() as $order)
        <div class="max-w-md flex-1">
            <img class="img-fluid" src=" {{ $order->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/img/products/default.png') }}">

            <div class="p-5">
                <a href="#">
                    <h5 class="mb-3">{{$order->product->product_name}}</h5>
                </a>
                <p class="mb-3">P {{$order->product->selling_price}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>