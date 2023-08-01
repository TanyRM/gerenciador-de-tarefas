<?php 
require_once 'Gerenciador.php';
session_start();

// Verifica se o usuário já está logado (neste exemplo, armazenamos um valor na sessão para indicar o login bem-sucedido)
$loggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true;

// Se já estiver logado, redireciona para a página de boas-vindas
if ($loggedIn) {
    header("Location: bem-vindo.php");
    exit;
}

// Caso contrário, mostra a página inicial
$gerenciador = new Gerenciador();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Inicial</title>
</head>
<body>
    <h1>Bem-vindo à Página Inicial</h1>
    <a href="login.php">Entrar</a>
    <a href="cadastro.php">Cadastrar</a>
</body>
</html>