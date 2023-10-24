<!DOCTYPE html>
<html>
<head>
    <title>Visualizar Produtos</title>
</head>
<body>
    <h2>Produtos</h2>

    <?php
    // Conectar ao banco de dados
    $conexao = mysqli_connect("localhost", "root", "", "linoca");

    // Verificar se a conexão foi estabelecida corretamente
    if (mysqli_connect_errno()) {
        echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
        exit;
    }session_start(); // Certifique-se de iniciar a sessão no topo da página.

   

    if (isset($_SESSION['carrinho'])) {
       echo $qtdpro;
    }

    // Consulta para obter todos os produtos
    $query = "SELECT p.*, c.nome AS categoria FROM produtos p
              INNER JOIN categorias c ON p.categoria_id = c.id";
    $result = mysqli_query($conexao, $query);

    // Loop para exibir os produtos e suas imagens
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<h3>" . $row['nome'] . "</h3>";
        echo "Descrição: " . $row['descricao'] . "<br>";
        echo "Preço: " . $row['preco'] . "<br>";
        echo "Categoria: " . $row['categoria'] . "<br>";

        // Consulta para obter as imagens do produto
        $produto_id = $row['id'];
        $imagens_query = "SELECT caminho FROM imagens WHERE produto_id = $produto_id";
        $imagens_result = mysqli_query($conexao, $imagens_query);

        // Exibir as imagens
        while ($imagem_row = mysqli_fetch_assoc($imagens_result)) {
            echo "<img src='" . $imagem_row['caminho'] . "' alt='Imagem do Produto'><br>";
        }

        // Links para Editar e Excluir
        echo "<a href='editar_produto.php?id=" . $row['id'] . "'>Editar</a> | ";
        echo "<a href='excluir_produto.php?id=" . $row['id'] . "'>Excluir</a><br>";
    }

    // Fechar a conexão
 echo"   <div class='cart-icon'>
 <i class='bx bx-cart'></i>
 <span ><?php echo 'a$qtdpro'?></span>
</div>";
    mysqli_close($conexao);
    ?>

</body>
</html>
