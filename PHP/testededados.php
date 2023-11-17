<?php

include_once "./class.php";

$selectcarrinho = new Database('localhost', 'root', '', 'produtos');
$itens = $selectcarrinho->select('carrinho2');




echo json_encode($itens);