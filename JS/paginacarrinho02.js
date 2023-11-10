$(document).ready(function () {
  obterDadosDoCarrinho();

  function obterDadosDoCarrinho() {
    $.ajax({
      url: '../PHP/testededados.php',
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        var produtosContainer = $('#produtos-container');
        produtosContainer.empty();

        var produtosUnicos = {};

        data.forEach(function (item) {
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
                <img  class="product-image" src="${produto.imagem}" alt="${produto.nome}">
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
        $('.quantidade-input').on('input', function () {
          var id = $(this).data('id');
          var novaQuantidade = parseInt($(this).val());
          produtosUnicos[id].quantidade = novaQuantidade;

          // Recalcule o valor total e exiba no console
          calcularEExibirValorTotal(produtosUnicos);
        });

        // Calcula o valor total inicial e exibe no console
        calcularEExibirValorTotal(produtosUnicos);
      },
      error: function (xhr, status, error) {
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

  // Adicione um evento para capturar os dados do carrinho ao clicar no botão "Finalizar"
  $('#botao-finalizar').on('click', function () {
    // Chame a função que captura os dados e exibe no modal
    exibirModal();
  });

  // Função para exibir o modal com as informações do JSON
  function exibirModal() {
    var dadosDoCarrinho = capturarDadosDoCarrinho(); // Chame a função que captura os dados

    // Preencha as informações do JSON no modal
    var infoJsonHtml = '';
    dadosDoCarrinho.forEach(function (produto) {
      infoJsonHtml += `
        <div class="info-produto">
          <h4>${produto.nome}</h4>
          <p>ID: ${produto.id}</p>
          <p>Quantidade: ${produto.quantidade}</p>
          <p>Valor Total: $${produto.valorTotal.toFixed(2)}</p>
        </div>
      `;
    });

    $('#info-json').html(infoJsonHtml);

    // Exiba o modal
    $('#modal').show();

    // Adicione um evento para fechar o modal ao clicar no botão de fechar
    $('.close').on('click', function () {
      fecharModal();
    });

    // Adicione um evento para fechar o modal ao clicar fora dele
    $(window).on('click', function (event) {
      if (event.target === $('#modal')[0]) {
        fecharModal();
      }
    });

    // Adicione um evento para confirmar o pedido ao clicar no botão "Confirmar Pedido"
    $('#confirmar-pedido').on('click', function () {
      var formaPagamento = $('#forma-pagamento').val();
      var localEntrega = $('#local-entrega').val();

      // Faça algo com as informações (enviar para o servidor, etc.)
      console.log('Forma de Pagamento:', formaPagamento);
      console.log('Local de Entrega:', localEntrega);

      // Feche o modal
      fecharModal();
    });
  }

  // Função para fechar o modal
  function fecharModal() {
    $('#modal').hide();
    // Remova os eventos de fechamento para evitar duplicatas
    $('.close').off('click');
    $(window).off('click');
    $('#confirmar-pedido').off('click');
  }

  // Função para capturar os dados do carrinho e exibir no console
  function capturarDadosDoCarrinho() {
    var dadosDoCarrinho = [];

    $('.produto').each(function () {
      var id = $(this).find('.quantidade-input').data('id');
      var nome = $(this).find('.nome-produto').text();
      var quantidade = parseInt($(this).find('.quantidade-input').val());
      var preco = parseFloat($(this).find('.preco-produto').text().replace('Preço: $', '').replace(',', '.'));

      dadosDoCarrinho.push({
        id: id,
        nome: nome,
        quantidade: quantidade,
        valorTotal: preco * quantidade
      });
    });

    // Crie um objeto JSON com os dados capturados
    var objetoJSON = {
      dadosDoCarrinho: dadosDoCarrinho
    };
    // Exiba o objeto JSON no console
    console.log(objetoJSON);

    // Se precisar enviar o objeto JSON para algum lugar (por exemplo, servidor), você pode fazer isso aqui.
    return dadosDoCarrinho; // Adicione esta linha para retornar os dados do carrinho
  }
});
