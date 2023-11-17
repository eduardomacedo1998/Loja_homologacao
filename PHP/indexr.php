<?php

include_once "./class.php";

$seleccar = new Database("localhost", "root", "", "produtos");

 $seleccar->select('vendafinalizar');

use MercadoPago\Item;
use MercadoPago\Payer;
use MercadoPago\Preference;

require 'vendor/autoload.php';

// Configuração da SDK do Mercado Pago
MercadoPago\SDK::setAccessToken("TEST-7752487453365112-111716-fd9ec0a8c1e31e9d7f863e492e56b911-1347932514");

// Criação de um item (produto)
$item = new Item();
$item->id = "1234";
$item->title = "Produto de Teste";
$item->quantity = 1;
$item->currency_id = "BRL";
$item->unit_price = $seleccar;

// Criação do comprador (payer)
$payer = new Payer();
$payer->email = "payer@email.com";

// Criação da preferência de pagamento
$preference = new Preference();
$preference->items = array($item);
$preference->payer = $payer;

// Configuração do método de pagamento PIX
$preference->payment_methods = array(
    'excluded_payment_methods' => array(
        array('id' => 'credit_card'),
        array('id' => 'boleto'),
    ),
    'excluded_payment_types' => array(
        array('id' => 'atm'),
    ),
    'installments' => 1,
);

// Salva a preferência
$preference->save();

// Obtém o init_point
$initPoint = $preference->init_point;

// Retorna a URL de redirecionamento como resposta JSON
header('Content-Type: application/json');
echo json_encode(array('initPoint' => $initPoint));
exit;
