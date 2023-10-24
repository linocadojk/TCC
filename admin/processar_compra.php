<?php
session_start();

if (!isset($_SESSION['id'])) {
    // Verifique se o usuário está autenticado
    header('Location: ../login.php');
    exit();
}

if (!empty($_SESSION['carrinho'])) {
    // Conecte-se ao banco de dados
    $conexao = mysqli_connect("localhost", "root", "", "linoca");

    if (mysqli_connect_errno()) {
        echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
        exit;
    }

    // Crie um novo pedido na tabela "pedidos"
    $id_cliente = $_SESSION['id'];
    $data_pedido = date('Y-m-d'); // Data atual
    $status_pedido = "Em Processamento"; // Pode ser ajustado conforme necessário
    $total_pedido = 0; // Será calculado abaixo
    $endereco_entrega = "Endereço de entrega do cliente"; // Substitua com o endereço real
    $metodo_pagamento = "Método de pagamento do cliente"; // Substitua com o método real

    $inserir_pedido_query = "INSERT INTO pedidos (id_cliente, data_pedido, status_pedido, total_pedido, endereco_entrega, metodo_pagamento) VALUES ('$id_cliente', '$data_pedido', '$status_pedido', '$total_pedido', '$endereco_entrega', '$metodo_pagamento')";
    mysqli_query($conexao, $inserir_pedido_query);

    $id_pedido = mysqli_insert_id($conexao); // Obtém o ID do pedido recém-criado

    $valor_total = 0;

    // Percorre os produtos no carrinho e insere-os na tabela "itens_pedido"
    foreach ($_SESSION['carrinho'] as $produto_id => $quantidade) {
        $query = "SELECT preco FROM produtos WHERE id = $produto_id";
        $result = mysqli_query($conexao, $query);
        $produto = mysqli_fetch_assoc($result);
        $preco_unitario = $produto['preco'];
        $subtotal = $preco_unitario * $quantidade;
        $valor_total += $subtotal;

        // Insere o item do pedido na tabela "itens_pedido"
        $inserir_item_query = "INSERT INTO itens_pedido (id_pedido, id_produto, quantidade, preco_unitario, total_item) VALUES ('$id_pedido', '$produto_id', '$quantidade', '$preco_unitario', '$subtotal')";
        mysqli_query($conexao, $inserir_item_query);
    }

    // Atualiza o valor total do pedido na tabela "pedidos"
    $atualizar_total_query = "UPDATE pedidos SET total_pedido = '$valor_total' WHERE id_pedido = '$id_pedido'";
    mysqli_query($conexao, $atualizar_total_query);

    // Limpa o carrinho após a compra
    unset($_SESSION['carrinho']);

    // Redireciona o usuário para uma página de confirmação
    header('Location: confirmacao_compra.php');
} else {
    // Carrinho vazio, redirecionar para a página do carrinho
    header('Location: carrinho.php');
}

// Feche a conexão com o banco de dados
mysqli_close($conexao);
?>
