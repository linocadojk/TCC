<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>


    <header>


        <div class="cabeçalho-link">

            <li>
                <a href="index.html">Inicio</a>
            </li>
            <li>
                <a href="#produtos">Produtos</a>
            </li>
            <li>
                <a href="#destaque">Destaques</a>
            </li>
            <li>
                <a href="#Contato">Ajuda</a>
            </li>
            <li>
                <a href="sobrenos.html" onclick="">Sobre nós</a>

            </li>
            <li>


            </li>



        </div>
        <!--cabeçalho-link-->


        <li>
            <form action="pesquisa.php" id="formPesquisa" method="get">

                <label for="" class="pesquisar">
                    <input type="text" name="termo_pesquisa" placeholder="Pesquisar">




                    <a href="# " id="iconePesquisa"> <ion-icon name="search" class="pesquisar2" style="right: 10px; position: absolute; bottom: 0;"></a>
                    </ion-icon>
                </label>
            </form>
        </li>
        <div class="icon">
            <span>
                <ion-icon class="col" name="bag-outline"> <a href="carrinho.html">
                    </a></ion-icon>

            </span>
            <span>

                <a href="login.php">
                    <ion-icon name="person-outline" class="col pessoaicon"></ion-icon>
                </a>
            </span>


        </div>


        <!--icon-->
        <li>






        </li>
    </header>

    </div>
    <div class="carousel-indicators">
        <ul>
            <li class="indicator"></li>
            <li class="indicator"></li>
            <li class="indicator"></li>
        </ul>
    </div>




    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item  active">
                <img src="img/logoo.png" class="d-block w-100" alt="...">
                <div style="position: absolute;
            top: 200px;
            left: 200px;
            z-index: 3;" class="carousel-content">

                    <h1>SE CONECTE COM</h1>
                    <h1>SPOTIFY E CURTA!</h1>
                    <P>A papelaria que você compra se sentindo em casa.</P>
                    <a href="http://localhost:3000/login">
                        <button class="btnspo">

                            <span>SPOTIFY</span>


                        </button>
                    </a>
                    

                </div>

            </div>

            <div class="carousel-item">
                <img src="img/jeon.jpg" class="d-block w-100" alt="...">


            </div>
            <div class="carousel-item">
                <img src="img/logoo.png" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>




    <!--background-->
    <iframe style="height: 600px;" src="http://localhost:3000/player"></iframe>
    <h1 style="text-align: center; padding-top: 100px;" id="destaque">DESTAQUES</h1>

    <section>




        <div id="carouselExampleIndicators2" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
        
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="Container-card-1">

                    
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
          INNER JOIN categorias c ON p.categoria_id = c.id limit 4";


    $result = mysqli_query($conexao, $query);

    

    if (mysqli_num_rows($result) > 0) {
      
        while ($row = mysqli_fetch_assoc($result)) {
            $produto_id = $row['id'];

            $imagens_query = "SELECT caminho FROM imagens WHERE produto_id = $produto_id";
            $imagens_result = mysqli_query($conexao, $imagens_query);
        
            if (mysqli_num_rows($imagens_result) > 0) {
                $primeira_imagem = mysqli_fetch_assoc($imagens_result);
                echo " <div class='cards'>
                <img src=\"admin/" . $primeira_imagem['caminho'] . "\" alt=\"Imagem do Produto\">
                </div>"  ;
            } else {
               // echo "Nenhuma imagem encontrada para este produto.";
            }
          
           

       


            // Consulta para obter todas as imagens associadas ao produto
            $produto_id = $row['id'];
         
           
           

      
        }
        
        echo "</table>";
    } else {
        echo "Nenhum produto encontrado.";
    }

    // Fechar a conexão
    mysqli_close($conexao);
    ?>
   





                        <!--cards-->

                        <!--cards-->

                

                        <!--cards-->

                    </div>


                </div>

                <div class="carousel-item" style="min-width: 100vw;">

                    <div class="Container-card-1">

                        <!--cards-->

                        <div class="cards">
                            <img src="img/jeon2.jpg">
                        </div>
                        <!--cards-->

                        <div class="cards">
                            <img src="img/rosie.jpg">
                        </div>
                        <!--cards-->

                        <div class="cards">
                            <img src="img/jeon2.jpg">
                        </div>
                        <!--cards-->

                        <div class="cards">
                            <img src="img/jeon3.jpg">
                        </div>
                        <!--cards-->


                        <!--cards-->



                    </div>


                </div>
                <div class="carousel-item">

                    <div class="Container-card-1">
                        <div class="cards">
                            <img src="img/rosie.jpg">
                        </div>
                        <!--cards-->

                        <div class="cards">
                            <img src="img/jeon2.jpg">
                        </div>
                        <!--cards-->

                        <div class="cards">
                            <img src="img/rosie.jpg">
                        </div>
                        <!--cards-->

                        <div class="cards">
                            <img src="img/jeon2.jpg">
                        </div>
                        <!--cards-->
                    </div>
                    <!--Container-card-1-->


                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>





        <!--Container-card-1-->
    </section>

    <section class="cta" style="">
        <div class="text-cta">
            <h6></h6>
            <h4>PROMOÇÃO<br> ATÉ 20% OFF</h4>


        </div>
        <!--text-cta-->
    </section>
    <!--cta-->

    <section class="second">
        <h1 id="produtos" class="tituloh1"> EM ESTOQUE</h1>
        <div class="Container-roupas">
            <div class="roupa">
                <img src="img/mesa.jpg" alt="">
                <p>Organizador de Mesa</p>
                <h5>R$ 29,99</h5>
                <ion-icon name="cart-outline"></ion-icon>
            </div>
            <!--roupa-->


            <div class="roupa">
                <img src="img/texto.jpg" alt="">
                <p>Marca texto Boss pastel</p>
                <h5>R$ 83,00</h5>
                <span>
                    <ion-icon name="cart-outline"></ion-icon>
                </span>
            </div>
            <!--roupa-->

            <div class="roupa">
                <img src="img/caderno.jpg" alt="">
                <p>Caderno A5 Capa Dura</p>
                <h5>R$ 52,90</h5>
                <ion-icon name="cart-outline"></ion-icon>
            </div>
            <!--roupa-->

            <div class="roupa">
                <img src="img/bloquinho.jpg" alt="">
                <p> Caderno com Bloquinho Postite</p>
                <h5>R$ 6,90 (Unidade) </h5>
                <ion-icon name="cart-outline"></ion-icon>
            </div>
            <!--roupa-->
        </div>
        <!--container-roupas-->
    </section>


    <!--Marcas-->

    <section class="Contato" id="Contato">
        <div class="meio-contato">
            <h3>Classix</h3>
            <h5>Nós envie uma mensagem</h5>
            <div class="icons">
                <a href="#"><i class='bx bxl-facebook-square'></i></a>
                <a href="#"><i class='bx bxl-instagram-alt'></i></a>
                <a href="#"><i class='bx bxl-twitter'></i></a>
            </div>
        </div>

        <div class="meio-contato">
            <h3>Explore</h3>
            <li><a href="#home">Home</a></li>
            <li><a href="#featured">Featured</a></li>
            <li><a href="#new">New</a></li>
            <li><a href="#contact">Contact</a></li>
        </div>

        <div class="meio-contato">
            <h3>Our Services</h3>
            <li><a href="#">Pricing</a></li>
            <li><a href="#">Free Shipping</a></li>
            <li><a href="#">Gift Cards</a></li>
        </div>

        <div class="meio-contato">
            <h3>Shopping</h3>
            <li><a href="#">Clothing Store</a></li>
            <li><a href="#">Trending Shoes</a></li>
            <li><a href="#">Accessories</a></li>
            <li><a href="#">Sale</a></li>
        </div>

    </section>






    <script src="https://unpkg.com/scrollreveal"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="./script/index.js"></script>
    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        document.getElementById('iconePesquisa').addEventListener('click', function() {
            document.getElementById('formPesquisa').submit();
        });

        window.onscroll = function() {
            scrolleffect()
        };

        function scrolleffect() {
            if (document.documentElement.scrollTop > 300) {
                document.getElementById("bottom-a").style.display = "";
            } else {
                document.getElementById("bottom-a").style.display = "none";
            }
        }

        /* document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('scroll', function() {
                const box = document.querySelector('.box');
                const boxTop = box.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;

                if (boxTop < windowHeight) {
                    box.classList.add('active');
                }
            });
        });
        */
    </script>
