<?php

session_start();

include_once "./class.php";


$selectlogo = new Database('localhost','root','','dadosempresa');

if (isset($_SESSION['id']) && isset($_SESSION['usuario'])){


   $dados = $selectlogo -> select('dadosempresa');

   $dados2 =  json_encode($dados);

    $id = $_SESSION['id'];
    $usuario = $_SESSION['usuario'];
    $adminxuser = $_SESSION['adminxuser'];





$arrayDeDados = json_decode($dados2, true);

if(isset($arrayDeDados[0]['id'])){

// Acessar os valores individuais
$id = $arrayDeDados[0]['id'];
$nome = $arrayDeDados[0]['nome'];
$imglogo = $arrayDeDados[0]['imglogo'];
$telefone = $arrayDeDados[0]['telefone'];


 echo '<p id="usuario" > usuario logado:  '.$usuario.'</p>';

echo '<section class=logosectio>';


echo '<img class="logo" src="'.$imglogo.'" alt="">';
 

 //echo '<h1>'.$nome.'</h1>';

 echo  '<nav class="menu_principal">';
 
 

 echo '<img  src="../imagens/home2.png"  class="icones" alt=""><a href="http://localhost/loja_homologacao/PHP/paginaHome.php">home</a>';
 echo '<img src="../imagens/carrinho2.png" alt="" class="icones"><a href="http://localhost/loja_homologacao/PHP/paginaCarrinho.php">Carrinho</a>';
 echo '<img  src="../imagens/contato.png"  class="icones" alt=""><a href="http://localhost/loja_homologacao/PHP/paginaHome.php">Contato</a>';

if($adminxuser === 1){

   echo '<img src="../imagens/carrinho2.png" alt="" class="icones"><a href="http://localhost/loja_homologacao/PHP/paginaCarrinho.php">editar empresa</a>';


}


echo  '</nav>';




echo '</section>';


} else {

   echo '<section class=logosectio>';
   echo '<img class="logo" src="" alt="">';
   echo '<h1>sem nome</h1>';
   echo '</section>';

}


 echo '<section id = "menu">';

 

 

 echo '</section>';

 

 






}else{


   $dados = $selectlogo -> select('dadosempresa');

   $dados2 =  json_encode($dados);


$arrayDeDados = json_decode($dados2, true);

if(isset($arrayDeDados[0]['id'])){

// Acessar os valores individuais
$id = $arrayDeDados[0]['id'];
$nome = $arrayDeDados[0]['nome'];
$imglogo = $arrayDeDados[0]['imglogo'];
$telefone = $arrayDeDados[0]['telefone'];

}

echo '<section class=logosectio>';
 echo '<img class="logo" src="'.$imglogo.'" alt="">';
 echo '<h1>'.$nome.'</h1>'; 
echo '</section>';


   echo '<section id = "menu">';

 echo  '<nav class="menu_principal">';
 
 

    echo '<a href="http://localhost/loja_homologacao/PHP/paginaHome.php">home</a>';
    echo '<a href="">Carrinho</a>';
    echo '<a href="">Contato</a>';
  
  
  
  
 echo  '</nav>';

 

 echo '</section>';
}


