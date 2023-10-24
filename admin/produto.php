<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

    <header><?php include('../php/header.html'); ?>

    </header>
    <main>
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

     
        $query = "SELECT *
          FROM produtos 
          WHERE id = $produto_id";

        $result = mysqli_query($conexao, $query);
        $produto = mysqli_fetch_assoc($result);
?>
        <section>
            <div class="imgsecundarias">
            <?php    
           $imagens_query = "SELECT caminho FROM imagens WHERE produto_id = $produto_id";
           $imagens_result = mysqli_query($conexao, $imagens_query);

           while ($imagem = mysqli_fetch_assoc($imagens_result)) {
            echo "<img onclick=\"changeImage('" . $imagem['caminho'] . "')\" src='" . $imagem['caminho'] . "' alt='Imagem do Produto'><br>";
           }
     
        
            ?>
        <img onclick="changeImage('https://i.pinimg.com/564x/8d/b9/9e/8db99e78fd7543425aea3755d5ef658c.jpg ') " src="https://i.pinimg.com/564x/8d/b9/9e/8db99e78fd7543425aea3755d5ef658c.jpg" alt="">
        <img onclick="changeImage('https://i.pinimg.com/564x/5d/4c/99/5d4c9953e24a30d991745d1fe58f0e5b.jpg')" src="https://i.pinimg.com/564x/5d/4c/99/5d4c9953e24a30d991745d1fe58f0e5b.jpg" alt="">
        <img onclick="changeImage('https://i.pinimg.com/564x/8d/b9/9e/8db99e78fd7543425aea3755d5ef658c.jpg ') " src="https://i.pinimg.com/564x/8d/b9/9e/8db99e78fd7543425aea3755d5ef658c.jpg" alt="">
        <img onclick="changeImage('https://i.pinimg.com/564x/8d/b9/9e/8db99e78fd7543425aea3755d5ef658c.jpg ') " src="https://i.pinimg.com/564x/8d/b9/9e/8db99e78fd7543425aea3755d5ef658c.jpg" alt="">
        
        
                <img src="https://i.pinimg.com/564x/5d/4c/99/5d4c9953e24a30d991745d1fe58f0e5b.jpg" alt="">
                <img src="https://i.pinimg.com/564x/ec/e9/6f/ece96f230c271931627fa1b7de9e5223.jpg" alt="">
                <img src="https://i.pinimg.com/564x/ce/0c/51/ce0c51137bd6e6575d180c1ee6142ece.jpg" alt="">
            </div>
            <div class="imgprincipal">
            <?php
    $imagens_query = "SELECT caminho FROM imagens WHERE produto_id = $produto_id";
    $imagens_result = mysqli_query($conexao, $imagens_query);

    if (mysqli_num_rows($imagens_result) > 0) {
        $primeira_imagem = mysqli_fetch_assoc($imagens_result);
        echo "<img id=\"featured-image\" src=\"" . $primeira_imagem['caminho'] . "\" alt=\"Imagem do Produto\">";
    } else {
        echo "Nenhuma imagem encontrada para este produto.";
    }
    mysqli_close($conexao);
} else {
    echo "ID de produto inválido.";
}
    ?>
            </div>
            <p class="descricao">




            <?php echo  $produto['descricao'] ?>
            </p>

        </section>


        <section>

            <div class="localizacao-link">

                <a href="">aaaaaaaaaa</a>
                <a href="">bbbbbb</a>
                <a href="">ccccc</a>
            </div>
            <div class="nome-produto"><?php echo  $produto['nome'] ?></div>
            <div class="price" >
                <div class="total">  900 </div>
                <div class="parcelas">10X90</div>
            </div>
            <hr>
            <form action="adicionar_ao_carrinho.php" method='post' >
<?php
            echo "<input type='hidden' name='produto_id' value='$produto_id'>";
            echo "<label for='quantidade'>Quantidade:</label>";
            echo "<input type='number' id='quantidade' name='quantidade' min='1' max='" . $produto['estoque'] . "' value='1'> <br>";
            
?>
               <button class="add-cart">adicionar ao carrinho</button>
                    </form>
            <div class="meios-pagamento">
                <a href=""></a>
                <a href=""></a>
                <a href=""></a>
            </div>
            <div class="frete"> <a href="">meios de pagamento

            </a>
<div class="dropdown">


                <form action="calcula-frete.php" method="post"><input style="width: 90%;" 
                    type="text" name="cep_destino" placeholder="digite seu cep" >
                    <input type="hidden" name="peso" value="<?php echo $produto['peso'];?>" >
                    <input type="hidden" name="cep-origem" value="05999-999" >
                    <input type="hidden" name="vlrmercado" value="<?php echo $produto['preco'];?>" >
                    <input type="hidden" name="altura" value="<?php echo $produto['altura'];?>" >
                    <input type="hidden" name="comprimento" value="<?php echo $produto['comprimento'];?>" >
                    <input type="hidden" name="largura" value="<?php echo $produto['largura'];?>" >
                    <input type="hidden" name="valor" value="<?php echo $produto['preco'];?>" >
                    <input type="hidden" name="quantidade" value="1" >
                    <input type="hidden" name="servico" value="E" >
              

                
                    
                    <input type="submit" style="width: 90%;" value="calcular frete">

                </form>
                <div id="resultado-api"> <!-- Elemento onde o resultado será exibido --> </div>
</div>
            </div>
            </div>
            


        </section>

    </main>



<div class=" produtos-relacionados"></div>

</body>
<script>


function changeImage(imageUrl) {
  const featuredImage = document.getElementById('featured-image');
  featuredImage.src = imageUrl;
}
function exibirResultadoFrete(resultado) {
  const resultadoFrete = document.getElementById('resultado-frete');
  resultadoFrete.innerHTML = "Resultado do Frete:<br>";
  
  for (const frete of resultado) {
    resultadoFrete.innerHTML += `Serviço: ${frete.servico}<br>`;
    resultadoFrete.innerHTML += `Nome do Transportador: ${frete.transp_nome}<br>`;
    resultadoFrete.innerHTML += `Valor do Frete: R$ ${frete.vlrFrete}<br>`;
    resultadoFrete.innerHTML += `Prazo de Entrega: ${frete.prazoEnt} dia(s)<br>`;
    resultadoFrete.innerHTML += `Descrição: ${frete.descricao}<br>`;
    resultadoFrete.innerHTML += "==============================<br>";
  }
}
</script>
</html>