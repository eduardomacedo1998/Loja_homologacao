<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de venda</title>
    <link rel="stylesheet" href="../CSS/paginaVenda2.css">
    <link rel="stylesheet" href="./css/header6.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    

</head>
<body>

<header>

  <?php include_once "./componentes/header.php"; ?>

</header>



<?php


if (isset($_GET['id'])) {
 
include_once "./class.php";

   $select = new Database('localhost','root','','produtos');

    $id = $_GET['id'];
    // Agora, $id contém o valor do ID passado na URL 

$dados =   $select -> selectprodutoindividual('listadeprodutos',$id);


// Suponha que $dados contenha os dados do produto como descrito.




// Suponha que $dados contenha os dados do produto como obtidos do método selectprodutoindividual.

foreach ($dados as $produto) {


    $nomeProduto = $produto['nomeprod'];
    $imagemProduto = $produto['imgprod'];
    $descricaoProduto = $produto['descricaoprod'];
    $precoProduto = $produto['preco'];
    $idProduto = $produto['id'];


    echo' <div class="product-container">';

    echo '<div class="product">';
    echo '<h2 class="product-title">' . $produto['nomeprod'] . '</h2>';
    echo '<img class="product-image" src="' . $produto['imgprod'] . '" alt="' . $produto['nomeprod'] . '">';
    echo '<p class="product-description">' . $produto['descricaoprod'] . '</p>';
    echo '<p class="product-price">Preço: $' . $produto['preco' ]. '</p>';
    echo '<button class="add-to-cart-button" onclick="adicionarAoCarrinho(\'' . 
    $nomeProduto . '\', \'' . 
    $imagemProduto . '\', \'' . 
    $descricaoProduto . '\', \'' . 
    $precoProduto . '\', \'' . 
    $idProduto . 
    '\')">Adicionar ao Carrinho</button>';
    echo' </div>';
}


// Você ainda precisará implementar a função JavaScript "adicionarAoCarrinho" para adicionar o produto ao carrinho.



// Você precisará implementar a função JavaScript "adicionarAoCarrinho" para adicionar o produto ao carrinho.






} else {
    echo "Nenhum ID na URL.";
}
?>







<script src="../JS/paginaVenda01.js"></script>
    
</body>
</html>

