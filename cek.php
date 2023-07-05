<?php
include('config.php');

    // dari anda (merchant), bersifat unik
    $merchantOrderId = $_GET['orderid'];
    // $merchantOrderId = 'IUA21376213'; 
    

    $signature = md5($merchantCode . $merchantOrderId . $apiKey);

    $params = array(
        'merchantCode' => $merchantCode,
        'merchantOrderId' => $merchantOrderId,
        'signature' => $signature
    );

    $params_string = json_encode($params);
    $url = 'https://sandbox.duitku.com/webapi/api/merchant/transactionStatus';
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($params_string))                                                                       
    );   
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    //execute post
    $request = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($httpCode == 200)
    {
        $results = json_decode($request, true);
        print_r($results, false);
        echo "merchantOrderId :". $results['merchantOrderId'] . "<br />";
        echo "reference :". $results['reference'] . "<br />";
        echo "amount :". $results['amount'] . "<br />";
        echo "fee :". $results['fee'] . "<br />";
        echo "statusCode :". $results['statusCode'] . "<br />";
        echo "statusMessage :". $results['statusMessage'] . "<br />";
    }
    else
    {
        $request = json_decode($request);
        $error_message = "Server Error " . $httpCode ." ". $request->Message;
        echo $error_message;
    }
?>
