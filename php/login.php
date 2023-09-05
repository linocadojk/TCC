<?php
session_start();

// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "sistema_login");

// Verifica se a conexão foi bem sucedida
if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe dados do formulário
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consulta o banco de dados para encontrar o usuário
    $sql = "SELECT id, username, password FROM usuarios WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $username, $hashed_password);
        if ($stmt->fetch() && password_verify($password, $hashed_password)) {
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;
            header("Location: dashboard.php"); // Redirecionar para a página de dashboard
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }

    $stmt->close();
}

$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="login.php">
        <label for="username">Nome de Usuário:</label>
        <input type="text" name="username" required><br>

        <label for="password">Senha:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>
