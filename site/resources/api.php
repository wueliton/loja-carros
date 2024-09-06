<?php

require '../vendor/autoload.php';

use GuzzleHttp\Client;

$base = "http://localhost:8000";
$apiImagesPath = $base . "/storage/uploads/";
$apiPath = $base . "/api/";

$client = new Client([
    'base_uri' => $apiPath,
]);


function api(string $method, string $endpoint)
{
    global $client;

    try {
        $response = $client->request($method, $endpoint);
        $body = $response->getBody();
        return json_decode($body, true);
    } catch (\GuzzleHttp\Exception\RequestException $e) {
        print_r($e);
        return null;
    }
}

function convertDate(string $isoDate)
{
    $date = new DateTime($isoDate);
    return $date->format('d/m/y H:i');
}

function toBRL($price)
{
    $formatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);
    $formatter->setPattern("¤ #,##0.00");
    return $formatter->formatCurrency($price, "BRL");
}

function toKM($number)
{
    $toNumber = ceil($number);
    return number_format($toNumber, 0, ',', '.') . " km";
}

function renderCarAttributes($car)
{
    $attributes = [
        ['title' => 'Portas', 'content' => $car['doors']],
        ['title' => 'Câmbio', 'content' => $car['transmission']['name']],
        ['title' => 'Cor', 'content' => $car['color']['color']],
        ['title' => 'Ano', 'content' => $car['year'] . '/' . $car['manufacturing_year']],
        ['title' => 'Combustível', 'content' => $car['fuel_type']['name']],
        ['title' => 'Final da Placa', 'content' => $car['last_digit']],
    ];

    foreach ($attributes as $att) {
        echo "<div class='col-lg-6 d-flex'><span>" . $att['title'] . ": <strong>" . $att['content'] . "</strong></span></div>";
    }
}

function formatPhone($phoneNumber)
{
    $phoneNumber = preg_replace('/\D/', '', $phoneNumber);
    if(strlen($phoneNumber) == 11) {
        $phoneNumber = preg_replace('/(\d{2})(\d{1})(\d{4})(\d{4})/', '($1) $2$3-$4', $phoneNumber);
    }
    else if(strlen($phoneNumber) == 10) {
        $phoneNumber = preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $phoneNumber);
    }
    return $phoneNumber;
}
