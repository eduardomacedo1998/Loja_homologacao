function adicionarAoCarrinho(nomeProduto, imagemProduto, descricaoProduto, precoProduto, idProduto) {


    alert("Uma unidade adicionada ao carrinho")

    // console.log('Nome do Produto: ' + nomeProduto);
    // console.log('Imagem do Produto: ' + imagemProduto);
    // console.log('Descrição do Produto: ' + descricaoProduto);
    // console.log('Preço do Produto: $' + precoProduto);
    // console.log('ID do Produto: ' + idProduto);



    // Aqui você pode adicionar a lógica para adicionar o produto ao carrinho, se necessário.


    var produto = {
        nome: nomeProduto,
        imagem: imagemProduto,
        descricao: descricaoProduto,
        preco: precoProduto,
        id: idProduto
    };


    $.ajax({
        url: '../PHP/metodos/adicionarcar.php', // Substitua pelo nome do arquivo PHP que irá receber os dados
        type: 'POST', // Ou 'GET' se preferir uma solicitação GET
        data: produto, // Os dados a serem enviados para o servidor
        dataType: 'json',
        success: function(data) {
            // Manipule a resposta JSON recebida do servidor aqui.
            console.log('Resposta do servidor:', data);
        },
        error: function(xhr, status, error) {
            console.log('Erro na requisição AJAX:', error);
        }
    });
    


}

console.log("eduardo")