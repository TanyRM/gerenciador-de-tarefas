<?php
require_once '../controllers/Gerenciador.php';
session_start();
$gerenciador = $_SESSION['gerenciador'];

// redirecionar para a página index
header('Location: index.php');
exit;
?>
