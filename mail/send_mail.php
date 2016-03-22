<?php

// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	    ||
   empty($_POST['vin'])	        ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$vin = strip_tags(htmlspecialchars($_POST['vin']));
	
// Create the email and send the message
$to = 'bukhtiyarov.anton@gmail.com';//,anton.gomzyakov2015@yandex.ru'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Автозапчасти Кемерово - Новый запрос от $name.";
$email_body = "Запрос от : $name\n\nЭл. почта: $email_address\n\nТелефон: $phone\n\nЗапрос:\n$message\n\nИнформация об автомобиле: vin\n\n";

if ($curl = curl_init()) {
	$post = [
		'from'    => $name . '<' . $email_address .'>',
		'to'      => $to,
		'subject' => $email_subject,
		'text'    => $email_body
	];
	curl_setopt($curl, CURLOPT_USERPWD, "api:key-e26ed3c5eccdd352e49ad1783bbf69bf");  
	curl_setopt($curl, CURLOPT_URL, "https://api.mailgun.net/v3/mg.antonbukhtiyarov.ru/messages");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
	
	echo curl_exec($curl);
	curl_close();
	
	return true;
}
echo "email not sent";
return false;
?>
