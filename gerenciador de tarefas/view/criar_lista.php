<?php
require_once '../models/Lista.php';
require_once '../models/Usuario.php';
require_once '../controllers/Gerenciador.php';
session_start();
$gerenciador = $_SESSION['gerenciador'];

// verifica se o usuário está logado
if (!isset($_SESSION['nomeUsuario'])) {
    $_SESSION['mensagem'] = "Você precisa realizar login!";
    header('Location: login.php');
    exit;
}

$nomeUsuario = $_SESSION['nomeUsuario'];
$usuario = $gerenciador->getUsuario($nomeUsuario);

// verifica se o formulário foi submetido para criar uma nova lista
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $lista = new Lista($titulo); //cria a lista
    $usuario->adicionarLista($lista); // adiciona a lista ao usuário

    // redireciona para a página da lista criada
    header("Location: exibir_lista.php?titulo=" . urlencode($lista->getTitulo()));
    exit;
}

$listasUsuario = $usuario->getListas(); // atualiza o array com as listas do usuario

?>

<!DOCTYPE html>
<html>
<head>
    <title>Nova Lista</title>
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
            margin-bottom: 20px;
        }

        form {
            width: 300px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 161px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 10px;
        width: 100%;
        text-align: center; /* Centraliza o texto no botão */
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
        }

        a:hover {
            text-decoration: underline;
        }

        .back-link {
            position: absolute;
            bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Nova Lista</h1>
    <!-- formulario de nova lista -->
    <form method="post">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>
        <br>
        <input type="submit" value="Criar"> <!-- envia o formulario -->
    </form>
    <a href="pagina_inicial.php" class="back-link">Voltar</a>
</body>
</html>