<?php
session_start();

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    if (isset($_SESSION['carrinho'][$product_id])) {
        unset($_SESSION['carrinho'][$product_id]);
    }
}

// Você pode redirecionar de volta para a página do carrinho ou enviar uma resposta de sucesso (por exemplo, JSON) para o JavaScript.
?>
