<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

// Exibir nome de usuário
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo $username; ?>!</h2>
    <p>Esta é a página de dashboard.</p>
    <a href="logout.php">Sair</a>
</body>
</html>
