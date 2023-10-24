<?php
session_start();

// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "linoca");

// Verifica se a conexão foi bem sucedida
if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe dados do formulário
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consulta o banco de dados para encontrar o usuário
    $sql = "SELECT user_id, nome, senha FROM users WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $nome, $hashed_password);
        if ($stmt->fetch() && password_verify($password, $hashed_password)) {
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $nome;
            header("Location: index.php"); // Redirecionar para a página de dashboard
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
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="css/estilo.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
</head>
<body>
    
    <!--Container da tela de login-->
    <div class="container">
        <h2>Login</h2>
        
        <!--Inicio do formulario-->
        <form method="post" action="login.php">
            <div class="input-field">
                <input type="text" name="username" required id="nome" placeholder="alguma coisa">
                <label for="nome" >Email:</label>
            </div>

            <div class="input-field">
                <input type="password" id="senha" name="password" placeholder="alguma coisa">
                <label for="password">Senha:</label>
            </div>

            <div class="center">
                <button  type="submit" value="Entrar">Entrar</button>
            </div>
        </form><!--Fim do Formulario-->
        <div class="links-uteis">
            <a href=""><p>Esqueceu a sua senha ?</p></a>
            <a href=""><p>Ainda não sou cadastrado</p></a>
        </div>
    </div>
</body>
</html>