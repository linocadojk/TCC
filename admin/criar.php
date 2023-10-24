<html>
<body>

<h2>Cadastrar Produto</h2>

<form action="processar_cadastro.php" method="post" enctype="multipart/form-data">
    Nome: <input type="text" name="nome"><br>
    Descrição: <textarea name="descricao"></textarea><br>
    Preço: <input type="text" name="preco"><br>
    Estoque: <input type="text" name="estoque"><br>
    Peso (Kg): <input type="text" name="peso"><br>
Altura (cm): <input type="text" name="altura"><br>
Largura (cm): <input type="text" name="largura"><br>
Comprimento (cm): <input type="text" name="comprimento"><br>

   
    Categoria:
    <select name="categoria_id">
        <option value="">Selecione uma categoria</option>
        <?php  $conexao = mysqli_connect("localhost", "root", "", "linoca");?>
        <?php
       

        // Consulta ao banco de dados para obter as categorias
        $query = "SELECT id, nome FROM categorias";
        $result = mysqli_query($conexao, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
        }
        ?>
    </select>
    <div id="imagens_container">
       
    </div>
    <button type="button" onclick="adicionarInputImagem()">Adicionar Imagem</button>
    <input type="submit" value="Cadastrar">
</form>
<div id="previews"></div>

<script>
function adicionarInputImagem() {
    var container = document.getElementById('imagens_container');
    var novoInput = document.createElement('input');
    novoInput.type = 'file';
    novoInput.name = 'imagens[]';
    novoInput.accept = 'image/*';
    container.appendChild(novoInput);

    // Adiciona um evento para exibir a pré-visualização quando uma imagem for selecionada
    novoInput.addEventListener('change', function() {
        exibirPreview(this);
    });
}

function exibirPreview(input) {
    var previewsContainer = document.getElementById('previews');
    var imagens = input.files;

    for (var i = 0; i < imagens.length; i++) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var preview = document.createElement('div');
            preview.innerHTML = '<img src="' + e.target.result + '" alt="Imagem" class="preview-image">';
            
            var botaoExcluir = document.createElement('button');
            botaoExcluir.innerHTML = 'Excluir';
            botaoExcluir.addEventListener('click', function() {
                previewsContainer.removeChild(preview);
                input.value = ''; // Limpa o campo de entrada de arquivo
            });

            preview.appendChild(botaoExcluir);
            previewsContainer.appendChild(preview);
        }

        reader.readAsDataURL(imagens[i]);
    }
}
</script>

</body>
</html>
