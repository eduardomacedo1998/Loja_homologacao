<?php
// vendafinalizar.php

if(isset($_POST['itens']) && isset($_POST['valorTotal'])) {

    include_once "./class.php";

    $incertcarrinho = new Database('localhost','root','','produtos');

    $itens = $_POST['itens'];
    $valorTotal = $_POST['valorTotal'];

    $dados['valorTotal'] = $valorTotal;

    $incertcarrinho ->updatedadosunitarios('vendafinalizar',$dados);

    // Faça qualquer processamento necessário aqui

    // Retorne os dados em formato JSON
    $response = array('itens' => $itens, 'valorTotal' => $valorTotal);
    echo json_encode($response);
} else {
    echo json_encode(array('error' => 'Dados não recebidos corretamente.'));
}
?>
