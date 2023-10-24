<?php
// Recupere os dados da solicitação AJAX
$produto_id = $_POST['produto_id'];
$quantidade = $_POST['quantidade'];
$cep_destino = $_POST['cep_destino'];

// Construa os dados do produto e do CEP para a solicitação à API de cálculo de frete
$data = [
    'cepOrigem' => '12249899', // Substitua pelo CEP de origem real
    'cepDestino' => $cep_destino,
    'vlrMerc' => 100, // Substitua pelo valor real do produto
    'pesoMerc' => 1, // Substitua pelo peso real do produto
    'produtos' => [
        [
            'peso' => 1, // Substitua pelo peso real do produto
            'altura' => 10, // Substitua pela altura real do produto
            'largura' => 10, // Substitua pela largura real do produto
            'comprimento' => 10, // Substitua pelo comprimento real do produto
            'valor' => 100, // Substitua pelo valor real do produto
            'quantidade' => $quantidade,
        ],
    ],
    'servicos' => ['E', 'X', 'M', 'R'], // Substitua pelos serviços desejados
    'ordernar' => 'string', // Substitua conforme necessário
];

// Envie a solicitação à API de cálculo de frete
$api_url = 'https://portal.kangu.com.br/tms/transporte/simular'; // Substitua pela URL real da API
$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'token:42037b390fae0c46824a99d3daea7dad']); // Substitua pelo token real

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

// Verifique se a solicitação foi bem-sucedida e retorne a resposta em formato JSON
if ($response) {
    echo $response;
} else {
    echo json_encode(['error' => 'Erro na solicitação de cálculo de frete']);
}

curl_close($ch);
