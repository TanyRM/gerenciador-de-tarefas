<?php
require_once '../models/Item.php';
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
            //echo "Encontrou a lista com título: $titulo<br>";
            return $lista;
        }
    }
    //echo "Nenhuma lista encontrada com título: $titulo<br>";
    return null;
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

// Verifica se a requisição é POST para adicionar um novo item à lista ou excluir um item
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['novo_item']) && isset($_POST['titulo'])) {
        $tituloLista = $_POST['titulo'];
        $novoItemNome = $_POST['novo_item']; // Obter apenas o nome do novo item

        // encontrar a lista correspondente na lista de listas do usuário
        $listaExibir = encontrarListaPorTitulo($usuario->getListas(), $tituloLista);

        // verificar se é uma instância de Lista e adiciona o novo item
        if ($listaExibir instanceof Lista) {
            $novoItem = new Item($novoItemNome); // Criar um novo objeto Item com o nome fornecido
            $listaExibir->adicionarItem($novoItem); // Adicionar o objeto Item à lista
        } else {
            $_SESSION['mensagem'] = "Lista não encontrada!";
        }
    } elseif (isset($_POST['excluir_item']) && isset($_POST['item_index']) && isset($_POST['titulo'])) {
        $itemIndex = $_POST['item_index'];
        $tituloLista = $_POST['titulo']; // Obter o título da lista
        $listaExibir = encontrarListaPorTitulo($usuario->getListas(), $tituloLista);

        // Verifica se a lista existe e se é uma instância de Lista
        if ($listaExibir instanceof Lista) {
            // Chama o método excluirItem da lista para remover o item pelo índice
            $listaExibir->excluirItem($itemIndex);
        } else {
            $_SESSION['mensagem'] = "Lista não encontrada!";
        }
    }
    else if (isset($_POST['editar_titulo']) && isset($_POST['novo_titulo']) && isset($_POST['titulo'])) {
        $tituloLista = $_POST['titulo']; // Obter o título da lista
        $novoTitulo = $_POST['novo_titulo']; // Obter o novo título da lista

        // encontrar a lista correspondente na lista de listas do usuário
        $listaExibir = encontrarListaPorTitulo($usuario->getListas(), $tituloLista);

        // verificar se é uma instância de Lista e atualizar o título
        if ($listaExibir instanceof Lista) {
            $listaExibir->setTitulo($novoTitulo);
            
            // Redirecionar para a página exibir_lista.php com o novo título
            header("Location: exibir_lista.php?titulo=" . urlencode($novoTitulo));
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- identifica a lista e usa o título dela como título da página -->
    <title><?php echo ($listaExibir ? $listaExibir->getTitulo() : 'Lista não encontrada'); ?></title>
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
        /* Estilizando os itens concluídos com sublinhado */
        .concluido {
            text-decoration: line-through;
        }

        /* Estilizando o quadrado para concluir/desconcluir itens */
        .concluir {
            display: inline-block;
            width: 15px;
            height: 15px;
            border: 1px solid black;
            cursor: pointer;
            text-align: center; /* Alinhar o texto no centro do quadrado */
            line-height: 15px; /* Centralizar verticalmente o texto no quadrado */
        }

        /* Estilizando a lista */
        .item-list {
            padding-left: 20px;
            padding-right: 5px;
        }

        .item-nome {
            padding-left: 5px; /* Adicione o espaçamento desejado */
        }

        /* Estilizando o campo de edição do item */
        .editar-item-form {
            display: none;
        }

        .editar-item-form.show {
            display: inline-block;
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

        .back-link {
            position: absolute;
            bottom: 20px;
        }

        .editar-icon {
            width: 15px;
            height: 15px;
            margin-left: 50px;
        }

        .excluir-icon {
            width: 15px;
            height: 15px;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <?php if ($listaExibir) { // se for instância de lista ?>
        
        <!-- Verifica se está no modo de edição do título -->
        <?php if (isset($_GET['editar_titulo'])) {
            // Verifica se o formulário de edição foi submetido
            if (isset($_POST['editar_titulo']) && isset($_POST['novo_titulo'])) {
                $novoTitulo = $_POST['novo_titulo']; // Obter o novo título da lista

                $listaExibir->setTitulo($novoTitulo);
                
                // Redirecionar para a página exibir_lista.php com o novo título
                header("Location: exibir_lista.php?titulo=" . urlencode($novoTitulo));
                exit;
            } else {
                // Se ainda não foi submetido o formulário de edição, exibir o formulário
        ?>
            <!-- Formulário para editar o título da lista -->
            <form method="post" class="editar-titulo-form">
                <input type="hidden" name="editar_titulo" value="1">
                <label for="novo_titulo">Novo Título:</label>
                <input type="text" id="novo_titulo" name="novo_titulo" value="<?php echo $listaExibir->getTitulo(); ?>" required>
                <input type="submit" value="Salvar">
            </form>
        <?php } } else { ?>
        <!-- Exibe o título da lista com um link para editar -->
        <h2>
            <?php echo $listaExibir->getTitulo(); ?>
            <a href="?titulo=<?php echo urlencode($listaExibir->getTitulo()); ?>&editar_titulo=1"><img src="imagens/edicao.png" alt="Editar" class="editar-icon"></a>
        </h2>
        <?php } ?>

        <?php
        $itens = $listaExibir->getItens();

        // Verifica se a requisição é POST para concluir/desconcluir ou editar um item
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['alterar_status']) && isset($_POST['item_index']) && isset($_POST['titulo'])) {
                $itemIndex = $_POST['item_index'];
                $tituloLista = $_POST['titulo']; // Obter o título da lista

                $tituloListaDecodificado = urldecode($tituloLista); // Decodificar o título
                $listaExibir = encontrarListaPorTitulo($usuario->getListas(), $tituloListaDecodificado);

                if (isset($itens[$itemIndex]) && $itens[$itemIndex] instanceof Item) {
                    $itemConcluido = $itens[$itemIndex]->getConcluido();
                    $itens[$itemIndex]->setConcluido(!$itemConcluido); // Alterar o status do item
                }
            } else if (isset($_POST['editar_item']) && isset($_POST['item_index']) && isset($_POST['titulo']) && isset($_POST['novo_nome_item'])) {
                $itemIndex = $_POST['item_index'];
                $tituloLista = $_POST['titulo']; // Obter o título da lista
                $novoNomeItem = $_POST['novo_nome_item']; // Obter o novo nome do item
            
                $tituloListaDecodificado = urldecode($tituloLista); // Decodificar o título
                $listaExibir = encontrarListaPorTitulo($usuario->getListas(), $tituloListaDecodificado);
            
                if (isset($itens[$itemIndex]) && $itens[$itemIndex] instanceof Item) {
                    $itens[$itemIndex]->setNome($novoNomeItem); // Alterar o nome do item
                }
                header("Location: exibir_lista.php?titulo=" . urlencode($listaExibir->getTitulo())); // Corrigido o redirecionamento
                exit;
            }
        }
        ?>

        <ul class='item-list'>
            <?php foreach ($itens as $index => $item) {
                $itemNome = $item->getNome();
                $itemConcluido = $item->getConcluido();
                echo "<li>";
                echo "<form method='post' style='display: inline-block;'>";
                echo "<input type='hidden' name='alterar_status' value='1'>";
                echo "<input type='hidden' name='item_index' value='$index'>";
                echo "<input type='hidden' name='titulo' value='". urlencode($listaExibir->getTitulo()) ."'>"; // Adicione esta linha para enviar o título da lista
                echo "<div class='concluir' onclick='parentNode.submit();'>";
                echo ($itemConcluido ? '&#x2713;' : '&nbsp;'); // Exibir o marcador de acordo com o status do item
                echo "</div>";
                echo "</form>";
                
                // Exibe o nome do item em modo de leitura ou edição
                echo "<span class='" . ($itemConcluido ? 'concluido' : '') . "'>";
                if (isset($_GET['editar_item']) && $_GET['editar_item'] == $index) {
                    // Exibir o formulário de edição para o item atual
                    echo "<form method='post' class='editar-item-form show'>";
                    echo "<input type='hidden' name='editar_item' value='$index'>";
                    echo "<input type='hidden' name='item_index' value='$index'>";
                    echo "<input type='hidden' name='titulo' value='". urlencode($listaExibir->getTitulo()) ."'>";
                    echo "<input type='text' name='novo_nome_item' value='$itemNome'>";
                    echo "<button type='submit'>Salvar</button>";
                    echo "</form>";
                } else {
                    // Exibir o nome do item em modo de leitura
                    echo "<span class='item-nome'>$itemNome</span>";
                    echo " <a href='?titulo=" . urlencode($listaExibir->getTitulo()) . "&editar_item=$index'>";
                    echo "<img src='imagens/edicao.png' alt='Editar' class='editar-icon'>";
                    echo "</a>";
                }
                echo "</span>";

                // Adicione a opção de excluir item
                echo "<form method='post' style='display: inline-block; background: none; border: none; padding: 0; margin: 0;'>";
                echo "<input type='hidden' name='excluir_item' value='1'>";
                echo "<input type='hidden' name='item_index' value='$index'>";
                echo "<input type='hidden' name='titulo' value='". urlencode($listaExibir->getTitulo()) ."'>";
                echo "<button type='submit' style='background: none; border: none; padding: 0; margin: 0; cursor: pointer;'>";
                echo "<img src='imagens/excluir.png' class='excluir-icon' alt='Excluir' title='Excluir'>";
                echo "</button>";
                echo "</form>";

                echo "</li>";

            } ?>
        </ul>

        <form method="post">
            <input type="hidden" name="titulo" value="<?php echo $listaExibir->getTitulo(); ?>">
            <label for="novo_item">Novo Item:</label>
            <input type="text" id="novo_item" name="novo_item" required>
            <input type="submit" value="Adicionar">
        </form>
    <?php } else { ?>
        <p>Lista não encontrada.</p>
    <?php } ?>
    <a href="pagina_inicial.php" class="back-link">Voltar</a>
</body>
</html>
