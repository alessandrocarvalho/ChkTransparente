<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once "mercadopago.php";

$mp = new MP("APP_USR-6517025143495386-100313-58c3888a2e06ee07b39d40558ab1580a__LA_LB__-276511449");


$payment_preference = array(
    "token"=> $_REQUEST['token'], // veio do formulario html do frontend
    "installments"=> (int)$_REQUEST['installmentsOption'],
    "transaction_amount"=> round((float)$_REQUEST['amount'],2),
    "external_reference"=> "ID-123456", // NUMERO DO PEDIDO DE SEU SITE PARA FUTURA CONCILIAÇÃO
    "binary_mode" => false,
    "description"=> "PEDIDO DO LOJA XPTO ID 12345", // DESCRIÇÃO DO CARRINHO OU ITEM VENDIDO NO
    "payment_method_id"=> $_REQUEST['paymentMethodId'],
    "statement_descriptor" => "MEUSITE", // ESTE CAMPO IRÁ NA APARECER NA FATURA DO CARTÃO DO CLIENTE
    "payer"=> array(
        "email"=> "test_user_88379317@testuser.com"
    ),
    "additional_info"=>  array(  // DADOS ESSENCIAIS PARA O ANTI-FRAUDE
        "items"=> array(array(
            
                "id"=> "1234",
                "title"=> "Aqui coloca os itens do carrinho",
                "description"=> "Produto Teste novo",
                "picture_url"=> "https=>//google.com.br/images?image.jpg",
                "category_id"=> "others",
                "quantity"=> 1,
                "unit_price"=> round((float)$_REQUEST['amount'],2)
            )
        ),
        "payer"=>  array(
            "first_name"=> "João",
            "last_name"=> "Silva",
            "registration_date"=> "2014-06-28T16:53:03.176-04:00",
            "phone"=>  array(
                "area_code"=> "5511",
                "number"=> "3222-1000"
            ),
            "address"=>  array(
                "zip_code"=> "05303-090",
                "street_name"=> "Av. Queiroz Filho",
                "street_number"=> "213"
            )
        ),
        "shipments"=>  array(
            "receiver_address"=>  array(
                "zip_code"=> "05303-090",
                "street_name"=> "Av. Queiroz Filho",
                "street_number"=> "213",
                "floor"=> "0",
                "apartment"=> "0"
            )
        )
    ),

    "capture" => true
  );

  
$response_payment = $mp->post("/v1/payments/", $payment_preference);


echo "<pre>";
print_r($response_payment);
echo "</pre>";



//echo '=============================';


//$payment_data = array(
  //  "capture" => true
//);


//$payment = $mp->put("/v1/payments/".$response_payment['response']['id'], $payment_data);

//echo "<pre>";
//print_r($payment);
//echo "</pre>";




?>

