<?php

//click the settings icon/cog wheel next to your project name at the top of the new Firebase Console
//Click Project settings
//Click on the Cloud Messaging tab
//The key is right under Server Key



// $name= $_POST['name'];
// $phone = $_POST['phone'];


// $message = $_POST['message'];
// $title = $_POST['title'];
$path_to_fcm = 'https://fcm.googleapis.com/fcm/send';
$server_key = "<You Server Key Here>";

$key = "<Put the required users fcm token here>";


$headers = array(
			'Authorization:key=' .$server_key,
			'Content-type:application/json'
);// send data payload and notification as well. you can send either one of them too.
$fields = array('to'=>$key,'data'=>array( 'destination_lat'=>$destination_lat, 'destination_long'=>$destination_long, 'drop'=>$drop , 'rider_lat'=>$rider_lat, 'rider_long'=>$rider_long, 'pickup'=>$pickup, 'userID'=>$userID ) ,'notification'=>array( 'title'=>'here','text'=>'asad'), "time_to_live" => 30);
				
$payload = json_encode($fields);
echo $payload;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $path_to_fcm);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
$result = curl_exec($ch);
if ($result === FALSE) {
	die('FCM Send Error: ' . curl_error($ch));
}
curl_close($ch);


?>