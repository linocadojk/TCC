<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rua = $_POST["rua"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["estado"];
    $cep = $_POST["cep"];

    $conexao = mysqli_connect("localhost", "root", "", "linoca");

    if (mysqli_connect_errno()) {
        echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
        exit;
    }

    session_start();
    $user_id = $_SESSION['id']; // Certifique-se de que 'id' seja a chave correta para armazenar o user_id na sessão.

    $inserirEndereco = "INSERT INTO enderecos (user_id, rua, cidade, estado, cep) VALUES ($user_id, '$rua', '$cidade', '$estado', '$cep')";

    if (mysqli_query($conexao, $inserirEndereco)) {
        echo "success";
    } else {
        echo "Erro na inserção: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
}
?>
