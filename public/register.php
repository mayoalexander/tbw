<?php
// Define the directory separator variable
define('DS', DIRECTORY_SEPARATOR);

// Include the autoloader for custom classes
require_once(__DIR__ . DS . 'Application' . DS . 'Autoload.php');

// Get the connection into the database
$request        = \Application::getSingleton('Core\Request');
$user           = \Application::getModel('Baewatch\User');

$accountType    = $request->getData('account-type');
$pricing        = \Application::getModel('Baewatch\Pricing')->load($accountType);
$price          = $pricing->getData('price');


\Application::debug(
    [
        'yuh' => $user->createNewUser()
        // 'user' => $user
    ]
);









exit;

// Redirect to order review page
echo '
    <h3 class="text-center">Your account has been created!</h3>
';


$apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AQpKkJg7GxyIfVSKb3LNC4QGAnJs6T8sUnVjn1MZtwTzv7NsyFaB07Q3OYbOQtEdSS6wCL_QzfIzmdbR',
            'EL3LCGw7irQyD1uBZTbs9MscQUt1_eipPtIYmjB2TVzWVNvKjFntNpwTOCsWqNdRTRhsX4zAhKEVcLRD'
        )   
);

// After Step 2
$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$amount = new \PayPal\Api\Amount();
$amount->setTotal($price);
$amount->setCurrency('USD');

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("http://thebae.watch/login/complete")
    ->setCancelUrl("http://thebae.watch/login/complete");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

// After Step 3
try {
    $payment->create($apiContext);
    // echo $payment;

    // echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
    // echo '<script>window.location.assign("'.$payment->getApprovalLink().'")</script>';
    echo '<br><br><br><a href="'.$payment->getApprovalLink().'">Proceeding to Payment</a>';
}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
}



// get the packages via database


// implement paypal script

// redirect to the payment pages
