<?php

require_once '../models/Usuario.php';
require_once '../controllers/Gerenciador.php';
session_start(); // Inicializa a sessão (retoma a sessão da pagina index)
$gerenciador = $_SESSION['gerenciador']; //retoma a instancia de Gerenciador criada na pagina index

//verifica se tem mensagem na sessão (caso venha da página de cadastro)
if (isset($_SESSION['mensagem'])) {
    echo $_SESSION['mensagem']; // Exibe a mensagem
    unset($_SESSION['mensagem']); // Limpa a mensagem da sessão 
}

//readline() não funciona para ler dados em pag web
//verificar se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeUsuario = $_POST['nome']; //atribui a variavel o valor inserido na pag web 
    $senha = $_POST['senha']; 

    if ($gerenciador->validarDados($nomeUsuario, $senha)) {
        echo "Login bem-sucedido!";
        $usuario = new Usuario(' ',$nomeUsuario, $senha);
        $_SESSION['usuario'] = $usuario; //registra o usuario que está usando a sessão

        header('Location: pagina_inicial.php'); // Redireciona para a página inicial
        exit;
    } 
    else {
        echo "Nome de usuário ou senha incorretos.";
    }
}

?>

<!-- formulario HTML com requisição POST -->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title> 
</head>
<body>
    <h1>Login</h1>
    <form method="post">
        <label for="nome">Nome de usuário:</label> <!-- descrever pra que servem os campos -->
        <input type="text" id="nome" name="nome" required> <!-- entrada de dados obrigatória -->
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <input type="submit" value="Entrar"> <!-- envia os dados ao servidor -->
        <a href="cadastro.php">Cadastrar</a>
    </form>
</body>
</html>