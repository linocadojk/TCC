<!DOCTYPE html>
<html>

<head>
    <title>Editar Produto</title>
</head>

<body>
    <h2>Editar Produto</h2>

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

        // Consulta para obter informações do produto a ser editado
        $query = "SELECT * FROM produtos WHERE id = $produto_id";
        $result = mysqli_query($conexao, $query);
        $produto = mysqli_fetch_assoc($result);

        if ($produto) {
            // Formulário para editar o produto
            echo "<form method='post' enctype='multipart/form-data'>";
            echo "<input type='hidden' name='produto_id' value='$produto_id'>";
            echo "Nome: <input type='text' name='nome' value='" . $produto['nome'] . "'><br>";
            echo "Descrição: <textarea name='descricao'>" . $produto['descricao'] . "</textarea><br>";
            echo "Preço: <input type='text' name='preco' value='" . $produto['preco'] . "'><br>";

            // Lista suspensa para selecionar a categoria
            echo "Categoria: ";
            echo "<select name='categoria_id'>";
            // Consulta para obter todas as categorias
            $categorias_query = "SELECT id, nome FROM categorias";
            $categorias_result = mysqli_query($conexao, $categorias_query);
            while ($categoria = mysqli_fetch_assoc($categorias_result)) {
                $selected = ($categoria['id'] == $produto['categoria_id']) ? 'selected' : '';
                echo "<option value='" . $categoria['id'] . "' $selected>" . $categoria['nome'] . "</option>";
            }
            echo "</select><br>";

            echo "Imagens: ";
            // Consulta para obter todas as imagens associadas ao produto
            $imagens_query = "SELECT id, caminho FROM imagens WHERE produto_id = $produto_id";
            $imagens_result = mysqli_query($conexao, $imagens_query);
            while ($imagem = mysqli_fetch_assoc($imagens_result)) {
                echo "<img src='" . $imagem['caminho'] . "' alt='Imagem do Produto'><br>";
                echo "Substituir imagem: <input type='file' name='nova_imagem[]' accept='image/*'><br>";
                echo "<input type='hidden' name='imagem_id[]' value='" . $imagem['id'] . "'>";
                echo "<input type='checkbox' name='excluir_imagem[]' value='excluir'> Marcar para excluir";
            }
            echo "Adicionar novas imagens: <input type='file' name='novas_imagens[]' accept='image/*' multiple><br>";

            echo "<input type='submit' name='editar' value='Editar'>";
            echo "</form>";

            // Processamento da edição
            if (isset($_POST['editar'])) {
                $nome = $_POST['nome'];
                $descricao = $_POST['descricao'];
                $preco = $_POST['preco'];
                $categoria_id = $_POST['categoria_id'];
                $peso = $produto['peso'];
                $altura = $produto['altura'];
                $largura = $produto['largura'];
                $comprimento = $produto['comprimento'];


                // Consulta para atualizar os dados do produto
                $update_query = "UPDATE produtos SET nome = '$nome', descricao = '$descricao', preco = '$preco', categoria_id = '$categoria_id', peso = '$peso', altura = '$altura', largura = '$largura', comprimento = '$comprimento' WHERE id = $produto_id";

                if (mysqli_query($conexao, $update_query)) {
                    echo "Produto editado com sucesso!";
                } else {
                    echo "Erro ao editar o produto: " . mysqli_error($conexao);
                }


                // Processamento das imagens
                if (!empty($_FILES['novas_imagens']['name'][0])) {
                    // Diretório onde as novas imagens serão armazenadas
                    $diretorio_destino = "uploads/";

                    // Loop através de cada nova imagem
                    foreach ($_FILES['novas_imagens']['tmp_name'] as $key => $tmp_name) {
                        $nome_imagem = $_FILES['novas_imagens']['name'][$key];
                        $caminho_imagem = $diretorio_destino . $nome_imagem;

                        if (move_uploaded_file($_FILES['novas_imagens']['tmp_name'][$key], $caminho_imagem)) {
                            // Inserir o registro da nova imagem na tabela
                            $inserir_imagem_query = "INSERT INTO imagens (produto_id, caminho) VALUES ($produto_id, '$caminho_imagem')";
                            if (mysqli_query($conexao, $inserir_imagem_query)) {
                                echo "Nova imagem adicionada com sucesso: $nome_imagem<br>";
                            } else {
                                echo "Erro ao adicionar nova imagem: " . mysqli_error($conexao);
                            }
                        } else {
                            echo "Erro no upload da imagem: $nome_imagem<br>";
                        }
                    }
                }


                if (!empty($_POST['imagem_id'])) {
                    foreach ($_POST['imagem_id'] as $key => $imagem_id) {
                        $diretorio_destino = "uploads/";
                        $nome_imagem = $_FILES['nova_imagem']['name'][$key];
                        $caminho_imagem =  $diretorio_destino . $nome_imagem;

                        if (!empty($nome_imagem)) {
                            // O usuário escolheu substituir a imagem
                            if (move_uploaded_file($_FILES['nova_imagem']['tmp_name'][$key], $caminho_imagem)) {
                                // Atualizar o caminho da imagem existente no banco de dados
                                $atualizar_imagem_query = "UPDATE imagens SET caminho = '$caminho_imagem' WHERE id = $imagem_id";
                                if (mysqli_query($conexao, $atualizar_imagem_query)) {
                                    echo "Imagem atualizada com sucesso: $nome_imagem<br>";
                                } else {
                                    echo "Erro ao atualizar a imagem: " . mysqli_error($conexao);
                                }
                            } else {
                                echo "Erro no upload da nova imagem: $nome_imagem<br>";
                            }
                        } elseif (isset($_POST['excluir_imagem'][$key]) && $_POST['excluir_imagem'][$key] == "excluir") {
                            // O usuário escolheu excluir a imagem
                            $excluir_imagem_query = "DELETE FROM imagens WHERE id = $imagem_id";
                            if (mysqli_query($conexao, $excluir_imagem_query)) {
                                echo "Imagem excluída com sucesso<br>";
                            } else {
                                echo "Erro ao excluir a imagem: " . mysqli_error($conexao);
                            }
                        }
                    }
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