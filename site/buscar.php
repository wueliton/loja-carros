<?php
$title = 'Busca'; //20-70 CARATERES
$description = 'Visite o Auto Shopping Raposo, o maior centro automotivo da América, com lojas e serviços para apaixonados por veículos.'; //70 - 160 CARACTERES
$keywords = $title;
include "includes/head.php";
include "resources/api.php";

$searchParams = convertSearchFilter($_GET);
$page = isset($_GET['page']) ? $_GET['page'] : "";
$results = api('GET', $searchParams['type'] . '?' . $searchParams['filter'] . "&page=" . $page);
$itemLinkType = $searchParams['type'] === 'cars' ? 'carros' : 'motos';
?>

<section class="bg-third py-3 breadcrumb">
    <div class="container py-4">
        <div class="d-flex gap-1 pb-2 align-items-center">
            <a href="<?= $url ?>">Home</a>
        </div>
        <h1 class="h2"><?= $title ?></h1>
    </div>
</section>
<section>
    <div class="container py-5">
        <div class="row">
            <div class="col-12 pb-4">
                <h2 class="pb-0">Resultados da Busca</h2>
                <?php if (isset($results['total'])): ?>
                    <p><?= $results['total'] ?> encontrados.</p><?php endif; ?>
            </div>
            <?php paginatedAds($results, $url, $itemLinkType); ?>
        </div>
    </div>
</section>

<?php include "includes/footer.php"; ?>