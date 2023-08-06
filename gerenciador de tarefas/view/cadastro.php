<?php
require_once '../models/Usuario.php';
require_once '../controllers/Gerenciador.php';
session_start(); // inicializa a sessão (retoma a sessão da pagina index)
$gerenciador = $_SESSION['gerenciador']; //retoma a instancia de Gerenciador criada na pagina index 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email']; //atribui a variavel o valor inserido na pag web
    $nome = $_POST['nome'];  
    $senha = $_POST['senha'];

    $usuario = new Usuario($email, $nome, $senha); //cadastra o usuario
    $gerenciador->adicionarUsuario($usuario); //adiciona o usuario cadastrado no servidor
    $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";

    header('Location: login.php'); // redireciona para a página de login
    exit;
}
?>

<!-- formulario HTML com requisição POST -->
<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title> 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .login-form {
            padding: 20px;
            border-radius: 0;
            box-shadow: none;
            width: 300px;
            text-align: left;
        }

        .login-form label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-form button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            width: 100%;
        }

        .login-form button:hover {
            background-color: #0056b3;
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .register-link {
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
            margin-top: 5px;
        }

        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Cadastre-se</h1>
    <!-- formulario de cadastro -->
    <form class="login-form" method="post">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        <label for="nome">Nome de usuário:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <div class="button-container">
            <button type="submit" style="width: 300px;">Cadastrar</button>
        </div>
    </form>
</body>
</html>
