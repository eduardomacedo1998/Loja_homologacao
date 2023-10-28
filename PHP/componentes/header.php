<?php

session_start();

include_once "./class.php";


$selectlogo = new Database('localhost','root','','dadosempresa');

if (isset($_SESSION['id']) && isset($_SESSION['usuario'])){


   $dados = $selectlogo -> select('dadosempresa');

   $dados2 =  json_encode($dados);

    $id = $_SESSION['id'];
    $usuario = $_SESSION['usuario'];





$arrayDeDados = json_decode($dados2, true);

if(isset($arrayDeDados[0]['id'])){

// Acessar os valores individuais
$id = $arrayDeDados[0]['id'];
$nome = $arrayDeDados[0]['nome'];
$imglogo = $arrayDeDados[0]['imglogo'];
$telefone = $arrayDeDados[0]['telefone'];


echo '<section class=logosectio>';
 echo '<img class="logo" src="'.$imglogo.'" alt="">';
 echo '<h1>'.$nome.'</h1>'; echo '<p id="usuario" > usuario logado:  '.$usuario.'</p>';
echo '</section>';



} else {

   echo '<section class=logosectio>';
   echo '<img class="logo" src="" alt="">';
   echo '<h1>sem nome</h1>';
   echo '</section>';

}


 echo '<section id = "menu">';

 echo  '<nav class="menu_principal">';
 
 

    echo '<a href="http://localhost/loja_homologacao/PHP/paginaHome.php">home</a>';
    echo '<a href="">Carrinho</a>';
    echo '<a href="">Contato</a>';
  
  
  
  
 echo  '</nav>';

 

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


