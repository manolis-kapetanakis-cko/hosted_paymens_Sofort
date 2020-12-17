<?php 
// Display errors if any
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Retrieve the token generate by Checkout.Frames and POSTED here.
$option= $_POST['option'];
$amount = $_POST['amount'];
$currency = $_POST['currency'];
$reference = $_POST['reference'];
$country = $_POST['country'];
$customerName = $_POST['customerName'];
$customerEmail = $_POST['customerEmail'];


$success_url = "https://example.com/payments/success";
$failure_url = "https://example.com/payments/failure";
$cancel_url = "https://example.com/payments/checkout";

// The api endpoint and the authorisation key

$apiKey = "sk_test_07fa5e52-3971-4bab-ae6b-a8e26007fccc";  // Default channel

if ($option ==0 ){
    $apiUrl = "https://api.sandbox.checkout.com/hosted-payments";
    // The request body that will be sent in the API call
    $requestBody = json_encode(array(
        'currency' => $currency,
        'reference' => $reference,
        'amount' => intval($amount),
        'billing'=>array(
            'address'=>array(
                'country'=> $country
            )
        ),
        'customer'=>array(
            'name'=> $customerName,
            'email'=> $customerEmail
        ),
        'success_url' => $success_url,
        'failure_url' => $failure_url,
        'cancel_url' => $cancel_url
        )
    );
} else {
    $apiUrl = "https://api.sandbox.checkout.com/payments";
    // The request body that will be sent in the API call
    $requestBody = json_encode(array(
        'source' => array(
            'type' => 'sofort'
        ),
        'currency' => $currency,
        'amount'=>$amount
        )
    );
}


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$apiUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: '.$apiKey,
    'Content-Type:application/json;charset=UTF-8'
    ));
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);

// The payment response
$response = json_decode($server_output);

// Print payment response to screen
// echo(print_r($response, true));
echo(print_r($response->_links->redirect->href, true));

exit();
?>