<?php
require_once '../models/Lista.php';
require_once '../models/Usuario.php';
require_once '../controllers/Gerenciador.php';
session_start();
$gerenciador = $_SESSION['gerenciador'];

// verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensagem'] = "Você precisa realizar login!";
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];

// função para encontrar uma lista pelo título
function encontrarListaPorTitulo($listas, $titulo) {
    foreach ($listas as $lista) {
        if ($lista->getTitulo() === $titulo) {
            return $lista;
        }
    }
    return null;
}

// verificar se a requisição é POST para adicionar um novo item à lista
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tituloLista = $_POST['titulo'];
    $novoItem = $_POST['novo_item'];

    // encontrar a lista correspondente na lista de listas do usuário
    $listaExibir = encontrarListaPorTitulo($usuario->getListas(), $tituloLista);

    // verificar se é uma instância de Lista e adiciona o novo item
    if ($listaExibir instanceof Lista) {
        $listaExibir->adicionarItem($novoItem);
    } else {
        $_SESSION['mensagem'] = "Lista não encontrada!";
    }
}

// verificar se o título da lista foi fornecido e encontra a lista 
if (isset($_GET['titulo'])) {
    $tituloLista = $_GET['titulo'];

    $listaExibir = encontrarListaPorTitulo($usuario->getListas(), $tituloLista);

    if (!$listaExibir) {
        $_SESSION['mensagem'] = "Lista não encontrada!";
        header('Location: pagina_inicial.php');
        exit;
    }
} 

?>

<!DOCTYPE html>
<html>
<head>
    <!-- se for uma instancia de Lista exibe o titulo -->
    <title><?php echo ($listaExibir ? $listaExibir->getTitulo() : 'Lista não encontrada'); ?></title>
</head>
<body>
    <?php if ($listaExibir) { // se for instancia de lista ?>
        <h2><?php echo $listaExibir->getTitulo(); ?></h2>
        <?php
        $itens = $listaExibir->getItens();
        // exibe os itens
        if (empty($itens)) {
            echo "<p>A lista está vazia.</p>";
        } else {
            echo "<ul>"; //lista não ordenada
            foreach ($itens as $item) {
                echo "<li>$item</li>";
            }
            echo "</ul>";
        }
        ?>
        <form method="post">
            <input type="hidden" name="titulo" value="<?php echo $listaExibir->getTitulo(); ?>"> <!-- indica a lista que esta sendo modificada mas não deixa visivel -->
            <label for="novo_item">Novo Item:</label>
            <input type="text" id="novo_item" name="novo_item" required>
            <input type="submit" value="Adicionar">
        </form>
    <?php } else { ?>
        <p>Lista não encontrada.</p>
    <?php } ?>
    <a href="pagina_inicial.php">Voltar</a>
</body>
</html>
