<?php

require_once __DIR__ . '/../../vendor/autoload.php';

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
        ['title' => 'Portas', 'content' => $car['doors'], 'icon' => '<i class="fa-solid fa-door-open"></i>'],
        ['title' => 'Câmbio', 'content' => $car['transmission']['name'], 'icon' => '<i class="fa-solid fa-car"></i>'],
        ['title' => 'Cor', 'content' => $car['color']['color'], 'icon' => '<i class="fa-solid fa-palette"></i>'],
        ['title' => 'Ano', 'content' => $car['year'] . '/' . $car['manufacturing_year'], 'icon' => '<i class="fa-regular fa-calendar"></i>'],
        ['title' => 'Combustível', 'content' => $car['fuel_type']['name'], 'icon' => '<i class="fa-solid fa-gas-pump"></i>'],
        ['title' => 'Final da Placa', 'content' => $car['last_digit'], 'icon' => '<i class="fa-solid fa-hashtag"></i>'],
        ['title' => 'Quilometragem', 'content' => toKM($car['km']), 'icon' => '<i class="fa-solid fa-gauge"></i>'],
    ];

    foreach ($attributes as $att) {
        echo "<div class='col-lg-6 attribute'>" . $att['icon'] . " <span>" . $att['title'] . ": <strong>" . $att['content'] . "</strong></span></div>";
    }
}

function renderCarAttributesTable($car)
{
    $attributes = [
        ['title' => 'Marca', 'content' => $car['brand']['name']],
        ['title' => 'Modelo', 'content' => $car['model']['name']],
        ['title' => 'Version', 'content' => $car['version']],
        ['title' => 'Motor', 'content' => $car['motor']],
    ];

    echo "<table><tbody>";
    foreach (array_filter($attributes, fn($value) => !is_null($value['content'])) as $att) {
        echo "<tr><td>" . $att['title'] . "</td><td>" . $att['content'] . "</td></tr>";
    }
    echo "</tbody></table>";
}

function renderMotorcycleAttributes($motorcycles)
{
    $attributes = [
        ['title' => 'Cor', 'content' => $motorcycles['color']['color'], 'icon' => '<i class="fa-solid fa-palette"></i>'],
        ['title' => 'Ano', 'content' => $motorcycles['year'] . '/' . $motorcycles['manufacturing_year'], 'icon' => '<i class="fa-regular fa-calendar"></i>'],
        ['title' => 'Quilometragem', 'content' => toKM($motorcycles['km']), 'icon' => '<i class="fa-solid fa-gauge"></i>'],
    ];

    foreach ($attributes as $att) {
        echo "<div class='col-lg-6 attribute'>" . $att['icon'] . " <span>" . $att['title'] . ": <strong>" . $att['content'] . "</strong></span></div>";
    }
}

function renderMotorcycleAttributesTable($car)
{
    $attributes = [
        ['title' => 'Marca', 'content' => $car['brand']['name']],
        ['title' => 'Modelo', 'content' => $car['model']['name']],
        ['title' => 'Motor', 'content' => $car['motor']],
    ];

    echo "<table><tbody>";
    foreach (array_filter($attributes, fn($value) => !is_null($value['content'])) as $att) {
        echo "<tr><td>" . $att['title'] . "</td><td>" . $att['content'] . "</td></tr>";
    }
    echo "</tbody></table>";
}

function renderOptionals($vehicle)
{
    echo "<ul class='optionals'>";
    foreach ($vehicle['optionals'] as $optional) {
        echo "<li class='optional'>" . $optional['name'] . "</li>";
    }
    echo "</ul>";
}

function formatPhone($phoneNumber)
{
    $phoneNumber = preg_replace('/\D/', '', $phoneNumber);
    if (strlen($phoneNumber) == 11) {
        $phoneNumber = preg_replace('/(\d{2})(\d{1})(\d{4})(\d{4})/', '($1) $2$3-$4', $phoneNumber);
    } else if (strlen($phoneNumber) == 10) {
        $phoneNumber = preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $phoneNumber);
    }
    return $phoneNumber;
}

