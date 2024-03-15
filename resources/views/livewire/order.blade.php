<div>
    <div class="container mx-auto">
        <div class="mx-4 md:mx-auto my-20 max-w-md md:max-w-2xl flex flex-col">
            
            <div class="revieworder">
                <h1 class="text-2xl font-bold mb-2">Review order</h1>
                <?php
                $total = 0;
                ?>
                @foreach($carts as $cart)
                    <?php
                        $total += $cart->product->selling_price * $cart->quantity;
                    ?>
                    <div class="grid grid-cols-4 gap-4 bg-white shadow-lg mb-2 rounded-md">
                        <div>
                            <img src="{{$cart->product->product_image ?? 'https://placehold.co/600x400/png'}}" />
                        </div>
                        <div>
                            Product ID: {{$cart->product_id}}<br />
                            Product Name: {{$cart->product->product_name}}<br />
                            Price: P{{$cart->product->selling_price}}<br />
                            Quantity: x{{$cart->quantity}}<br />
                            Quantity * Price: P{{$cart->product->selling_price * $cart->quantity}}<br/><br/>

                            <button type="button" wire:click="delete({{$cart->id}})" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                        </div>
                    </div>
                @endforeach
                <div class="bg-white shadow-lg mb-2 rounded-md p-4">
                    Total: P{{$total}}
                </div>
                <button id="checkout" type="button" class="{{$total == 0 ? 'disabled' : ''}}focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" {{$total == 0 ? 'disabled' : ''}}>Checkout</button>
            </div>
            <div class="billing" style="display: none;">
                <h1 class="text-2xl font-bold mb-2">Billing</h1>
                <div id="pay-now"></div>
                <button id="back-billing" type="button" class="mt-2 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Back</button>
            </div>
        </div>
    </div>
</div>
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