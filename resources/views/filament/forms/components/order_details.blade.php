<span class="text-sm font-medium leading-6 text-gray-950 dark:text-white block">
Order Product(s)
</span>
@foreach ($getState() as $order)
    
    <div class="flex-1">
    <div class="w-2/3 h-48 p-2 bg-white-200  
                        border-2 border-slate-200  
                        rounded-lg flex flex-row  
                        mx-auto mt-6" > 
            <div class="w-3/12 h-full"> 
                <img class="pl-4 pt-2 w-72 h-32"
                    src="{{ asset('assets/img/products/default.png') }}" /> 
            </div> 
            <div class="w-6/12 h-full p-2 "> 
                <h3 class="pl-4 pt-2 text-2xl">{{$order->product->product_name}}</h3>
            </div> 
            <div class="w-3/12 h-full border-l-4 p-2"> 
                <div class="flex flex-row items-center "> 
                    <h4 class="text-lg">
                        P{{$order->product->selling_price}} 
                    </h4> 
                </div>
            </div> 
        </div> 
</div>
@endforeach