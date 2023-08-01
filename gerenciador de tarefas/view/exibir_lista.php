<?php

require_once '../models/Item.php';
require_once '../models/Lista.php';
require_once '../models/Usuario.php';
require_once '../controllers/Gerenciador.php';
session_start();
$gerenciador = $_SESSION['gerenciador'];

// verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensagem'] = "Você precisa realizar login!";
    header('Location: login.php');
    exit;
}

// obtem as listas do usuario
$usuario = $_SESSION['usuario'];
$listasUsuario = $usuario->getListas();

// verificar se o ID da lista foi informado
if (isset($_GET['id'])) {
    $idLista = $_GET['id'];

    // identifica a lista pelo ID
    foreach ($listasUsuario as $lista) {
        if ($lista->getId() == $idLista) {
            $listaExibir = $lista;
            break;
        }
    }

    if ($listaExibir) { // se encontrar a lista exibe os itens
        $itensLista = $listaExibir->getItens();
    } 
    else {
        $_SESSION['mensagem'] = "Lista não encontrada!";
        header('Location: pagina_inicial.php');
        exit;
    }
} 
else {
    // se não identificar o ID retorna
    $_SESSION['mensagem'] = "ID da lista não fornecido!";
    header('Location: pagina_inicial.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoItem = $_POST['novo_item'];
    $listaExibir->adicionarItem($novoItem);
    // atualiza a lista com o novo item
    header("Location: exibir_lista.php?id=$idLista");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $listaExibir->getTitulo(); ?></title>
    <h1></h1>
</head>
<body>
<h2><?php echo $listaExibir->getTitulo(); ?></h2>
    <?php
    $itens = $listaExibir->getItens(); 
    if (empty($itens)) {
        echo "<p>A lista está vazia.</p>";
    } 
    else {
        echo "<ul>";
        foreach ($itens as $item) { // lista os itens
            echo "<li>$item</li>";
        }
        echo "</ul>";
    }
    ?>
<form method="post">
    <!-- adicionar novo item -->
    <label for="novo_item">Novo Item:</label>
    <input type="text" id="novo_item" name="novo_item" required>
    <input type="submit" value="Adicionar">
</form>
<a href="pagina_inicial.php">Voltar</a>
</body>
</html>
