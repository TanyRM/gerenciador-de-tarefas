<?php
require_once '../models/Item.php';
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

if (isset($_SESSION['mensagem'])) {
    echo $_SESSION['mensagem']; // exibe a mensagem
    unset($_SESSION['mensagem']); // limpa a mensagem da sessão 
}

// registra o usuario da sessão
$nomeUsuario = $_SESSION['nomeUsuario'];
$usuario = $gerenciador->getUsuario($nomeUsuario);

function encontrarLista($listas, $titulo) {
    foreach ($listas as $lista) {
        if ($lista->getTitulo() === $titulo) {
            return $lista;
        }
    }
    return null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Minhas Listas</title>
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

        h2 {
            color: #333;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        form {
            margin-top: 20px;
            display: flex;
            align-items: center;
        }

        input[type="text"] {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        ul li {
            margin-bottom: 10px;
        }

        ul li a {
            text-decoration: none;
            color: #007bff;
        }

        ul li a:hover {
            text-decoration: underline;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 10px;
            text-decoration: none;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .logout-link {
            position: absolute;
            bottom: 20px;
        }

        .create-button {
            background-color: #007bff;
            color: #fff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            text-decoration: none;
            margin-top: 10px;
        }

        .create-button:hover {
            background-color: #0056b3;
        }
        .item-list {
            padding-right: 10px;
        }

        .excluir-icon {
            width: 15px;
            height: 15px;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <h1>Gerenciador de tarefas</h1>

    <!-- ferramenta de busca -->
    <form method="get" action="pagina_inicial.php">
        <label for="q">Buscar lista:</label>
        <input type="text" id="q" name="q">
        <input type="submit" value="Buscar">
    </form>
    
    <?php
    // verifica se o termo de busca foi enviado pelo formulário
    if (isset($_GET['q'])) {
        $termoBusca = $_GET['q'];

        // filtra as listas com base no termo de busca
        $listasFiltradas = array_filter($usuario->getListas(), function ($lista) use ($termoBusca) {
            return strpos($lista->getTitulo(), $termoBusca) !== false;
        });

        // exibe as listas filtradas
        if (!empty($listasFiltradas)) {
            echo "<h2>Listas encontradas:</h2>";
            echo "<ul>";
            foreach ($listasFiltradas as $lista) {
                echo "<li><a href='exibir_lista.php?titulo=" . urlencode($lista->getTitulo()) . "'>" . $lista->getTitulo() . "</a></li>";
            }
            echo "</ul>";
        } 
        else {
            echo "<p>Nenhuma lista encontrada.</p>";
        }
    }
    ?>
    
    <!-- lista de todas as listas -->
    <h2>Suas listas:</h2>
<ul>
    <?php foreach ($usuario->getListas() as $lista) : ?>
        <li>
            <a href='exibir_lista.php?titulo=<?php echo urlencode($lista->getTitulo()); ?>'><?php echo $lista->getTitulo(); ?></a> <!-- link para exibir a lista -->
            <a href='excluir_lista.php?titulo=<?php echo urlencode($lista->getTitulo()); ?>' class="delete-button"><img src='imagens/excluir.png' class='excluir-icon' alt='Excluir' title='Excluir'></a> <!-- link para excluir a lista -->
        </li>
    <?php endforeach; ?>
</ul>
<div class="button-container">
    <a href="criar_lista.php" class="create-button">+</a>
</div>
</body>
<a href="confirmar_logout.php" class="logout-link">Sair</a>
</html>