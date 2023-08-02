<?php
require_once '../models/Lista.php';
require_once '../models/Usuario.php';
require_once '../controllers/Gerenciador.php';
session_start();
$gerenciador = $_SESSION['gerenciador'];

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensagem'] = "Você precisa realizar login!";
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];

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
</head>
<body>
    <h1>Nova Lista</h1>
    <form method="post">
        <!-- formulario de nova lista -->
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>
        <br>
        <input type="submit" value="Criar">
    </form>
    <a href="pagina_inicial.php">Voltar</a>
</body>
</html>
