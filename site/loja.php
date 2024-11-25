<?php

include "resources/api.php";

$slug = isset($_GET['slug']) ? $_GET['slug'] : null;

$store = api("GET", "stores/" . $slug);

$searchParams = convertSearchFilter(["type" => "cars", "store_id" => $store['id']]);
$storeCarPage = isset($_GET['car_page']) && $_GET['car_page'] !== "1" ? "page=" . $_GET['car_page'] . "&" : "";
$storeCars = api("GET", "cars?" . $storeCarPage . $searchParams["filter"]);

$motorcyclesSearchParams = convertSearchFilter(["type" => "motorcycles", "store_id" => $store['id']]);
$storeMotorcyclePage = isset($_GET['moto_page']) && $_GET['moto_page'] !== "1" ? "page=" . $_GET['moto_page'] . "&" : "";
$storeMotorcycles = api("GET", "motorcycles?" . $storeMotorcyclePage . $motorcyclesSearchParams['filter']);

$title = $store['name'];
$description = '';
$keywords = $title;

include "includes/head.php";
?>
<section class="bg-third py-3 breadcrumb">
    <div class="container py-4">
        <div class="d-flex gap-1 pb-2 align-items-center">
            <a href="<?= $url ?>">Home</a>
            <i class="fa-solid fa-chevron-right"></i>
            <a href="<?= $url ?>lojas">Lojas</a>
        </div>
        <h1 class="h2"><?= $title ?></h1>
    </div>
</section>
<main class="container mb-4" x-data="storeVehicles()">
    <div class="row">
        <div class="col-12 mt-4 pb-4">
            <div class="store-card">
                <div class="d-flex gap-4 p-4">
                    <img src="<?= $apiImagesPath . $store['logo_url'] ?>" width="200" height="100" />
                    <div>
                        <h1 class="mb-2"><?= $store['name'] ?></h1>
                        <p class="m-0 p-0">Loja: <?= $store['store_number'] ?></p>
                        <p class="m-0 p-0">Telefone: <?= $store['phone'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class"col-12">
            <div class="tabs">
                <button value="carros" @click="changeType($event.target.value)"
                    :class="type === 'carros' ? 'active' : 'null'">Carros</button>
                <button value="motos" @click="changeType($event.target.value)"
                    :class="type === 'motos' ? 'active' : 'null'">Motos</button>
            </div>
        </div>
        <template x-if="type === 'carros'">
            <div class="col-12">
                <?= paginatedAds($storeCars, $url, "cars", "car_page", "carros") ?>
            </div>
        </template>
        <template x-if="type === 'motos'">
            <div class="col-12">
                <?= paginatedAds($storeMotorcycles, $url, "motorcycles", "moto_page", "motos") ?>
            </div>
        </template>
    </div>
</main>

<script>
    function storeVehicles() {
        return {
            type: "<?= $_GET['tipo'] ?? 'carros' ?>",
            changeType(type) {
                this.type = type;
                const url = new URL(window.location.href);
                url.searchParams.set('tipo', type);
                history.pushState(null, '', url);
            },
        }
    }
</script>

<?php include "includes/footer.php"; ?>