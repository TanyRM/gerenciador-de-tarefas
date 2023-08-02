<?php 
require_once '../models/Lista.php';
require_once '../models/Usuario.php';
require_once '../controllers/Gerenciador.php';
session_start();
$gerenciador = $_SESSION['gerenciador'];

if (isset($_SESSION['mensagem'])) {
    echo $_SESSION['mensagem']; // exibe a mensagem
    unset($_SESSION['mensagem']); // limpa a mensagem da sessão 
}

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $nomeUsuario = $usuario->getNome();
    $listasUsuario = $usuario->getListas();
} 
else {
    $_SESSION['mensagem'] = "Você precisa realizar login!";
    header('Location: login.php'); // envia um endereço http 
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerenciador de tarefas</title>
</head>
<body>
    <h1><?php echo "Bem-vindo(a) $nomeUsuario!"; ?></h1>
    
    <h2>Suas listas:</h2>
    <ul>
        <?php
        if (empty($listasUsuario)) {
            echo "Você ainda não possui listas";
        } 
        else {
            foreach ($listasUsuario as $lista) { // cada elemento de $listasUsuario é armazenado na variavel $lista ?> 
                <li> <!-- exibe os elementos em lista -->
                    <!-- define a URL para onde será redirecionado como a pagina de exibição + o titulo da lista codificado-->
                    <a href="exibir_lista.php?titulo=<?php echo urlencode($lista->getTitulo()); ?>"><?php echo $lista->getTitulo(); ?></a>
                </li> <!-- finaliza a exibição de lista -->
            <?php }
        }
        ?>
    </ul>
    <a href="criar_lista.php"> + </a>
</body>
</html>
