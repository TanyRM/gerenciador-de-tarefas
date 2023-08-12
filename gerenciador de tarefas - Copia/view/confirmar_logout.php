<?php
require_once '../models/Usuario.php';
require_once '../controllers/Gerenciador.php';
session_start();
$gerenciador = $_SESSION['gerenciador'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirmar'])) {
        header('Location: logout.php');
        exit;
    } 
    elseif (isset($_POST['cancelar'])) {
        header('Location: pagina_inicial.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirmar logout</title>
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
    <h2>Deseja realmente sair?</h2>
    <form method="post">
        <input type="submit" name="confirmar" value="Confirmar">
        <input type="submit" name="cancelar" value="Cancelar">
    </form>
</body>
</html>
