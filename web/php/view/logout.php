<?php
require_once '../controllers/Gerenciador.php';
session_start();
$gerenciador = $_SESSION['gerenciador'];

unset($_SESSION['nomeUsuario']); // remove o usuario da sessão

// redirecionar para a página index
header('Location: index.php');
exit;
?>
