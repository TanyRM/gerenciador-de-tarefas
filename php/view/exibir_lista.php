<?php
require_once '../models/Item.php';
require_once '../models/Lista.php';
require_once '../models/Usuario.php';
require_once '../controllers/Gerenciador.php';
session_start();
ob_start(); //captura conteudo gerado em um buffer de saida
$gerenciador = $_SESSION['gerenciador'];

// verifica se o usuário está logado
if (!isset($_SESSION['nomeUsuario'])) {
    $_SESSION['mensagem'] = "Você precisa realizar login!";
    header('Location: login.php');
    exit;
}

$nomeUsuario = $_SESSION['nomeUsuario'];
$usuario = $gerenciador->getUsuario($nomeUsuario);

// função para encontrar uma lista pelo título
function encontrarLista($listas, $titulo) {
    foreach ($listas as $lista) {
        if ($lista->getTitulo() === $titulo) {
            return $lista;
        }
    }
    return null;
}

// verificar se o título da lista foi fornecido e encontra a lista 
if (isset($_GET['titulo'])) {
    $tituloLista = $_GET['titulo'];

    $listaExibir = encontrarLista($usuario->getListas(), $tituloLista);

    if (!$listaExibir) {
        $_SESSION['mensagem'] = "Lista não encontrada!";
        header('Location: pagina_inicial.php');
        exit;
    }
} 