function convertBetweenFilter($fieldName, $start, $end)
{
    if ($start && $end) {
        return [
            'fieldName' => $fieldName,
            'value' => [$start, $end],
            'comparison' => 'between'
        ];
    } else {
        return [
            'fieldName' => $fieldName,
            'value' => $start ?? $end,
            'comparison' => $start ? 'gte' : 'lte'
        ];
    }
}

function convertSearchFilter($formSearch)
{
    $searchType = $formSearch['type'];
    unset($formSearch['type']);
    unset($formSearch['page']);
    $removedNullValues = array_filter($formSearch, fn($value) => $value !== '');
    $filter = ['where' => ['and' => []]];

    if (isset($removedNullValues['year_start']) || isset($removedNullValues['year_end'])) {
        $start = isset($removedNullValues['year_start']) ? $removedNullValues['year_start'] : null;
        $end = isset($removedNullValues['year_end']) ? $removedNullValues['year_end'] : null;
        unset($removedNullValues['year_start']);
        unset($removedNullValues['year_end']);
        $filter['where']['and'][] = convertBetweenFilter('year', $start, $end);
    }

    if (isset($removedNullValues['min_price']) || isset($removedNullValues['max_price'])) {
        $start = isset($removedNullValues['min_price']) ? $removedNullValues['min_price'] : null;
        $end = isset($removedNullValues['max_price']) ? $removedNullValues['max_price'] : null;
        unset($removedNullValues['min_price']);
        unset($removedNullValues['max_price']);
        $filter['where']['and'][] = convertBetweenFilter('price', $start, $end);
    }

    if (isset($removedNullValues['optionals'])) {
        unset($removedNullValues['optionals']);
        $filter['where']['and'][] = [
            'fieldName' => $searchType === 'cars' ? 'optionals.car_optional_id' : 'optionals.motorcycle_id',
            'value' => $formSearch['optionals'],
            'comparison' => 'inq'
        ];
    }

    foreach ($removedNullValues as $key => $value) {
        $comparison = 'equals';
        if ($key === 'last_digit') {
            $value = explode(',', implode(',', $value));
            $comparison = 'inq';
        }

        if ($key === 'version') {
            $comparison = 'contains';
        }

        $filter['where']['and'][] = [
            'fieldName' => $key,
            'value' => $value,
            'comparison' => $comparison
        ];
    }

    return ['type' => $searchType, 'filter' => http_build_query($filter, '', '&', PHP_QUERY_RFC3986)];
}

function renderStore($store, $url)
{
    global $apiImagesPath;
    ?>
    <a href="<?= $url ?>lojas/<?= $store['slug'] ?>" class="store-card p-2 mb-2 mb-lg-0">
        <div class="d-flex flex-column gap-4">
            <div class="store-image">
                <img src="<?= $apiImagesPath . $store['logo_url'] ?>" title="<?= $store['name'] ?>" class="img-fluid" />
            </div>
            <div class="content">
                <div><strong><?= $store['name'] ?></strong></div>
                <div>Loja: <?= $store['store_number'] ?></div>
                <?php if ($store['phone']): ?>
                    <div>Tel: <?= formatPhone($store['phone']) ?></div>
                <?php endif; ?>
            </div>
        </div>
    </a>
    <?php
}

function renderAds($vehicle, $url, $type)
{
    global $apiImagesPath;
    $typeUrl = $type === 'cars' ? 'carro' : 'moto';
    ?>
    <a href="<?= $url ?><?= $typeUrl ?>/<?= $vehicle['slug'] ?>" class="product">
        <p class="h6"><?= $vehicle['title'] ?></p>
        <p class="body-alt"><?= $vehicle['color']['color'] ?> | <?= toKM($vehicle['km']) ?></p>
        <img src="<?= empty($vehicle['single_image']) ? $url . 'assets/img/logo.jpg' : $apiImagesPath . $vehicle['single_image']['url'] ?>"
            alt="<?= $vehicle['title'] ?>" loading="lazy">
        <p class="h5 text-right"><?= toBRL($vehicle['price']) ?></p>
    </a>
    <?php
}

