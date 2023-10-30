function teste02(id) {
    // Use a função encodeURIComponent para codificar o valor da ID, garantindo que seja seguro para URL
    var encodedId = encodeURIComponent(id);

    // Construa a URL com a ID como parâmetro
    var url = '../PHP/paginaVenda.php?id=' + encodedId;

    // Redirecione o navegador para a nova URL
    window.location.href = url;
}

