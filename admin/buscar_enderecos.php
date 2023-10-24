<?php
// Conecte-se ao banco de dados
$conexao = mysqli_connect("localhost", "root", "", "linoca");

if (mysqli_connect_errno()) {
    echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
    exit;
}

session_start();
$user_id = $_SESSION['id'];

// Consulta SQL para buscar os endereços do usuário
$query = "SELECT * FROM enderecos WHERE user_id = $user_id";
$result = mysqli_query($conexao, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li><input type='radio' name='endereco' value='{$row['rua']}, {$row['cidade']}, {$row['estado']}, {$row['cep']}'><label>{$row['rua']}, {$row['cidade']}, {$row['estado']}, {$row['cep']}</label></li>";
        }
        echo "</ul>";
    } else {
        echo "Nenhum endereço cadastrado.";
    }
} else {
    echo "Erro ao buscar endereços: " . mysqli_error($conexao);
}

mysqli_close($conexao);
?>