</body>

</html>
<script src="https://sdk.scdn.co/spotify-player.js"></script>
  <script>
    window.onSpotifyWebPlaybackSDKReady = () => {
      const token = new URLSearchParams(window.location.search).get('token');

      const player = new Spotify.Player({
        name: 'Meu Reprodutor',
        getOAuthToken: cb => { cb(token); }
      });

      // Conectar-se ao reprodutor
      player.connect().then(success => {
        if (success) {
          console.log('Conectado ao Spotify Web Playback SDK');
        }
      });

      document.getElementById('play').addEventListener('click', () => {
        // Chame o método de resume() para reproduzir a música
        fetch('http://localhost:3000/play', { method: 'POST' })
          .then(response => response.text())
          .then(message => {
            console.log(message); // Exiba a mensagem da resposta no console
          })
          .catch(error => {
            console.error('Erro ao p a música:', error);
          });
      });


      document.getElementById('pause').addEventListener('click', () => {
        // Chame o método de pause() para pausar a música
        fetch('http://localhost:3000/pausar', { method: 'POST' })
          .then(response => response.text())
          .then(message => {
            console.log(message); // Exiba a mensagem da resposta no console
          })
          .catch(error => {
            console.error('Erro ao pausar a música:', error);
          });
      });

      document.getElementById('next').addEventListener('click', () => {
        // Chame o método de nextTrack() para avançar para a próxima música
        fetch('http://localhost:3000/play', { method: 'POST' })
          .then(response => response.text())
          .then(message => {
            console.log(message); // Exiba a mensagem da resposta no console
          })
          .catch(error => {
            console.error('sss:', error);
          });
      });

      document.getElementById('info').addEventListener('click', () => {
        // Use uma requisição AJAX para obter informações da música atual
        fetch('/info')
          .then(response => response.json())
          .then(data => {
            document.getElementById('track-name').textContent = `Nome da Música: ${data.name}`;
            document.getElementById('track-artists').textContent = `Artista(s): ${data.artists}`;
            document.getElementById('track-genres').textContent = `Gêneros: ${data.genres.join(', ')}`;
            document.getElementById('track-image').src = data.imageUrl;
          })
          .catch(error => {
            console.error('Erro ao obter informações da música:', error);
          });
      });
    };
  </script>