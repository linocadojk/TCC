<?php
// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "linoca");

// Verifica se a conexão foi bem sucedida
if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe dados do formulário
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Insere os dados na tabela 'users'
    $sql = "INSERT INTO users (nome, senha, email) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $username);

    if ($stmt->execute()) {
        echo "
        <div class='center'>
            Cadastro realizado com sucesso!
        </div>
        ";
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
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
    <title>Tela de Cadastro</title>
</head>
<body>
    <!-- Container da tela de cadastro -->
    <div class="container">
        <h2>Cadastro</h2>
        
        <!-- Início do formulário -->
        <form method="post" action="cadastro.php">
            <div class="input-field">
                <input type="text" id="nome" name="username" placeholder="alguma coisa">
                <label for="nome">Email:</label>
            </div>

            <div class="input-field">
                <input type="password" name="password" required id="senha" placeholder="alguma coisa">
                <label for="password">Senha:</label>
            </div>

            <div class="center">
                <button type="submit" value="Cadastrar">Cadastrar</button>
            </div>
        </form><!-- Fim do Formulário -->

        <div class="links-uteis">
            <a href=""><p>Já possui uma conta? Faça o login.</p></a>
        </div>
    </div>
</body>
</html>
