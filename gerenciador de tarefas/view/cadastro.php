<?php

require_once '../models/Usuario.php';
require_once '../controllers/Gerenciador.php';
session_start(); // Inicializa a sessão (retoma a sessão da pagina index)
$gerenciador = $_SESSION['gerenciador']; //retoma a instancia de Gerenciador criada na pagina index 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email']; //atribui a variavel o valor inserido na pag web
    $nome = $_POST['nome'];  
    $senha = $_POST['senha'];

    $usuario = new Usuario($email, $nome, $senha); //cadastra o usuario
    $gerenciador->adicionarUsuario($usuario); //adiciona o usuario cadastrado no servidor
    $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";

    header('Location: login.php'); // Redireciona para a página de login
    exit;
}

?>

<!-- formulario HTML com requisição POST -->
<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title> 
</head>
<body>
    <h1>Cadastre-se</h1>
    <form method="post">
        <label for="email">Email:</label> <!-- descrever pra que servem os campos -->
        <input type="text" id="email" name="email" required> <!-- entrada de dados obrigatória -->
        <br>
        <label for="nome">Nome de usuário:</label> <!-- descrever pra que servem os campos -->
        <input type="text" id="nome" name="nome" required> <!-- entrada de dados obrigatória -->
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <input type="submit" value="cadastrar"> <!-- envia os dados ao servidor -->
    </form>
</body>
</html>