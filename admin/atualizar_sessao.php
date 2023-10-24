<?php
session_start();

if (isset($_POST['quantity']) && isset($_POST['product_id'])) {
    $newQuantity = intval($_POST['quantity']); // Garantir que a nova quantidade seja um número inteiro
    $product_id = intval($_POST['product_id']); // Garantir que o ID do produto seja um número inteiro

    if (!empty($_SESSION['carrinho'])) {
        // Atualize a quantidade do produto na sessão
        $_SESSION['carrinho'][$product_id] = $newQuantity;
    }
}
?>