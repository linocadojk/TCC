<?php
// Conectar ao banco de dados
$conexao = mysqli_connect("localhost", "root", "", "linoca");

// Verificar se a conexão foi estabelecida corretamente
if (mysqli_connect_errno()) {
    echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
    exit;
}

// Verificar se o formulário foi enviado corretamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $estoque =$_POST['estoque'];
    $categoria_id = $_POST['categoria_id'];
    $peso = $_POST['peso'];
$altura = $_POST['altura'];
$largura = $_POST['largura'];
$comprimento = $_POST['comprimento'];
 // Certifique-se de usar "categoria_id"

    // Inserir os dados do produto na tabela "produtos"
    $query = "INSERT INTO produtos (nome, descricao, preco, categoria_id, estoque, peso, altura, largura, comprimento) 
    VALUES ('$nome', '$descricao', '$preco', '$categoria_id', '$estoque', '$peso', '$altura', '$largura', '$comprimento')";
    

    if (mysqli_query($conexao, $query)) {
        $produto_id = mysqli_insert_id($conexao); // Obtém o ID do produto inserido
    } else {
        echo "Erro ao cadastrar o produto: " . mysqli_error($conexao);
        exit;
    }

    // Tratar o upload das imagens
    if (!empty($_FILES['imagens']['name'][0])) {
        for ($i = 0; $i < count($_FILES['imagens']['name']); $i++) {
            $nome_imagem = $_FILES['imagens']['name'][$i];
            $caminho_imagem = "uploads/" . basename($nome_imagem);
            
            if (move_uploaded_file($_FILES['imagens']['tmp_name'][$i], $caminho_imagem)) {
                // Inserir os dados da imagem na tabela "imagens"
                $query = "INSERT INTO imagens (produto_id, caminho) VALUES ('$produto_id', '$caminho_imagem')";
                if (!mysqli_query($conexao, $query)) {
                    echo "Erro ao cadastrar imagem: " . mysqli_error($conexao);
                }
            } else {
                echo "Erro no upload da imagem.";
            }
        }
    }

    echo "Produto cadastrado com sucesso!";
} else {
    echo "Requisição inválida.";
}

// Fechar a conexão
mysqli_close($conexao);
?>
