<?php

if(isset($_POST['submit']) and !empty($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $esource=$_POST['esource'];
    $emedium=$_POST['emedium'];



    // leadfox webhook start here

    //$description = "Message: " . $message;

    if(empty($esource)){
        $utm_source = "google-ads";
    } else{
        $utm_source = $source;
    }

    //echo $utm_source;


    $apiKey = urlencode('fLxpua0crpSjVuxo');
    $utm_id = "1869890011";
    $agent = "32643312";

    $data = array(
        'apikey' => $apiKey,
        'name' => $name,
        "phone" => $phone,
        "email" => $email,
        "utm_source" => $utm_source,
        //"description" => $description,
        "utm_id" => $utm_id,
        "agent" => $agent

    );

    $ch = curl_init('https://leadfoxcrm.com/webhook');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // leadfox webhook end here




    $mail1_subject="Jindal MLC Pipes Enquiry from Google Ads, " . $name;
    $mail1_txt="Name :" . $name . "<br>" . "Mobile :" . $phone . "<br>" . "E-Mail :" . $email . "<br>" . "Source :" . $esource . "<br>" . "Medium :" . $emedium . "<br>";


// More headers
$headers .= 'From: <mail@jindalmlcpipes.com>' . "\r\n";

$to = "viralmafiacs2@gmail.com, cyril.viralmafia@gmail.com, leads.viralmafia@gmail.com";
$url = 'http://viralmafia.com/demo/jsonmailerjindal.php';
$ch = curl_init($url);
$data = array(
    'to' => $to,
    'subject' => $mail1_subject,
    'messagenew' => $mail1_txt,
    'headers' => $headers,
);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$complete = curl_exec($ch);
curl_close($ch);

    if($complete){
        header("location:download/index.php");
    }
}


?>