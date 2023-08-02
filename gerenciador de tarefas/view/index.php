<?php 

require_once '../models/Usuario.php';
require_once '../controllers/Gerenciador.php';
session_start(); // Inicializa a sessão

if (!isset($_SESSION['gerenciador'])) {
    $_SESSION['gerenciador'] = new Gerenciador(); // Inicializa o gerenciador na sessão se ainda não estiver definido
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Inicial</title>
</head>
<body>
    <h1>Bem-vindo</h1>
    <a href="login.php">Entrar</a>
    <a href="cadastro.php">Cadastrar</a>
</body>
</html>