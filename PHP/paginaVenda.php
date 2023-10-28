<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recupere os dados enviados via POST
    $chave1 = $_POST['chave1'];
    $chave2 = $_POST['chave2'];

    // Agora você pode fazer o que quiser com esses dados, por exemplo, imprimi-los:
    echo "Valor de chave1: " . $chave1 . "<br>";
    echo "Valor de chave2: " . $chave2;
}
?>
