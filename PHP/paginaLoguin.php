<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link rel="stylesheet" href="./css/styleLogin.css">
    <link rel="stylesheet" href="../CSS/paginaLogin.css">
</head>
<body>

    <form action="./paginaLoguin.php" method="POST">

        <h2 class="titulo">Login de Usuário</h2>
        
        <label for="usuario">Usuário</label>
        <input type="text" id="usuario" name="usuario" required><br>
        
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required>
        
        <button type="submit">ENTRAR</button>

    </form>


  

    <?php

    session_start();

    include "./class.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // O formulário foi submetido

        // Verifique se os campos de usuário e senha estão preenchidos
        if (isset($_POST['usuario']) && isset($_POST['senha'])) {
            // Os campos de usuário e senha estão preenchidos

            // Execute ações necessárias com os dados aqui
            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];

            $dadosUsuario = new Database("localhost", "root", "", "produtos");

            $usuarioLogado = $dadosUsuario->selectLogin("usuarios", $usuario, $senha);

            if ($usuarioLogado) {
                // Decode a string JSON para um array associativo
                $usuarioLogadoArray = json_decode($usuarioLogado, true);

                if (!empty($usuarioLogadoArray)) {
                    // Se o array não estiver vazio, exiba uma mensagem de boas-vindas

                    $usuario = $usuarioLogadoArray[0]['usuario']; // puxando o nome do usuario do array
                    $id = $usuarioLogadoArray[0]['id']; // puxando o id do usuario do array

                    $_SESSION['usuario'] = $usuario; // criacao de variaveis de sessao de usuario
                    $_SESSION['id'] = $id; // criacao de variaveis de sessao de usuario

                    header("location:paginaHome.php");
                } else {
                    // Se o array estiver vazio, exiba uma mensagem de erro
                    echo "Usuário não encontrado. Verifique suas credenciais.";
                }
            }
        }
    }
    ?>

    <script src="./metodos/teste345.js"></script>
</body>
</html>
