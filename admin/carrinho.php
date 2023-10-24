<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="../css/carrinho.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script defer src="js/index.js"></script>
</head>

<body>
    <main>
        <div class="page-title">CARRINHO DE COMPRA</div>
        <div class="content">
            <section>
            <input type="text" id="cep" placeholder="Digite o CEP" required>
<button onclick="calcularFrete()">Calcular Frete</button>
<div class="frete">R$ <span id="valor-frete">0.00</span></div>
           


                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        session_start();
                        if (!isset($_SESSION['id'])) {
                            // Se não estiver autenticado, redirecionar para a página de login
                            header('Location: ../login.php');
                            exit();
                        }
                        

                        if (empty($_SESSION['carrinho'])) {
                            echo "Seu carrinho de compras está vazio.";
                        } else {
                            $conexao = mysqli_connect("localhost", "root", "", "linoca");

                            if (mysqli_connect_errno()) {
                                echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
                                exit;
                            }

                            $valor_total = 0;
                            $qtdpro = 0;

                            foreach ($_SESSION['carrinho'] as $produto_id => $quantidade) {
                                $query = "SELECT nome, preco FROM produtos WHERE id = $produto_id";
                                $result = mysqli_query($conexao, $query);
                                $produto = mysqli_fetch_assoc($result);

                                $nome_produto = $produto['nome'];
                                $preco_unitario = $produto['preco'];
                                $subtotal = $preco_unitario * $quantidade;

                                $qtdpro += 1;

                                $valor_total += $subtotal;

                                $imagens_query = "SELECT caminho FROM imagens WHERE produto_id = $produto_id";
                                $imagens_result = mysqli_query($conexao, $imagens_query);

                                echo "<tr data-product-id='1'>
                                    <td>
                                        <div class='product'>";
                                if (mysqli_num_rows($imagens_result) > 0) {
                                    $primeira_imagem = mysqli_fetch_assoc($imagens_result);
                                    echo "<img id=\"featured-image\" src=\"" . $primeira_imagem['caminho'] . "\" alt=\"Imagem do Produto\">";
                                } else {
                                    echo "Nenhuma imagem encontrada para este produto.";
                                }

                                echo "<div class='info'>
                                        <div class='name'>$nome_produto</div>
                                        <div class='category'>Material Escolar</div>
                                    </div>
                                </div>
                            </td>
                            <td>R$ $preco_unitario </td>
                            <td>
                                <div class='qty'>
                                    <button class='increment'><i class='bx bx-plus'></i></button>
                                    <input type='number' value='$quantidade' data-product-id='$produto_id' class='quantity-input' onchange='updateQuantity(this)'>
                                    <button class='decrement'><i class='bx bx-minus'></i></button>
                                </div>
                            </td>
                            <td><span class='subtotal'>R$ $subtotal</span></td>
                            <td>
                                <button class='remove' onclick='removeProduto($produto_id)'><i class='bx bx-x'></i></button>
                            </td>
                        </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </section>
            <aside>
                <div class="box">
                    <header>Resumo da compra</header>
                    <div class="info">
                        <div><span>Sub-total</span><span>R$ 285,60</span></div>
                        <div><span>Frete</span><span>Gratuito</span></div>
                        <div>
                            <button>
                                Adicionar cupom de desconto
                                <i class="bx bx-right-arrow-alt"></i>
                            </button>
                        </div>
                    </div>
                    <footer>
                        <span>Total</span>
                        <span id="valor-total">
                            <?php echo $valor_total ?> </span>
                    </footer>
                </div>
                <form action="processar_compra.php" method="post">
    <button type="submit" name="finalizar_compra">Finalizar Compra</button>
</form>
                <button type="submit" name="finalizar_compra">Finalizar Compra</button>
                <div class="cart-icon">
                    <i class="bx bx-cart"></i>
                    <span><?php echo $qtdpro ?></span>
                </div>
            </aside>
        </div>
    </main>

    <script>
        function calcularFrete() {
    var produtos = <?php echo json_encode($_SESSION['carrinho']); ?>;
    var cepDestino = document.getElementById("cep").value;
    var menorFrete = null;

    for (var produtoId in produtos) {
        // Fazer uma solicitação AJAX para a API de cálculo de frete para cada produto
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "teste.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var freteData = JSON.parse(xhr.responseText);
                var vlrFrete = freteData[0].vlrFrete; // Assumindo que a resposta é um array com um único resultado

                if (menorFrete === null || vlrFrete < menorFrete) {
                    menorFrete = vlrFrete;
                    document.getElementById("valor-frete").innerText = vlrFrete.toFixed(2);
                }
            }
        };

        // Construir os dados do produto e do CEP para a solicitação
        var data = "produto_id=" + produtoId + "&quantidade=" + produtos[produtoId] + "&cep_destino=" + cepDestino;
        xhr.send(data);
    }
}
        function updateQuantity(inputField) {
    var newQuantity = parseInt(inputField.value, 10);
    var productId = inputField.getAttribute('data-product-id');

    if (!isNaN(newQuantity) && newQuantity > 0) {
        // Enviar uma solicitação AJAX para atualizar a sessão
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "atualizar_sessao.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Atualização da sessão concluída com sucesso
                // Você pode adicionar qualquer manipulação adicional aqui, se necessário
            }
        };
        xhr.send("quantity=" + newQuantity + "&product_id=" + productId);

        // Atualizar o subtotal do produto
        var productRow = inputField.closest('tr');
        var priceCell = productRow.querySelector('td:nth-child(2)');
        var subtotalCell = productRow.querySelector('td:nth-child(4)');
        var price = parseFloat(priceCell.innerText.replace("R$ ", ""));
        var newSubtotal = price * newQuantity;
        subtotalCell.innerText = "R$ " + newSubtotal.toFixed(2);

        // Atualizar o valor total do carrinho
        var totalCell = document.querySelector("#valor-total");
        var currentTotal = parseFloat(totalCell.innerText.replace("R$ ", ""));
        var oldQuantity = parseInt(inputField.defaultValue, 10); // Obter a quantidade anterior
        var difference = (newSubtotal - (price * oldQuantity)) || 0; // Garantir que a diferença seja numérica
        var newTotal = currentTotal + difference;
        totalCell.innerText = "R$ " + newTotal.toFixed(2);

        // Atualizar a quantidade padrão do input para a nova quantidade
        inputField.defaultValue = newQuantity;
    } else {
        // Caso a nova quantidade seja inválida, você pode lidar com isso da maneira adequada, por exemplo, definindo a quantidade padrão de volta para o valor anterior ou mostrando uma mensagem de erro.
        inputField.value = inputField.defaultValue;
        alert("Quantidade inválida.");
    }
}
function removeProduto(productId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "remover_produto.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Atualizar a página após a remoção do produto
            window.location.reload();
        }
    };
    xhr.send("product_id=" + productId);
}

    </script>
  
    
</body>

</html>