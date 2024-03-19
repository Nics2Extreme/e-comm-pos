<section>
    <div class="w-full px-4 md:px-5 mx-auto revieworder">
        <div class="mx-4 md:mx-auto my-20 flex flex-col">
          <div class="main-box border border-gray-200 rounded-xl pt-6 mb-4 max-w-xl max-lg:mx-auto lg:max-w-full">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between px-6 pb-6 border-b border-gray-200">
              <h1 class="text-3xl bold">Order Summary</h1>
            </div>
            <?php
            $total = 0;
            ?>
            @foreach($carts as $cart)
            <?php
            $total += $cart->product->selling_price * $cart->quantity;
            ?>
            <div class="w-full px-3 min-[400px]:px-6">
              <div class="flex flex-col lg:flex-row items-center py-6 border-b border-gray-200 gap-6 w-full">
                <div class="img-box max-lg:w-full">
                  <img src=" {{ $cart->product->product_image ? asset('storage/products/'.$cart->product->product_image) : asset('assets/img/products/default.png') }}" alt="Product image" class="aspect-square w-full lg:max-w-[140px]">
                </div>
                <div class="flex flex-row items-center w-full ">
                  <div class="grid grid-cols-1 lg:grid-cols-2 w-full">
                    <div class="flex items-center">
                      <div class="">
                        <h2 class="font-semibold text-xl leading-8 text-black mb-3">
                          {{$cart->product->product_name}}
                        </h2>
                        <div class="flex items-center "> 
                          <p class="font-medium text-base leading-7 text-black ">Qty: <span class="text-gray-500">x{{$cart->quantity}}</span></p>
                        </div>
                      </div>

                    </div>
                    <div class="grid grid-cols-5">
                      <div class="col-span-4 lg:col-span-1 flex items-center max-lg:mt-3">
                        <div class="flex gap-3 lg:block">
                          <p class="font-medium text-sm leading-7 text-black">Unit Price</p>
                          <p class="lg:mt-4 font-medium text-sm leading-7 text-indigo-600">P{{$cart->product->selling_price}}</p>
                        </div>
                        <div class="flex gap-3 lg:block">
                          <p class="font-medium text-sm leading-7 text-black">Total</p>
                          <p class="lg:mt-4 font-medium text-sm leading-7 text-indigo-600">P{{$cart->product->selling_price * $cart->quantity}}</p>
                        </div>
                      </div>
                      <div class="col-span-5 lg:col-span-2 flex items-center max-lg:mt-3 ">
                        <div class="flex gap-3 lg:block">
                          <p class="font-medium text-sm leading-7 text-black">Status
                          </p>
                          <p class="font-medium text-sm leading-6 whitespace-nowrap py-0.5 px-3 rounded-full lg:mt-3 bg-emerald-50 text-emerald-600">
                            Ready for Delivery</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            <div class="w-full border-t border-gray-200 px-6 flex flex-col lg:flex-row items-center justify-between ">
              <div class="flex flex-col sm:flex-row items-center max-lg:border-b border-gray-200">
                <button class="flex outline-0 py-6 sm:pr-6  sm:border-r border-gray-200 whitespace-nowrap gap-2 items-center justify-center font-semibold group text-lg text-black bg-white transition-all duration-500 hover:text-indigo-600">
                  <svg class="stroke-black transition-all duration-500 group-hover:stroke-indigo-600" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                    <path d="M5.5 5.5L16.5 16.5M16.5 5.5L5.5 16.5" stroke="" stroke-width="1.6" stroke-linecap="round" />
                  </svg>
                  Cancel Order
                </button>
              </div>
              <p class="font-semibold text-lg text-black py-6">Total Price: <span class="text-indigo-600">{{ $total }}</span></p>
            </div>
          </div>
          <button id="checkout" type="button" class="{{$total == 0 ? 'disabled' : ''}}focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" {{$total == 0 ? 'disabled' : ''}}>Checkout</button>
        </div>
    </div>
    <div class="billing mx-4 px-4" style="display: none;">
      <h1 class="text-2xl font-bold mb-2">Billing</h1>
      <div id="pay-now"></div>
      <button id="back-billing" type="button" class="mt-2 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Back</button>
    </div>
</section>
<script type="text/javascript">
    $('#checkout').click(function() {
        $('.revieworder').slideToggle();
        $('.billing').slideToggle();
    })

    $('#back-billing').click(function() {
        $('.revieworder').slideToggle();
        $('.billing').slideToggle();
    });
</script>
<script type="text/javascript">
    const payment = {
  'company': 'POS', // Company Name
  'id': 0, // User ID
  'money': {{$total}} // Overall Amount
};

