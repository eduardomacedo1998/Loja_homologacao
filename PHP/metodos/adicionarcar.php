<?php

include "./class.php";

 

// Certifique-se de que você está recebendo dados por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $insertcarrinho = new Database('localhost','root','','produtos');

    // Receba os dados enviados via POST
    
    $dados = $_POST;
  
// Verifique os IDs dos produtos
// $dados2 = verificaIds($dados);

// Insira os produtos no banco de dados
$insertcarrinho -> insert('carrinho2', $dados);

    // Agora você pode fazer o que quiser com esses dados, por exemplo, inseri-los em um banco de dados ou realizar alguma outra operação.
    
    // Responda à solicitação AJAX com uma mensagem ou dados em formato JSON
    $response = array('message' => $dados);
    echo json_encode($response);

    
    
} else {
    // Caso a solicitação não seja do tipo POST, você pode lidar com isso aqui
    http_response_code(405); // Método não permitido
    echo 'Método não permitido';
}

