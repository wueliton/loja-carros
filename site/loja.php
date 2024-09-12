<?php

include "resources/api.php";

$slug = isset($_GET['slug']) ? $_GET['slug'] : null;

$store = api("GET", "stores/" . $slug);
$storeVehicles = api("GET", "stores/ads/" . $store['id']);

$title = $store['name'];
$description = '';
$keywords = $title;

include "includes/head-2.php";
?>
<main class="container mb-4">
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
        <div class="col-12">
            <?= paginatedAds($storeVehicles, $url, $apiImagesPath) ?>
        </div>
    </div>
</main>
<?php include "includes/footer.php"; ?>
