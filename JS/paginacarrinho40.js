// Função executada quando o documento está pronto
$(document).ready(function () {



  // Inicia obtendo os dados do carrinho
  obterDadosDoCarrinho();

  // Função para obter dados do carrinho através de uma requisição AJAX
  function obterDadosDoCarrinho() {
    $.ajax({
      url: '../PHP/testededados.php',
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        // Limpa o contêiner de produtos
        var produtosContainer = $('#produtos-container');
        produtosContainer.empty();

        // Mapeia os produtos únicos pelo ID e acumula as quantidades
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

        // Cria HTML para cada produto único e o exibe no contêiner
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

        // Adiciona um evento para atualizar a quantidade quando o input da quantidade for modificado
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


  

  function capturarDadosDoCarrinho() {
    var dadosDoCarrinho = [];

    $('.produto').each(function () {
        var id = $(this).find('.quantidade-input').data('id');
        var nome = $(this).find('.nome-produto').text();
        var quantidade = parseInt($(this).find('.quantidade-input').val());
        var preco = parseFloat($(this).find('.preco-produto').text().replace('Preço: $', '').replace(',', '.'));

        var valorTotal = preco * quantidade;

        dadosDoCarrinho.push({
            id: id,
            nome: nome,
            quantidade: quantidade,
            valorTotal: valorTotal
        });
    });

    // Calcular a soma do valor total
    var somaValorTotal = dadosDoCarrinho.reduce(function (total, item) {
        return total + item.valorTotal;
    }, 0);

    // Enviar os dados para o servidor
    $.ajax({
        url: '../PHP/vendafinalizar.php',
        type: 'POST',
        data: { itens: dadosDoCarrinho, valorTotal: somaValorTotal },
        dataType: 'json',
        success: function (data) {
            console.log('Itens:', data.itens);
            console.log('Valor total:', data.valorTotal);
        },
        error: function (xhr, status, error) {
            console.log('Erro na requisição AJAX:', error);
        }
    });


    // Crie um objeto JSON com os dados capturados
    var objetoJSON = {
      dadosDoCarrinho: dadosDoCarrinho
    };


    // Exibe o objeto JSON no console
    console.log(objetoJSON);

    // Retorna os dados do carrinho
    return dadosDoCarrinho;
  }

   // Adiciona um evento para capturar os dados do carrinho ao clicar no botão "Finalizar"
   $('#botao-finalizar').on('click', function () {
    // Chame a função que captura os dados e exibe no modal
    exibirModal();
    capturarDadosDoCarrinho();
  });





}); // fim de um grande bloco de codigo 


function teste(){
  alert("ola mundo");
 }


function finalizarPedido() {
  var formaPagamento = document.getElementById('forma-pagamento').value;

  if (formaPagamento === 'pix') {
    // Se a forma de pagamento for "pix", exibir o modal Pix
    document.getElementById('modal-pix').style.display = 'block';
  } else {
    // Lógica para outras formas de pagamento
    alert('Pedido finalizado com sucesso!'+ formaPagamento);
  }
}

function fecharModalPix() {
  // Fechar o modal Pix ao clicar no botão de fechar
  document.getElementById('modal-pix').style.display = 'none';
}


function teste() {
  console.log('OLHA EU AQUI');

  // Faça uma requisição para a página PHP usando fetch ou XMLHttpRequest
  fetch('../PHP/indexr.php', {
      method: 'POST', // ou 'GET' dependendo da sua necessidade
      headers: {
          'Content-Type': 'application/json',
          // Adicione quaisquer outros cabeçalhos necessários aqui
      },
      // Adicione quaisquer parâmetros ou corpo da requisição, se necessário
      body: JSON.stringify({key: 'value'}),
  })
  .then(response => response.json()) // Alteração para response.json()
  .then(data => {
      // Manipule os dados da resposta, se necessário
      console.log(data);

      // Verifica se a resposta contém a propriedade 'initPoint'
      if (data.initPoint) {
          // Redireciona o usuário para a URL obtida
          window.location.href = data.initPoint;
      } else {
          console.error('Resposta inválida:', data);
      }
  })
  .catch(error => {
      // Trate erros, se houver algum
      console.error('Erro:', error);
  });
}