// verifica se a requisição é POST para adicionar um novo item à lista ou excluir um item
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // lógica para adicionar novo item
    if (isset($_POST['novo_item']) && isset($_POST['titulo'])) {
        $tituloLista = $_POST['titulo'];
        $novoItemNome = $_POST['novo_item']; 
        $prioridade = intval($_POST['prioridade']); // obtem a prioridade como um número inteiro
    
        $listaExibir = encontrarLista($usuario->getListas(), $tituloLista);
    
        // verificar se é uma instância de Lista e adiciona o novo item
        if ($listaExibir instanceof Lista) {
            $novoItem = new Item($novoItemNome);
            $novoItem->setPrioridade($prioridade); 
            $listaExibir->adicionarItem($novoItem);
        } 
        else {
            $_SESSION['mensagem'] = "Lista não encontrada!";
        }
    }
    // lógica para excluir item
    elseif (isset($_POST['excluir_item']) && isset($_POST['item_index']) && isset($_POST['titulo'])) {
        $itemIndex = $_POST['item_index']; // obtem o indice do objeto a ser excluido
        $tituloLista = $_POST['titulo']; // obtem o título da lista
        
        $tituloListaDecodificado = urldecode($tituloLista); // decodificar o título para URL
        $listaExibir = encontrarLista($usuario->getListas(), $tituloListaDecodificado);

        if ($listaExibir instanceof Lista) {
            $listaExibir->excluirItem($itemIndex);
        } 
        else {
            $_SESSION['mensagem'] = "Lista não encontrada!";
        }
    }
    // lógica para editar o titulo
    else if (isset($_POST['editar_titulo']) && isset($_POST['novo_titulo']) && isset($_POST['titulo'])) {
        $tituloLista = $_POST['titulo']; 
        $novoTitulo = $_POST['novo_titulo'];

        $listaExibir = encontrarLista($usuario->getListas(), $tituloLista);

        if ($listaExibir instanceof Lista) {
            $listaExibir->setTitulo($novoTitulo);
            
            // redirecionar para a página exibir_lista.php com o novo título
            header("Location: exibir_lista.php?titulo=" . urlencode($novoTitulo));
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
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
        
        .concluido {
            text-decoration: line-through; /* estilizando os itens concluídos com sublinhado */
        }

        /* estilizando o quadrado para concluir/desconcluir itens */
        .concluir {
            display: inline-block;
            width: 15px;
            height: 15px;
            border: 1px solid black;
            cursor: pointer;
            text-align: center; /* Alinhar o texto no centro do quadrado */
            line-height: 15px; /* Centralizar verticalmente o texto no quadrado */
        }

        /* estilizando a lista */
        .item-list {
            padding-left: 20px;
            padding-right: 5px;
        }

        .item-nome {
            padding-left: 5px; /* espaçamento entre o quadrado e o item */
        }

        /* estilizando o campo de edição do item */
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

        .editar-icon { /* formatar o icon de edição */
            width: 15px;
            height: 15px;
            margin-left: 5px;
        }

        .editar-icon-titulo { /* formatar o icon de edição no titulo */
            width: 15px;
            height: 15px;
            margin-left: 10px;
        }

        .excluir-icon { /* formatar o icon de excluir */
            width: 15px;
            height: 15px;
            margin-left: 5px;
        }

        .prioridade {
            margin-left: 50px;
        }

        .prioridade-1 {
            color: red; 
        }

        .prioridade-2 {
            color: orange; 
        }

        .prioridade-3 {
            color: yellow; 
        }

        .prioridade-4 {
            color: blue; 
        }

        .prioridade-5 {
            color: green;
        }
    </style>
</head>
<body>
    <?php 
    if ($listaExibir) { // se for instância de lista ?>
        <!-- verifica se tem requisição GET para editar o titulo -->
        <?php 
        if (isset($_GET['editar_titulo'])) {
            // verifica se o formulário de edição foi submetido
            if (isset($_POST['editar_titulo']) && isset($_POST['novo_titulo'])) {
                $novoTitulo = $_POST['novo_titulo'];

                $listaExibir->setTitulo($novoTitulo);
                
                // redirecionar para a página exibir_lista.php com o novo título
                header("Location: exibir_lista.php?titulo=" . urlencode($novoTitulo));
                exit;
            } 
            else { // exibir o formulário ?>
                <!-- formulário para editar o título da lista -->
                <form method="post" class="editar-titulo-form">
                    <input type="hidden" name="editar_titulo" value="1">
                    <label for="novo_titulo">Novo Título:</label>
                    <input type="text" id="novo_titulo" name="novo_titulo" value="<?php echo $listaExibir->getTitulo(); ?>" required>
                    <input type="submit" value="Salvar">
                </form>
        <?php } 
        } 
        else {?>
            <!-- se não exibe o título da lista com um link para editar -->
            <h2>
                <?php echo $listaExibir->getTitulo();?>
                <a href="?titulo=<?php echo urlencode($listaExibir->getTitulo()); ?>&editar_titulo=1"><img src="imagens/edicao.png" alt="Editar" class="editar-icon-titulo"></a>
            </h2>
        <?php } 

        $itens = $listaExibir->getItens();

        // verifica se a requisição é POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // verifica se é para concluir/desconcluir um item 
            if (isset($_POST['alterar_status']) && isset($_POST['item_index']) && isset($_POST['titulo'])) {
                $itemIndex = $_POST['item_index']; 
                $tituloLista = $_POST['titulo']; 

                $tituloListaDecodificado = urldecode($tituloLista); // decodificar o título para URL
                $listaExibir = encontrarLista($usuario->getListas(), $tituloListaDecodificado);

                if (isset($itens[$itemIndex]) && $itens[$itemIndex] instanceof Item) {
                    $itemConcluido = $itens[$itemIndex]->getConcluido();
                    $itens[$itemIndex]->setConcluido(!$itemConcluido); // altera o status do item (conclui ou desconclui)
                }
            }
            // verifica se é pra editar um item
            else if (isset($_POST['editar_item']) && isset($_POST['item_index']) && isset($_POST['titulo']) && isset($_POST['novo_nome_item'])) {
                $itemIndex = $_POST['item_index'];
                $tituloLista = $_POST['titulo']; 
                $novoNomeItem = $_POST['novo_nome_item']; // obter o novo nome do item
            
                $tituloListaDecodificado = urldecode($tituloLista); // decodificar o título para URL
                $listaExibir = encontrarLista($usuario->getListas(), $tituloListaDecodificado);
            
                if (isset($itens[$itemIndex]) && $itens[$itemIndex] instanceof Item) {
                    $itens[$itemIndex]->setNome($novoNomeItem); 
                }
                $output = ob_get_clean(); // recupera o conteudo e limpa o buffer para redirecionar corretamente
                header("Location: exibir_lista.php?titulo=".urlencode($listaExibir->getTitulo())); // recarrega a pagina de exibição
                exit;
            }
        }
        ?>
        <!-- exibe os itens e os elementos da lista -->
        <ul class='item-list'>
            <?php 
            foreach ($itens as $index => $item) {
                $itemNome = $item->getNome();
                $itemConcluido = $item->getConcluido();
                $itemPrioridade = $item->getPrioridade();
                // quadrado de conclusão
                echo "<li>";
                echo "<form method='post' style='display: inline-block;'>"; 
                echo "<input type='hidden' name='alterar_status' value='1'>"; // envia a requisição para alterar 
                echo "<input type='hidden' name='item_index' value='$index'>"; // indica o indice do item
                echo "<input type='hidden' name='titulo' value='". urlencode($listaExibir->getTitulo()) ."'>"; // envia o título da lista para recarregar a pagina
                echo "<div class='concluir' onclick='parentNode.submit();'>"; 
                echo ($itemConcluido ? '&#x2713;' : '&nbsp;'); // exibir o marcador de acordo com o status do item
                echo "</div>";
                echo "</form>";
                
                // exibe o nome do item em modo de leitura ou edição
                echo "<span class='" . ($itemConcluido ? 'concluido' : '') . "'>";
                if (isset($_GET['editar_item']) && $_GET['editar_item'] == $index) { // formulario se receber editar_item
                    // exibir o item em modo de edição
                    echo "<form method='post' class='editar-item-form show'>"; 
                    echo "<input type='hidden' name='editar_item' value='$index'>"; // envia a requisição para editar o nome do item e indica o indice
                    echo "<input type='hidden' name='item_index' value='$index'>";
                    echo "<input type='hidden' name='titulo' value='". urlencode($listaExibir->getTitulo()) ."'>"; // envia o título da lista para recarregar a pagina
                    echo "<input type='text' name='novo_nome_item' value='$itemNome'>"; // lê o novo nome do item
                    echo "<button type='submit'>Salvar</button>"; 
                    echo "</form>";
                } 
                else {
                    // exibe o nome do item em modo de leitura
                    echo "<span class='" . ($itemConcluido ? 'concluido' : '') . "'>";
                    echo "<span class='item-nome'>$itemNome</span>";
            
                    // determina a classe de prioridade com base no valor de prioridade
                    $prioridadeClass = "prioridade-" . $itemPrioridade;
            
                    // exibe a prioridade com a classe de cor correspondente
                    echo " <span class='prioridade $prioridadeClass'>[$itemPrioridade]</span>"; 
                    echo " <a href='?titulo=" . urlencode($listaExibir->getTitulo()) . "&editar_item=$index'>";
                    echo "<img src='imagens/edicao.png' alt='Editar' class='editar-icon'>";
                    echo "</a>";
                    echo "</span>";
                }

                // opção de excluir item
                echo "<form method='post' style='display: inline-block; background: none; border: none; padding: 0; margin: 0;'>";
                echo "<input type='hidden' name='excluir_item' value='1'>"; // envia a requisição para excluir
                echo "<input type='hidden' name='item_index' value='$index'>"; // envia o indice 
                echo "<input type='hidden' name='titulo' value='". urlencode($listaExibir->getTitulo()) ."'>"; // envia o titulo da lista
                echo "<button type='submit' style='background: none; border: none; padding: 0; margin: 0; cursor: pointer;'>";
                echo "<img src='imagens/excluir.png' class='excluir-icon' alt='Excluir' title='Excluir'>";
                echo "</button>";
                echo "</form>";
                echo "</li>";
            } ?>
        </ul>

        <!-- formulario de novo item -->
        <form method="post">
            <input type="hidden" name="titulo" value="<?php echo $listaExibir->getTitulo(); ?>">
            <label for="novo_item">Novo Item:</label>
            <input type="text" id="novo_item" name="novo_item" required>
            <input type="number" id="prioridade" name="prioridade" min="1" max="5" value="1">
            <input type="submit" value="Adicionar">
        </form>
    <?php } 
    // se não identificar instância de Lista
    else { ?>
        <p>Lista não encontrada.</p>
    <?php } ?>
    <a href="pagina_inicial.php" class="back-link">Voltar</a>
</body>
</html>
