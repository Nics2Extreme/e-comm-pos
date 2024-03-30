<?php

namespace App\Http\Controllers;

use App\Models\CartUser;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Dompdf\Dompdf;
use Dompdf\Options;

class OrderController extends Controller
{
    /**
     * Display a alll orders.
     */
    public function allOrders()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $orders = Order::sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('orders.all-orders', [
            'orders' => $orders
        ]);
    }

    /**
     * Display a pending orders.
     */
    public function pendingOrders()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $orders = Order::where('order_status', 'pending')
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('orders.pending-orders', [
            'orders' => $orders
        ]);
    }

    /**
     * Display a complete orders.
     */
    public function completeOrders()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $orders = Order::where('order_status', 'complete')
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('orders.complete-orders', [
            'orders' => $orders
        ]);
    }

    public function deliveryOrders()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $orders = Order::where('order_status', 'delivery')
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('orders.due-orders', [
            'orders' => $orders
        ]);
    }

    /**
     * Display an order details.
     */
    public function deliveryOrderDetails(String $order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $orderDetails = OrderDetails::with('product')
            ->where('order_id', $order_id)
            ->orderBy('id')
            ->get();

        return view('orders.details-due-order', [
            'order' => $order,
            'orderDetails' => $orderDetails,
        ]);
    }

    /**
     * Display an order details.
     */
    public function orderDetails(String $order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $orderDetails = OrderDetails::with('product')
            ->where('order_id', $order_id)
            ->orderBy('id')
            ->get();

        return view('orders.details-order', [
            'order' => $order,
            'orderDetails' => $orderDetails,
        ]);
    }

    /**
     * Handle create new order
     */
    public function createOrder(Request $request)
    {
        $rules = [
            'customer_id' => 'required|numeric',
            'payment_type' => 'required|string',
            'pay' => 'required|numeric',
        ];

        $invoice_no = IdGenerator::generate([
            'table' => 'orders',
            'field' => 'invoice_no',
            'length' => 10,
            'prefix' => 'INV-'
        ]);

        $validatedData = $request->validate($rules);

        $validatedData['order_date'] = Carbon::now()->format('Y-m-d');
        $validatedData['order_status'] = 'pending';
        $validatedData['total_products'] = Cart::count();
        $validatedData['sub_total'] = Cart::subtotal();
        $validatedData['vat'] = Cart::tax();
        $validatedData['invoice_no'] = $invoice_no;
        $validatedData['total'] = Cart::total();
        $validatedData['due'] = ((int)Cart::total() - (int)$validatedData['pay']);
        $validatedData['created_at'] = Carbon::now();

        $order_id = Order::insertGetId($validatedData);

        // Create Order Details
        $contents = Cart::content();
        $oDetails = array();

        foreach ($contents as $content) {
            $oDetails['order_id'] = $order_id;
            $oDetails['product_id'] = $content->id;
            $oDetails['quantity'] = $content->qty;
            $oDetails['unitcost'] = $content->price;
            $oDetails['total'] = $content->subtotal;
            $oDetails['created_at'] = Carbon::now();

            OrderDetails::insert($oDetails);
        }

        // Delete Cart Sopping History
        Cart::destroy();

        return Redirect::route('order.pendingOrders')->with('success', 'Order has been created!');
    }

    /**
     * Handle update for delivery status order
     */
    public function updateOrder(Request $request)
    {
        $order_id = $request->id;

        // Reduce the stock
        $products = OrderDetails::where('order_id', $order_id)->get();

        foreach ($products as $product) {
            Product::where('id', $product->product_id)
                    ->update(['stock' => DB::raw('stock-'.$product->quantity)]);
        }

        Order::findOrFail($order_id)->update(['order_status' => 'delivery']);

        return Redirect::route('order.completeOrders')->with('success', 'Order has been delivered!');
    }

    /**
     * Display delivery order details.
     */
    public function orderDeliveryDetails(String $order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $orderDetails = OrderDetails::with('product')
            ->where('order_id', $order_id)
            ->orderBy('id')
            ->get();

        return view('orders.details-order', [
            'order' => $order,
            'orderDetails' => $orderDetails,
        ]);
    }

    /**
     * Handle update a due pay order
     */
    public function updateDeliveryOrder(Request $request)
    {
        $order_id = $request->id;

        //Update the order status to complete
        Order::findOrFail($order_id)->update(['order_status' => 'complete']);

        return Redirect::route('order.completeOrders')->with('success', 'Order has been completed!');
    }

    /**
     * Handle to print an invoice.
     */
    public function downloadInvoice(Int $order_id)
    {
        $order = Order::with('customer')->where('id', $order_id)->first();
        $orderDetails = OrderDetails::with('product')
                        ->where('order_id', $order_id)
                        ->orderBy('id', 'DESC')
                        ->get();

        return view('orders.print-invoice', [
            'order' => $order,
            'orderDetails' => $orderDetails,
        ]);
    }

    public function callback() {
        $auth = Filament::auth();
        $user = $auth->user();

        $total = 0;
        if($user) {
            $carts =  CartUser::with('product')->where('customer_id', $user->id)->get();

            foreach($carts as $cart) {
                $product = Product::where('id', $cart->product_id)->first();
                $product->stock = $product->stock - $cart->quantity;
                $product->save();

                $total += $cart->quantity * $cart->product->selling_price;
            }
            $prefix = 'INV-';
            $date = date('Ymd');
            $random = mt_rand(1000, 9999);
            $invoiceNumber = $prefix . $date . '-' . $random;
            


            $order = Order::create([
                'customer_id' => $user->id,
                'order_date' => now()->__toString(),
                'order_status' => 'pending',
                'total_products' => count($carts),
                'sub_total' => $total,
                'total' => $total,
                'invoice_no' => $invoiceNumber,
                'payment_type' => 'GPAY',
                'pay' => $total,
                'vat' => 0,
                'due' => 0,
                'created_at' => now()->__toString()
            ]);

            foreach($carts as $cart) {
                OrderDetails::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'unitcost' => $cart->product->selling_price,
                    'total' => $cart->quantity * $cart->product->selling_price
                ]);
            }
            CartUser::where('customer_id', $user->id)->delete();
            $array = [
                'status' => 200,
                'message' => 'Order successfully!'
            ];
            echo json_encode($array);
        }
    }

    public function salesReport()
    {
        return view('orders.report-order');
    }

    public function exportSalesReport(Request $request){
        $rules = [
            'start_date' => 'required|string|date_format:Y-m-d',
            'end_date' => 'required|string|date_format:Y-m-d',
        ];

        $validatedData = $request->validate($rules);

        $sDate = $validatedData['start_date'];
        $eDate = $validatedData['end_date'];

        $sales = DB::table('orders')
            ->whereBetween('order_date',[$sDate,$eDate])
            ->where('order_status','complete')
            ->get();

        $options = new Options();
        $options->set('isRemoteEnabled', true); // Enable loading remote images
        $options->set("isPhpEnabled", true); //Enable PHP
        $dompdf = new Dompdf($options);

        $view = view('orders.sales',['sales' => $sales]);
        $dompdf->loadHtml($view);
        $dompdf->setPaper('Letter', 'portrait');
        $dompdf->render();
        return $dompdf->stream($sDate . ' to ' . $eDate .'.pdf', ['Attachment' => false]);

        
    }
}
