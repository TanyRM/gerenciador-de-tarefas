<?php 

require_once '../models/Lista.php';
require_once '../models/Usuario.php';
require_once '../controllers/Gerenciador.php';
session_start();
$gerenciador = $_SESSION['gerenciador'];

if (isset($_SESSION['mensagem'])) {
    echo $_SESSION['mensagem']; // Exibe a mensagem
    unset($_SESSION['mensagem']); // Limpa a mensagem da sessão 
}

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $nomeUsuario = $usuario->getNome();
    $listasUsuario = $usuario->getListas();
} else {
    $_SESSION['mensagem'] = "Você precisa realizar login!";
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerenciador de tarefas</title>
</head>
<body>
<h1><?php echo "Bem-vindo $nomeUsuario!"; ?></h1>
    
    <h2>Suas listas:</h2>
    <ul>
        <?php
        if (empty($listasUsuario)) {
            echo "Você ainda não possui listas";
        }
        else {
        foreach ($listasUsuario as $lista) { ?>
            <a href="exibir_lista.php?id=<?php echo $lista->getId(); ?>">
            <?php echo "<li>" . $lista->getTitulo() . "</li>";
            }
        }
        ?>
    </ul>
    <a href="criar_lista.php"> + </a>
</body>
</html>
