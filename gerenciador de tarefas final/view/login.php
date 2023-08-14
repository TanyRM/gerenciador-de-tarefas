<?php
require_once '../models/Usuario.php';
require_once '../controllers/Gerenciador.php';
session_start();

// verifica se a instância do Gerenciador está definida na sessão
if (!isset($_SESSION['gerenciador'])) {
    $_SESSION['mensagem'] = "Erro: Instância do Gerenciador não encontrada.";
    header('Location: index.php'); // redireciona para a página inicial
    exit;
}

$gerenciador = $_SESSION['gerenciador'];
// verifica se tem mensagem na sessão (caso venha da página de cadastro)
if (isset($_SESSION['mensagem'])) {
    echo $_SESSION['mensagem']; // exibe a mensagem
    unset($_SESSION['mensagem']); // limpa a mensagem da sessão 
}

//readline() não funciona para ler dados em pag web
// verificar se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeUsuario = $_POST['nome']; // atribui a variavel o valor inserido na pag web 
    $senha = $_POST['senha']; 

    // verifica se usuario e senha estão corretos
    if ($gerenciador->validarDados($nomeUsuario, $senha)) {
        echo "Login bem-sucedido!";
        $_SESSION['nomeUsuario'] = $nomeUsuario; // armazena o nome de usuário na sessão
    
        header('Location: pagina_inicial.php'); // redireciona para a página inicial
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
            border-radius: 0; /* Remove a borda do container */
            box-shadow: none; /* Remove a sombra */
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

        .link-container {
            display: flex;
            flex-direction: column;
            align-items: center;
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
    <h1>Login</h1>
    <!-- formulário de login -->
    <form class="login-form" method="post">
        <label for="nome">Nome de usuário:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <button type="submit">Entrar</button>
        <div class="link-container">
            <a href="cadastro.php" class="register-link">Cadastrar</a>
        </div>
    </form>
</body>
</html>

