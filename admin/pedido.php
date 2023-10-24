<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finalizar_compra'])) {
  // Conectar ao banco de dados
  $conexao = mysqli_connect("localhost", "root", "", "linoca");

  // Verificar se a conexão foi estabelecida corretamente
  if (mysqli_connect_errno()) {
    echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
    exit;
  }

  // Recuperar informações do cliente (você pode precisar adicionar um formulário para isso)
  $cliente_id = 1; // Substitua pelo ID do cliente apropriado
  $endereco_entrega = "Endereço de entrega aqui"; // Substitua pelo endereço real do cliente

  // Calcular o valor total novamente (pode ser uma boa prática para evitar manipulação no cliente)
  $valor_total = 0;

  // Criar um registro de pedido na tabela de pedidos
  $query_pedido = "INSERT INTO orders (customer_id, order_date, delivery_address, total_amount, order_status) VALUES ($cliente_id, NOW(), '$endereco_entrega', $valor_total, 'Em processamento')";
  $resultado_pedido = mysqli_query($conexao, $query_pedido);

  if ($resultado_pedido) {
    $pedido_id = mysqli_insert_id($conexao); // Recupera o ID do pedido recém-inserido

    // Percorrer os itens do carrinho e criar registros na tabela de itens do pedido
    foreach ($_SESSION['carrinho'] as $produto_id => $quantidade) {
      // Consulta para obter informações do produto
      $query_produto = "SELECT nome, preco FROM produtos WHERE id = $produto_id";
      $resultado_produto = mysqli_query($conexao, $query_produto);
      $produto = mysqli_fetch_assoc($resultado_produto);

      $nome_produto = $produto['nome'];
      $preco_unitario = $produto['preco'];
      $subtotal = $preco_unitario * $quantidade;

      $valor_total += $subtotal;

      // Criar um registro na tabela de itens do pedido
      $query_item = "INSERT INTO order_items (order_id, product_id, seller_id, quantity, item_price) VALUES ($pedido_id, $produto_id, $vendedor_id, $quantidade, $preco_unitario)";
      $resultado_item = mysqli_query($conexao, $query_item);

      if (!$resultado_item) {
        echo "Falha ao adicionar item ao pedido.";
        // Você pode adicionar tratamento de erro aqui, como desfazer a transação.
      }
    }

    // Atualizar o valor total do pedido na tabela de pedidos
    $query_atualizar_total = "UPDATE orders SET total_amount = $valor_total WHERE order_id = $pedido_id";
    $resultado_atualizar_total = mysqli_query($conexao, $query_atualizar_total);

    if ($resultado_atualizar_total) {
      // Limpar o carrinho após a conclusão do pedido
      $_SESSION['carrinho'] = array();

      // Redirecionar ou exibir uma mensagem de sucesso
      echo "Pedido concluído com sucesso!";
    } else {
      echo "Falha ao atualizar o valor total do pedido.";
      // Você pode adicionar tratamento de erro aqui.
    }
  } else {
    echo "Falha ao criar o pedido.";
    // Você pode adicionar tratamento de erro aqui, como desfazer a transação.
  }

  // Fechar a conexão
  mysqli_close($conexao);
}
?>
