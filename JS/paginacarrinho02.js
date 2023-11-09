$(document).ready(function() {
  obterDadosDoCarrinho();

  function obterDadosDoCarrinho() {
    $.ajax({
      url: '../PHP/testededados.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        var produtosContainer = $('#produtos-container');
        produtosContainer.empty();

        var produtosUnicos = {};

        data.forEach(function(item) {
          var id = item.id;

          if (!produtosUnicos[id]) {
            produtosUnicos[id] = {
              nome: item.nome,
              descricao: item.descricao,
              imagem: item.imagem,
              preco: parseFloat(item.preco),
              quantidade: 1
            };
          } else {
            produtosUnicos[id].quantidade += 1;
          }
        });

        for (var id in produtosUnicos) {
          if (produtosUnicos.hasOwnProperty(id)) {
            var produto = produtosUnicos[id];

            var produtoHTML = `
              <div class="produto">
                <img src="${produto.imagem}" alt="${produto.nome}">
                <h3 class="nome-produto">${produto.nome}</h3>
                <p class="descricao-produto">${produto.descricao}</p>
                <p class="preco-produto">Preço: $${produto.preco.toFixed(2).replace('.', ',')}</p>
                <p class="quantidade-produto">
                  Quantidade: 
                  <input type="number" value="${produto.quantidade}" min="1" data-id="${id}" class="quantidade-input">
                </p>
              </div>
            `;

            produtosContainer.append(produtoHTML);
          }
        }

        // Adicione um evento para atualizar a quantidade quando o input da quantidade for modificado
        $('.quantidade-input').on('input', function() {
          var id = $(this).data('id');
          var novaQuantidade = parseInt($(this).val());
          produtosUnicos[id].quantidade = novaQuantidade;

          // Recalcule o valor total e exiba no console
          calcularEExibirValorTotal(produtosUnicos);
        });

        // Calcula o valor total inicial e exibe no console
        calcularEExibirValorTotal(produtosUnicos);
      },
      error: function(xhr, status, error) {
        console.log('Erro na requisição AJAX:', error);
      }
    });
  }

   // Função para calcular o valor total e exibir no console e em um elemento h1
   function calcularEExibirValorTotal(produtos) {
    var valorTotal = 0;

    for (var id in produtos) {
      if (produtos.hasOwnProperty(id)) {
        var produto = produtos[id];
        valorTotal += produto.preco * produto.quantidade;
      }
    }

    // Exibe o valor total em um elemento h1 com o id "valor-total"
    $('#valor-total').text('Valor total dos produtos: $' + valorTotal.toFixed(2).replace('.', ','));
  }
});

