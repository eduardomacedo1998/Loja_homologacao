function teste02(id,nomeprod,descricaoprod,preco){


    // const dados = {
        
    //     nomeprod : nomeprod,
    //     descriprod : descricaoprod,
    //     valorprod : preco,
    //     id : id
        
    // };

    const dados = {

        chave1: 'valor1',
        chave2: 'valor2'
        // Adicione aqui os dados que deseja enviar
    }
    
//   $.ajax({
//         url: '../PHP/metodos/adicionarcar.php', // Substitua pelo nome do arquivo PHP que irá receber os dados
//        type: 'POST', // Ou 'GET' se preferir uma solicitação GET
//         data: dados, // Os dados a serem enviados para o servidor
//         dataType: 'json',
//         success: function(data) {
//             // Manipule a resposta JSON recebida do servidor aqui.
//             console.log('Resposta do servidor:', data);
//         },
//         error: function(xhr, status, error) {
//             console.log('Erro na requisição AJAX:', error);
//         }
//     });





    $.ajax({
        url: '../PHP/paginaVenda.php', // Substitua pelo nome do arquivo PHP que irá receber os dados
       type: 'POST', // Ou 'GET' se preferir uma solicitação GET
        data: dados, // Os dados a serem enviados para o servidor
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

