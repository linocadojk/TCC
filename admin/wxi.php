<!DOCTYPE html>
<html>
<head>
    <title>Lista de Produtos</title>
</head>
<body>
    <h2>Lista de Produtos</h2>

    <?php
    // Conectar ao banco de dados
    $conexao = mysqli_connect("localhost", "root", "", "linoca");

    // Verificar se a conexão foi estabelecida corretamente
    if (mysqli_connect_errno()) {
        echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
        exit;
    }

    // Consulta para obter todos os produtos
    $query = "SELECT p.id, p.nome, p.descricao, p.preco, c.nome AS categoria
              FROM produtos p
              INNER JOIN categorias c ON p.categoria_id = c.id";

    $result = mysqli_query($conexao, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nome</th><th>Descrição</th><th>Preço</th><th>Categoria</th><th>Imagem</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['descricao'] . "</td>";
            echo "<td>" . $row['preco'] . "</td>";
            echo "<td>" . $row['categoria'] . "</td>";
            echo "<td><a href='produto.php?id=" . $row['id'] . "'>" . $row['nome'] . "</a></td>";


            // Consulta para obter todas as imagens associadas ao produto
            $produto_id = $row['id'];
         
            $imagens_query = "SELECT caminho FROM imagens WHERE produto_id = $produto_id";
            $imagens_result = mysqli_query($conexao, $imagens_query);
        
            if (mysqli_num_rows($imagens_result) > 0) {
                $primeira_imagem = mysqli_fetch_assoc($imagens_result);
                echo "<img id=\"featured-image\" src=\"" . $primeira_imagem['caminho'] . "\" alt=\"Imagem do Produto\">";
            } else {
                echo "Nenhuma imagem encontrada para este produto.";
            }
            echo "</td>";

            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "Nenhum produto encontrado.";
    }

    // Fechar a conexão
    mysqli_close($conexao);
    ?>
</body>
</html>
