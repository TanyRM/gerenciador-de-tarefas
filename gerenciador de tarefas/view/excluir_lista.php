<?php
require_once '../models/Lista.php';
require_once '../models/Usuario.php';
require_once '../controllers/Gerenciador.php';
session_start();
$gerenciador = $_SESSION['gerenciador'];

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
} 
else {
    $_SESSION['mensagem'] = "Você precisa realizar login!";
    header('Location: login.php'); // envia um endereço http 
    exit;
}

if (isset($_GET['titulo'])) {
    $tituloLista = $_GET['titulo'];

    // Encontra a lista correspondente na lista de listas do usuário
    $listaExcluir = encontrarListaPorTitulo($usuario->getListas(), $tituloLista);

    if (!$listaExcluir) {
        $_SESSION['mensagem'] = "Lista não encontrada!";
        header('Location: pagina_inicial.php');
        exit;
    }
} else {
    $_SESSION['mensagem'] = "Título da lista não fornecido!";
    header('Location: pagina_inicial.php');
    exit;
}

// Função para encontrar uma lista pelo título
function encontrarListaPorTitulo($listas, $titulo) {
    foreach ($listas as $lista) {
        if ($lista->getTitulo() === $titulo) {
            return $lista;
        }
    }
    return null;
}

// Verifica se a requisição é POST para confirmar a exclusão
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirmar'])) {
        // Remove a lista do usuário
        $usuario->excluirLista($listaExcluir);

        // Redireciona o usuário de volta para a página inicial
        $_SESSION['mensagem'] = "Lista excluída com sucesso!";
        header('Location: pagina_inicial.php');
        exit;
    } elseif (isset($_POST['cancelar'])) {
        // Redireciona o usuário de volta para a página inicial
        header('Location: pagina_inicial.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Excluir Lista</title>
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
    </style>
</head>

<body>
    <h2>Deseja realmente excluir a lista "<?php echo $listaExcluir->getTitulo(); ?>"?</h2>
    <form method="post">
        <input type="submit" name="confirmar" value="Confirmar">
        <input type="submit" name="cancelar" value="Cancelar">
    </form>
</body>
</html>