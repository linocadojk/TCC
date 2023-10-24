const express = require('express');
const SpotifyWebApi = require('spotify-web-api-node');
const path = require('path');
const mysql = require('mysql2'); // Importe o módulo para conectar ao MySQL

const app = express();

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

// Configurações da API do Spotify
const spotifyApi = new SpotifyWebApi({
  clientId: '1997a97ed1bc4ad1818d90a671f3f06e',
  clientSecret: 'd6bafd58a38a4c4faadaa4cfd54b57a3',
  redirectUri: 'http://localhost:3000/callback'
});

// Configurações do banco de dados
const dbConfig = {
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'linoca'
};
const connection = mysql.createConnection(dbConfig);

app.get('/login', (req, res) => {
  const authorizeURL = spotifyApi.createAuthorizeURL(['user-read-playback-state', 'user-modify-playback-state', 'user-read-email']);
  res.redirect(authorizeURL);
});app.get('/callback', async (req, res) => {
  const { code } = req.query;

  try {
    const data = await spotifyApi.authorizationCodeGrant(code);
    const accessToken = data.body.access_token;
    const refreshToken = data.body.refresh_token;

    // Defina o token de acesso e o token de atualização
    spotifyApi.setAccessToken(accessToken);
    spotifyApi.setRefreshToken(refreshToken);

    // Use o token de acesso para buscar informações adicionais do usuário
    const userData = await spotifyApi.getMe();
    const userId = userData.body.id;
    const userEmail = userData.body.email; // Você pode usar o email se estiver disponível

    // Agora você pode acessar as informações do usuário, incluindo o 'id' e, opcionalmente, o 'email'

    // Inserir os dados na tabela Users (supondo que você tenha uma conexão com o banco de dados)
    const insertUserQuery = 'INSERT INTO Users (nome, email) VALUES (?, ?)';
    const userValues = ['Nome do Usuário', userEmail || null]; // Use null se o email não estiver disponível
    const [userInsertResult] = await connection.execute(insertUserQuery, userValues);
    
    const insertSpotifyAuthQuery = 'INSERT INTO spotifyauth (user_id, spotify_id, access_token) VALUES (?, ?, ?)';
    const spotifyAuthValues = [userInsertResult.insertId, userId, accessToken || null]; // Use null se os valores não estiverem disponíveis
    await connection.execute(insertSpotifyAuthQuery, spotifyAuthValues);
    
    // Redirecione para a página do reprodutor
    res.redirect(`http://localhost/projetos/TCC/19x09/TCC/`);
  } catch (error) {
    console.error('Erro ao autenticar:', error);
    res.status(500).send('Erro ao autenticar. Verifique o console.');
  }
});



app.get('/player', (req, res) => {
  spotifyApi.getMyCurrentPlayingTrack().then(data => {
    const { name, album, artists } = data.body.item; // Obtém o nome da música, informações do álbum e artistas
    const imageUrl = album.images[0].url; // Obtém a URL da imagem da capa do álbum
    const artistNames = artists.map(artist => artist.name).join(', '); // Obtém os nomes dos artistas

    res.render('player', { name, imageUrl, artistNames }); // Renderiza a página 'player.ejs' com as informações
  }).catch(error => {
    console.error('Erro ao obter a música atual:', error);
    res.status(500).send('');
  });
});
app.get('/atual', (req, res) => {
  spotifyApi.getMyCurrentPlayingTrack().then(data => {
    const { name, album } = data.body.item; // Obtém o nome da música e informações do álbum
    const imageUrl = album.images[0].url; // Obtém a URL da imagem da capa do álbum

    res.render('musica', { name, imageUrl }); // Renderiza a página 'musica.ejs' com as informações
  }).catch(error => {
    console.error('Erro ao obter a música atual:', error);
    res.status(500).send('Erro ao obter a música atual. Verifique o console.');
  });
});

app.get('/info', (req, res) => {
  spotifyApi.getMyCurrentPlayingTrack().then(data => {
    const trackId = data.body.item.id;

    spotifyApi.getTrack(trackId).then(trackData => {
      const trackInfo = {
        name: trackData.body.name,
        genres: trackData.body.album.genres,
      };
      res.json(trackInfo);
    }).catch(error => {
      console.error('Erro ao obter informações da faixa:', error);
      res.status(500).send('Erro ao obter informações da faixa. Verifique o console.');
    });
  }).catch(error => {
    console.error('Erro ao obter a música atual:', error);
    res.status(500).send('Erro ao obter a música atual. Verifique o console.');
  });
});

app.all('/pausar', (req, res) => {
  if (req.method === 'POST' || req.method === 'GET') {
    spotifyApi.pause().then(() => {
      res.send('Música pausada.');
    }).catch(error => {
      console.error('Erro ao pausar a música:', error);
      res.status(500).send('Erro ao pausar a música. Verifique o console.');
    });
  } else {
    res.status(405).send('Método não permitido.');
  }
});

app.all('/play', (req, res) => {
  if (req.method === 'POST' || req.method === 'GET') {
    spotifyApi.play().then(() => {
      res.send('Música playada.');
    }).catch(error => {
      console.error('Erro ao pa música:', error);
      res.status(500).send('Erro ao p a música. Verifique o console.');
    });
  } else {
    res.status(405).send('Método não permitido.');
  }
});
app.all('/avancar', (req, res) => {
  if (req.method === 'POST' || req.method === 'GET') {
    spotifyApi.skipToNext().then(() => {
      res.send('Próxima música.');
    }).catch(error => {
      console.error('Erro ao pa música:', error);
      res.status(500).send('Erro ao p a música. Verifique o console.');
    });
  } else {
    res.status(405).send('Método não permitido.');
  }
});




app.listen(3000, () => {
  console.log('Servidor rodando em http://localhost:3000');
});
//


//https://developer.spotify.com/documentation/web-api/reference/start-a-users-playback

//https://developer.spotify.com/documentation/web-api/concepts/scopes