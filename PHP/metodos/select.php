<?php
// Inclui o arquivo de classe "class.php" (certifique-se de que o caminho do arquivo esteja correto)
include_once "./class.php";

// Inicia uma seção com a classe CSS "error"
echo '<section class="error">';

// Obtém o usuário a partir da variável de sessão 'usuario'
$usuario = $_SESSION['usuario'];

// Fecha a seção "error"
echo '</section>';

// Cria uma instância da classe "Database" para se conectar ao banco de dados
$selectdados = new Database("localhost", "root", "", "produtos");

// Obtém os dados do banco de dados da tabela "listadeprodutos"
$dados = $selectdados->select("listadeprodutos");

// Cria um array para armazenar os produtos agrupados por categoria

$produtosPorCategoria = array();

// Organiza os produtos por categoria
foreach ($dados as $produto) {
    $categoria = $produto['categoria'];
    if (!isset($produtosPorCategoria[$categoria])) {
        $produtosPorCategoria[$categoria] = array();
    }

    $produtosPorCategoria[$categoria][] = $produto;
}

// Exibe os produtos por categoria
foreach ($produtosPorCategoria as $categoria => $produtos) {
    // Exibe o nome da categoria como um título
    echo '<h1 class="categoria">' . $categoria . '</h1>';

    foreach ($produtos as $produto) {
        // Exibe informações de cada produto (imagem, nome, descrição, etc.)
        echo '<div class="produto">';
        echo '<img src="' . $produto['imgprod'] . '" alt="' . $produto['nomeprod'] . '" style="max-width: 200px; max-height: 200px;">';
        echo '<h2>' . $produto['nomeprod'] . '</h2>';
        echo '<p><strong>Descrição:</strong> ' . $produto['descricaoprod'] . '</p>';

        // Verifica se o usuário está logado
        if ($usuario) {

            echo '<button onclick="teste02(' . $produto['id'] . ')" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">Comprar</button>';

        } else {
            // Exibe um link para a página de login caso o usuário não esteja logado
            echo ' <a href="http://localhost/loja_homologacao/PHP/paginaLoguin.php"><button>Faça login para adicionar ao carrinho</button></a>';
        }

        // Exibe informações adicionais do produto (quantidade disponível e preço)
        echo '<p><strong>Quantidade disponível:</strong> ' . $produto['quantidadeprod'] . '</p>';
        echo '<p><strong>Preço:</strong> $' . $produto['preco'] . '</p>';
        echo '</div>';
    }
}
?>
