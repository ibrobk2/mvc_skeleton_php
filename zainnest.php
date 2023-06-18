<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://zainnest.com/v1/auth/login",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => false,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('identity'=>'esystems', 'password'=>'Bakori@12'),
  CURLOPT_HTTPHEADER => array(
    "Accept: application/json"
  ),
));

$response = curl_exec($curl);
$resposne_data = json_decode($responses, true);
$err = curl_error($curl);

curl_close($curl);


 var_dump($resposne_data);



?>