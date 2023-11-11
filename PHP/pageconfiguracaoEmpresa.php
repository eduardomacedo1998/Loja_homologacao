<!DOCTYPE html>
<html>
<head>
    <title>Upload de Imagem do Produto</title>
    <link rel="stylesheet" href="./css/paginaadm03.css">
    <link rel="stylesheet" href="./css/header9.css">
</head>
<body>

<header>

<?php include_once "./componentes/header.php" ?>

</header>


    
    <h1>Dados da empresa</h1>
    
    <form action="./pageconfiguracaoEmpresa.php" method="POST" enctype="multipart/form-data">

        <span>nome da empresa</span>
        <input type="text" id="nome" name="nome">

        <span>telefone da empresa</span>
        <input type="number" id="telefone" name="telefone">


        <span>Logo da empresa</span>
        <input type="file" name="imagem">



        <button type="submit">Enviar dados</button>



    </form>

</body>
</html>

<?php


if(isset($_POST['nome'])){

    include_once "./class.php";
// Conexão com o banco de dados (substitua as informações de conexão)


$insertdados = new Database("localhost", "root", "", "dadosempresa");






// Upload da imagem
$uploadDir = "upload/";
$uploadFile = $uploadDir . basename($_FILES["imagem"]["name"]);
$extensaoPermitida = array("jpeg", "jpg", "png"); // Extensões permitidas


$extensao = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION)); // Obtém a extensão do arquivo


if (in_array($extensao, $extensaoPermitida)) {
    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $uploadFile)) {
        $imagem = $uploadFile;


                         // colocando todos os dados dos produtos em um array
      $id = 10;                 
      $data['imglogo'] = $imagem;
    

      $insertdados ->updatedadosempresa('dadosempresa',$id,$imagem,$_POST['nome'],$_POST['telefone']);
       
    } else {
        echo "Erro ao fazer o upload da imagem.";
    }
} else {
    echo "Apenas imagens JPEG ou PNG são permitidas.";
}



}








?>

