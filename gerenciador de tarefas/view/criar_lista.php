<?php

require_once '../models/Lista.php';
require_once '../models/Usuario.php';
require_once '../controllers/Gerenciador.php';
session_start();
$gerenciador = $_SESSION['gerenciador'];

// Verificar se o formulário foi submetido para criar uma nova lista
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo']; 
    $lista = new Lista($titulo);
    $usuario = $_SESSION['usuario'];
    $usuario->adicionarLista($lista); // Adiciona a lista ao usuário

    // Redireciona para a página de exibição da lista
    header("Location: exibir_lista.php?id={$lista->getId()}");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title> 
</head>
<body>
    <h1> Nova Lista </h1>
    <form method="post">
        <label for="titulo">Título:</label> <!-- descrever pra que servem os campos -->
        <input type="text" id="titulo" name="titulo" required> <!-- entrada de dados obrigatória -->
        <br>
        <input type="submit" value="Criar"> <!-- envia os dados ao servidor -->
    </form>
    <a href="pagina_inicial.php">Voltar</a>
</body>
</html>
