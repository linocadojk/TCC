<!DOCTYPE html>
<html>
<head>
    <title>Excluir Produto</title>
</head>
<body>
    <h2>Excluir Produto</h2>

    <?php
    // Verifique se um ID de produto válido foi fornecido via parâmetro
    if (isset($_GET['id'])) {
        $produto_id = $_GET['id'];

        // Conectar ao banco de dados
        $conexao = mysqli_connect("localhost", "root", "", "linoca");

        // Verificar se a conexão foi estabelecida corretamente
        if (mysqli_connect_errno()) {
            echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
            exit;
        }

        // Consulta para obter informações do produto a ser excluído
        $query = "SELECT * FROM produtos WHERE id = $produto_id";
        $result = mysqli_query($conexao, $query);
        $produto = mysqli_fetch_assoc($result);

        if ($produto) {
            // Exibir informações do produto a ser excluído
            echo "<p>Tem certeza de que deseja excluir o seguinte produto?</p>";
            echo "<h3>" . $produto['nome'] . "</h3>";
            echo "Descrição: " . $produto['descricao'] . "<br>";
            echo "Preço: " . $produto['preco'] . "<br>";

            // Formulário para confirmar a exclusão
            echo "<form method='post'>";
            echo "<input type='hidden' name='produto_id' value='$produto_id'>";
            echo "<input type='submit' name='confirmar' value='Confirmar Exclusão'>";
            echo "</form>";

            // Processamento da exclusão
            if (isset($_POST['confirmar'])) {
                // Executar a exclusão do produto
                $delete_query = "DELETE FROM produtos WHERE id = $produto_id";
                if (mysqli_query($conexao, $delete_query)) {
                    echo "Produto excluído com sucesso!";
                } else {
                    echo "Erro ao excluir o produto: " . mysqli_error($conexao);
                }
            }
        } else {
            echo "Produto não encontrado.";
        }

        // Fechar a conexão
        mysqli_close($conexao);
    } else {
        echo "ID de produto inválido.";
    }
    ?>
</body>
</html>