const baseRequest = {
  apiVersion: 2,
  apiVersionMinor: 0
};
    
const allowedCardNetworks = ["AMEX", "DISCOVER", "INTERAC", "JCB", "MASTERCARD", "VISA"];
    
const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];
    
const tokenizationSpecification = {
  type: 'PAYMENT_GATEWAY',
  parameters: {
    'gateway': 'example',
    'gatewayMerchantId': 'exampleGatewayMerchantId'
  }
};
    
const baseCardPaymentMethod = {
  type: 'CARD',
  parameters: {
    allowedAuthMethods: allowedCardAuthMethods,
    allowedCardNetworks: allowedCardNetworks
  }
};
    
const cardPaymentMethod = Object.assign(
  {},
  baseCardPaymentMethod,
  {
    tokenizationSpecification: tokenizationSpecification
  }
);


let paymentsClient = null;


function getGoogleIsReadyToPayRequest() {
  return Object.assign(
      {},
      baseRequest,
      {
        allowedPaymentMethods: [baseCardPaymentMethod]
      }
  );
}


function getGooglePaymentDataRequest() {
  const paymentDataRequest = Object.assign({}, baseRequest);
  paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
  paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
  paymentDataRequest.merchantInfo = {
    merchantId: 'BCR2DN4TZDILX3ZX',
    merchantName: payment.company
  };

  paymentDataRequest.callbackIntents = ["PAYMENT_AUTHORIZATION"];

  return paymentDataRequest;
}

function getGooglePaymentsClient() {
  if ( paymentsClient === null ) {
    paymentsClient = new google.payments.api.PaymentsClient({
        environment: 'TEST',
      paymentDataCallbacks: {
        onPaymentAuthorized: onPaymentAuthorized
      }
    });
  }
  return paymentsClient;
}


function onPaymentAuthorized(paymentData) {
  return new Promise(function(resolve, reject){
    // handle the response
    processPayment(paymentData)
      .then(function() {
        
        resolve({transactionState: 'SUCCESS'});

        $.ajax({
            url: 'https://<?php echo $_SERVER['SERVER_NAME']; ?>/order/callback', // Change this to your actual endpoint
            type: 'GET',
            dataType: 'json', // Specify that response will be JSON
            success: function(response) {
                if(response.status == 200) {
                    setTimeout(function() {
                        // Redirect to the desired URL
                        window.location.href = 'https://<?php echo $_SERVER['SERVER_NAME']; ?>/customer'; // Change this to your desired URL
                    }, 3000);
                    Swal.fire({
                        title: "Transaction Success!",
                        text: "Order successfully",
                        icon: "success"
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
      })
      .catch(function() {
        resolve({
          transactionState: 'ERROR',
          error: {
            intent: 'PAYMENT_AUTHORIZATION',
            message: 'Insufficient funds, try again. Next attempt should work.',
            reason: 'PAYMENT_DATA_INVALID'
          }
        });
      });
  });
}

function onGooglePayLoaded() {
  const paymentsClient = getGooglePaymentsClient();
  paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
    .then(function(response) {
      if (response.result) {
        addGooglePayButton();
      }
    })
    .catch(function(err) {
      console.error(err);
    });
}

function addGooglePayButton() {
  const paymentsClient = getGooglePaymentsClient();
  const button =
    paymentsClient.createButton({
    buttonColor: 'default',
    buttonType: 'pay',
    buttonLocal: 'en',
    buttonSizeMode: 'fill',
    onClick: onGooglePaymentButtonClicked});
  document.getElementById('pay-now').appendChild(button);
}

function getGoogleTransactionInfo() {
    console.log(payment.foo)
  return {
    countryCode: 'PH',
    currencyCode: "PHP",
    totalPriceStatus: "FINAL",
    totalPrice: ''+payment.money+''
  };
}


function onGooglePaymentButtonClicked() {
  const paymentDataRequest = getGooglePaymentDataRequest();
  paymentDataRequest.transactionInfo = getGoogleTransactionInfo();

  const paymentsClient = getGooglePaymentsClient();
    console.log(paymentDataRequest);
  paymentsClient.loadPaymentData(paymentDataRequest);
}

let attempts = 0;

function processPayment(paymentData) {
    console.log(paymentData);
  return new Promise(function(resolve, reject) {
    setTimeout(function() {
      paymentToken = paymentData.paymentMethodData.tokenizationData.token;

      if (attempts++ % 2 == 0) {
                //Use this code if it's production
                // reject(new Error('Every other attempt fails, next one should succeed'));
                resolve({});        
      } else {
        resolve({});      
      }
    }, 500);
  });
}
</script>