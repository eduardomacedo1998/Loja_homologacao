<?php

// Certifique-se de que a solicitação é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    include "./class.php";

    
    // Verifica se existe algum dado enviado
    if(isset($_POST[' valorTotal'])) {

        

        $updatefinalizar = new Database('localhost','root','','produtos');
        
        // Recupera os dados enviados
        $objetoJSON = $_POST[' valorTotal'];
        
        // Faça o que quiser com os dados, por exemplo, converte JSON para array


        $updatefinalizar->insert('vendafinalizar',$objetoJSON);

        // Agora você pode manipular os dados da maneira que precisar
        // Por exemplo, você pode imprimir os dados de volta como resposta
        $response = ['status' => 'success', 'message' => 'Dados recebidos com sucesso', 'data' => $dados];
    } else {
        // Se não houver dados enviados, retorne um erro
        $response = ['status' => 'error', 'message' => 'Nenhum dado enviado'];
    }

} else {
    // Se a solicitação não for do tipo POST, retorne um erro
    $response = ['status' => 'error', 'message' => 'Apenas solicitações POST são permitidas'];
}

// Se esta página estiver sendo incluída, não imprima diretamente a resposta JSON
// Em vez disso, você pode retornar a resposta como um array para ser usado pelo script principal
if (isset($response)) {
    return $response;
}
?>
