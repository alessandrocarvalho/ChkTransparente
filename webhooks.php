<?php

//echo "teste";

/*
$name = 'arquivo.txt';
$text = var_export($_POST, true);
$file = fopen($name, 'a');
fwrite($file, $text);
fclose($file);
*/

//echo "teste2";
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
require_once "mercadopago.php";

$mp = new MP("APP_USR-6517025143495386-100313-58c3888a2e06ee07b39d40558ab1580a__LA_LB__-276511449");

$json_event = file_get_contents('php://input', true);
$event = json_decode($json_event);

if (!isset($event->type, $event->data) || !ctype_digit($event->data->id)) {
	http_response_code(400);
	return;
	echo "teste1";
}

if ($event->type == 'payment'){
    $payment_info = $mp->get('/v1/payments/'.$event->data->id);

    if ($payment_info["status"] == 200) {
    	echo "teste2";
        //print_r($payment_info["response"]);
        $myfile = fopen("notifications.txt", "w") or die("falha ao gerar arquivo!");
		$txt = "payment_info:\n";
		fwrite($myfile, $txt);
		$txt = serialize($payment_info);
		fwrite($myfile, $txt);
		echo "teste3";
		fclose($myfile);
    }
}


/*




















equire_once "mercadopago.php";

$mp = new MP("TEST-6517025143495386-100313-70bc16538a560b574f2f254d0db2c4fa__LD_LB__-276511449"

//TEST-6517025143495386-100313-70bc16538a560b574f2f254d0db2c4fa__LD_LB__-276511449);

$json_event = file_get_contents('php://input', true);
$event = json_decode($json_event);

if (!isset($event->type, $event->data) || !ctype_digit($event->data->id)) {
	http_response_code(400);
	//return;
	echo "teste2";
}

if ($event->type == 'payment'){
    $payment_info = $mp->get('/v1/payments/'.$event->data->id);

    if ($payment_info["status"] == 200) {
        print_r($payment_info["response"]);
		echo "teste3";
      
        $myfile = fopen("notifications.txt", "w") or die("falha ao gerar arquivo!");
		$txt = "payment_info:\n";
		fwrite($myfile, $txt);
		$txt = serialize($payment_info);
		fwrite($myfile, $txt);
		fclose($myfile);
    }
}
*/

?>