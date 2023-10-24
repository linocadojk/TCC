<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cepDestino = $_POST["cep_destino"];
    $peso = $_POST["peso"];
    $cepOrigem = "12249899"; // Substitua pelo seu CEP de origem
    $valorMerc = $_POST["valor"];
    $altura = $_POST["altura"];
    $comprimento = $_POST["comprimento"];
    $largura = $_POST["largura"];
    $quantidade = $_POST["quantidade"];
    $servico = ['E', 'X', 'M', 'R'];

   // Substitua pela ordem desejada

    $produtos = array(
        array(
            "peso" => $peso,
            "altura" => $altura,
            "largura" => $largura,
            "comprimento" => $comprimento,
            "valor" => $valorMerc,
            "quantidade" => $quantidade
        )
    );

    $data = array(
        "cepOrigem" => $cepOrigem,
        "cepDestino" => $cepDestino,
        "vlrMerc" => $valorMerc,
        "pesoMerc" => $peso,
        "produtos" => $produtos,
        "servicos" => array($servico),
       
    );

    $jsonData = json_encode($data);

    // Seu token de autorização
$token = "42037b390fae0c46824a99d3daea7dad";
$authorizationHeader = "token: " . $token;
$ch = curl_init("https://portal.kangu.com.br/tms/transporte/simular");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    $authorizationHeader // Adicione o cabeçalho de autorização com a chave 'token'
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
if ($response === false) {
    echo "Erro na solicitação: " . curl_error($ch);
} else {
    // Decodifique o JSON da resposta
    $responseData = json_decode($response, true);

    // Verifique se o JSON foi decodificado com sucesso
    if ($responseData !== null) {
        // Início da div para exibir os resultados da API
        echo "<div id='resultado-api'>";
        
        // Itere sobre os resultados e exiba-os
        foreach ($responseData as $resultado) {
            echo "Serviço: " . $resultado['servico'] . "<br>";
            echo "Nome do Transportador: " . $resultado['transp_nome'] . "<br>";
            echo "Valor do Frete: R$ " . $resultado['vlrFrete'] . "<br>";
            echo "Prazo de Entrega: " . $resultado['prazoEnt'] . " dia(s)<br>";
            echo "Descrição: " . $resultado['descricao'] . "<br>";
            echo "==============================<br>";
        }
        
        // Fim da div para exibir os resultados da API
        echo "</div>";
    } else {
        echo "Erro na decodificação do JSON da resposta.";
    }
}
    curl_close($ch);

} else {
    echo "O formulário não foi submetido corretamente.";
}
?>
