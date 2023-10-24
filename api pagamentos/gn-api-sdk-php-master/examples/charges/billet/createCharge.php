<?php

if (file_exists($autoload = realpath(__DIR__ . "/../../../vendor/autoload.php"))) {
	require_once $autoload;
} else {
	print_r("Autoload not found or on path <code>$autoload</code>");
}

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

if (file_exists($options = realpath(__DIR__ . "/../../credentials/options.php"))) {
	require_once $options;
}

$items = [
	[
		"name" => "hungkook do bts",
		"amount" => 10,
		"value" => 3
	],
	[
		"name" => "siuuu",
		"amount" => 2,
		"value" => 2000
	]
];

$shippings = [ // Optional
	[
		"name" => "linocashop",
		"value" => 200
	]
];

$metadata = [
	"custom_id" => "Order_00003",
	"notification_url" => "https://your-domain.com.br/notification/"
];

$body = [
	"items" => $items,
	"shippings" => $shippings,
	"metadata" => $metadata
];

try {
	$api = new Gerencianet($options);
	$response = $api->createCharge($params = [], $body);

	print_r("<pre>" . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</pre>");
} catch (GerencianetException $e) {
	print_r($e->code);
	print_r($e->error);
	print_r($e->errorDescription);
} catch (Exception $e) {
	print_r($e->getMessage());
}
