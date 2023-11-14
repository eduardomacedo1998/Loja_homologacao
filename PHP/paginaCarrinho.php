<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./css/header9.css">
    <link rel="stylesheet" href="../CSS/paginacarrinho03.css">
</head>
<body>
<header>
    <?php include_once "./componentes/header.php" ?>
</header>
<div class="container">
    <h1 class="page-title">Carrinho de Compras</h1>


    <div id="produtos-container" class="produtos-lista">
        <!-- Aqui os produtos serão adicionados dinamicamente -->
    </div>
    
    <div class="carrinho">

    <!-- <?php
    include_once "./class.php";
    $selectcarrinho = new Database('localhost', 'root', '', 'produtos');
    $itens = $selectcarrinho->select('carrinho2');
    // if (count($itens) > 0) {
    //     foreach ($itens as $item) {
    //         echo '<div class="product">';
    //         echo '<h2 class="product-title">' . $item['nome'] . '</h2>';
    //         echo '<img class="product-image" src="' . $item['imagem'] . '" alt="Imagem do Produto">';
    //         echo '<p class="product-description">' . $item['descricao'] . '</p>';
    //         echo '<p class="product-price">Preço: R$ ' . $item['preco'] . '</p>';
    //         echo '<form method="post" action="atualizar_quantidade.php">'; // Adicione um formulário
    //         echo '<input type="hidden" name="produto_id" value="' . $item['id'] . '">'; // ID do produto
    //         echo '<label for="quantidade">Quantidade:</label>';
    //         echo '<input type="number" name="quantidade" value="' . $item['quantidade'] . '">';
    //         echo '<input type="submit" value="Atualizar">'; // Botão "Atualizar"
    //         echo '</form>';
    //         echo '</div>';
    //     }
    // } else {
    //     echo 'Nenhum item encontrado na tabela "carrinho2".';
    // }
    ?> -->
    </div>
        
    <h1 id="valor-total"></h1>

    <button  type="button" id="botao-finalizar" onclick="teste()">Finalizar</button>

    <!-- Modal -->
<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div id="info-json">
      <!-- As informações JSON serão exibidas aqui dinamicamente pelo seu script JavaScript -->
    </div>
    <label for="forma-pagamento">Forma de Pagamento:</label>
    <select id="forma-pagamento">
      <option value="cartao">Cartão de Crédito</option>
      <option value="boleto">Boleto Bancário</option>
      <option value="paypal">PayPal</option>
      <option value="pix">pix</option>
    </select>
    <label for="local-entrega">Local de Entrega:</label>
    <input type="text" id="local-entrega">
    <button onclick="finalizarPedido()"  type="button" id="botao">Finalizar</button>
  </div>
</div>


<!-- Segundo modal com uma classe diferente -->
<div id="modal-pix" class="modal modal-pix">
  <div class="modal-content">
    <span class="close" onclick="fecharModalPix()">&times;</span>
    <?php include_once "./indexr.php";?>
  </div>
</div>



</div>
<script src="../JS/paginacarrinho99.js"></script>
</body>
</html>