function paginatedStores($results, $url)
{
    ?>
    <?php if (!isset($results)): ?>
        <div class="py-5 empty-search mb-5">
            <i class="fa-solid fa-circle-exclamation"></i>
            <p class="subtitle"><strong>Ocorreu um erro ao tentar realizar a busca</strong></p>
            <p>Encontramos um erro ao tentar pesquisar neste momento, por favor, tente novamente mais tarde.</p>
        </div>
    <?php elseif ($results['total'] === 0): ?>
        <div class="py-5 empty-search mb-5">
            <i class="fa-solid fa-magnifying-glass"></i>
            <p class="subtitle"><strong>Desculpe, não encontramos nenhuma correspondência para a busca.</strong></p>
            <p>Não encontramos nenhum resultado para os filtros utilizados.</p>
        </div>
        <div></div>
    <?php else: ?>
        <div x-data="{ search: '' }">
            <div class="col pb-5">
                <label class="search-form-field">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Pesquisar loja" x-model="search">
                </label>
            </div>
            <div class="col-12">
                <div class="row">
                    <?php foreach ($results['data'] as $store): ?>
                        <div class="col-lg-4 mb-4" x-show="'<?= strtolower($store['name']) ?>'.includes(search.toLowerCase())">
                            <?= renderStore($store, $url); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php
}

function paginatedAds($results, $url, $type = 'cars', $pageParam = 'page', $typeParams = null)
{
    ?>
    <?php if (!isset($results)): ?>
        <div class="py-5 empty-search mb-5">
            <i class="fa-solid fa-circle-exclamation"></i>
            <p class="subtitle"><strong>Ocorreu um erro ao tentar realizar a busca</strong></p>
            <p>Encontramos um erro ao tentar pesquisar neste momento, por favor, tente novamente mais tarde.</p>
        </div>
    <?php elseif ($results['total'] === 0): ?>
        <div class="py-5 empty-search mb-5">
            <i class="fa-solid fa-magnifying-glass"></i>
            <p class="subtitle"><strong>Nenhum veículo encontrado.</strong></p>
            <p>Sua busca não retornou nenhum resultado, modifique a busca e tente novamente.</p>
        </div>
        <div></div>
    <?php else: ?>
        <div class="col-12">
            <div class="row">
                <?php foreach ($results['data'] as $vehicles): ?>
                    <div class="col-lg-4 mb-2">
                        <?= renderAds($vehicles, $url, $type); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-12 pt-4">
            <?= paginator($results, $pageParam, $typeParams) ?>
        </div>
    <?php endif; ?>
<?php
}

function paginator($results, $pageParam = 'page', $type = null)
{
    $params = $_GET;
    unset($params[$pageParam]);
    unset($params['slug']);
    unset($params['tipo']);
    $paramsToString = http_build_query($params);
    if (isset($type)) {
        $paramsToString = "tipo=" . $type . "&" . $paramsToString;
    }

    ?>
    <div class="pagination">
        <?php if ($results['prev_page_url']): ?><a
                href="?<?= $paramsToString ?>&<?= $pageParam ?>=<?= $results['current_page'] - 1 ?>"><i
                    class="fa-solid fa-chevron-left"></i>
                Anterior</a><?php endif; ?>
        <?php if ($results['current_page'] > 8): ?>
            <a href="?<?= $paramsToString ?>&<?= $pageParam ?>=1">1</a>
            <span>...</span>
        <?php endif ?>
        <?php for ($i = $results['current_page']; $i <= min($results['last_page'], $results['current_page'] + 8); $i++): ?>
            <a href="?<?= $paramsToString ?>&<?= $pageParam ?>=<?= $i ?>"
                class="<?= $results['current_page'] === $i ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
        <?php if ($results['next_page_url']): ?><a
                href="?<?= $paramsToString ?>&<?= $pageParam ?>=<?= $results['current_page'] + 1 ?>">
                Próxima <i class="fa-solid fa-chevron-right"></i></a><?php endif; ?>
    </div>
    <?php
}
