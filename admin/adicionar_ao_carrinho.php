<?php
// Verifique se um produto_id e quantidade válidos foram fornecidos
if (isset($_POST['produto_id']) && isset($_POST['quantidade'])) {
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    // Adicione a lógica para adicionar o produto ao carrinho aqui
    // Por exemplo, você pode usar sessões para gerenciar o carrinho
    // e armazenar os itens do carrinho em um array associativo.
    // Lembre-se de verificar se o produto já está no carrinho e, nesse caso, atualizar a quantidade.

    // Exemplo de código para adicionar um produto ao carrinho (usando sessões)
    session_start();

    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }

    if (isset($_SESSION['carrinho'][$produto_id])) {
        $_SESSION['carrinho'][$produto_id] += $quantidade;
        
    } else {
        $_SESSION['carrinho'][$produto_id] = $quantidade;
    }

    echo "Produto adicionado ao carrinho com sucesso!";
} else {
    echo "Parâmetros inválidos.";
}

?>
