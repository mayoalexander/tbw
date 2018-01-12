<?php
// Define the directory separator variable
define('DS', DIRECTORY_SEPARATOR);

// Include the autoloader for custom classes
require_once(__DIR__ . DS . 'Application' . DS . 'Autoload.php');

// Get the connection into the database
$request        = \Application::getSingleton('Core\Request');
$accountType    = $request->getData('account-type');
$pricing        = \Application::getModel('Baewatch\Pricing')->load($accountType);

$cart           = \Application::getCoreObject('Cart');

$cart->addItem(
    $cart->getCartItem([
        'source'            => $pricing,
        'price'             => 'price',
        'description'       => 'description',
        'id'                => 'id',
    ])
);


// Redirect to order review page
echo '
    <h2>Redirect to cart page</h2>
';


$apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AQpKkJg7GxyIfVSKb3LNC4QGAnJs6T8sUnVjn1MZtwTzv7NsyFaB07Q3OYbOQtEdSS6wCL_QzfIzmdbR',
            'EL3LCGw7irQyD1uBZTbs9MscQUt1_eipPtIYmjB2TVzWVNvKjFntNpwTOCsWqNdRTRhsX4zAhKEVcLRD'
        )   
);
// Create a new instance of Plan object
$plan = new \PayPal\Api\Plan();
// # Basic Information
// Fill up the basic information that is required for the plan
$plan->setName('T-Shirt of the Month Club Plan')
    ->setDescription('Template creation.')
    ->setType('fixed');
// # Payment definitions for this billing plan.
$paymentDefinition = new \PayPal\Api\PaymentDefinition();
// The possible values for such setters are mentioned in the setter method documentation.
// Just open the class file. e.g. lib/PayPal/Api/PaymentDefinition.php and look for setFrequency method.
// You should be able to see the acceptable values in the comments.
$paymentDefinition->setName('Regular Payments')
    ->setType('REGULAR')
    ->setFrequency('Month')
    ->setFrequencyInterval("2")
    ->setCycles("12")
    ->setAmount(new \PayPal\Api\Currency(array('value' => 100, 'currency' => 'USD')));
// Charge Models
$chargeModel = new \PayPal\Api\ChargeModel();
$chargeModel->setType('SHIPPING')
    ->setAmount(new \PayPal\Api\Currency(array('value' => 10, 'currency' => 'USD')));
$paymentDefinition->setChargeModels(array($chargeModel));
$merchantPreferences = new \PayPal\Api\MerchantPreferences();
$baseUrl = 'http://thebae.watch/';
// ReturnURL and CancelURL are not required and used when creating billing agreement with payment_method as "credit_card".
// However, it is generally a good idea to set these values, in case you plan to create billing agreements which accepts "paypal" as payment_method.
// This will keep your plan compatible with both the possible scenarios on how it is being used in agreement.
$merchantPreferences->setReturnUrl("$baseUrl/ExecuteAgreement.php?success=true")
    ->setCancelUrl("$baseUrl/ExecuteAgreement.php?success=false")
    ->setAutoBillAmount("yes")
    ->setInitialFailAmountAction("CONTINUE")
    ->setMaxFailAttempts("0")
    ->setSetupFee(new \PayPal\Api\Currency(array('value' => 1, 'currency' => 'USD')));
$plan->setPaymentDefinitions(array($paymentDefinition));
$plan->setMerchantPreferences($merchantPreferences);
// For Sample Purposes Only.
$request = clone $plan;
// ### Create Plan
try {
    $output = $plan->create($apiContext);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    var_dump([
        $ex
    ]);
    echo '<h2>Exception</h2>';
    exit(1);
}
// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
 var_dump('created plan', 'plan', $output->getId(), $request, $output);
 echo '<h2>Recurring Plan successful:' . $output->getId();
return $output;

exit;

