<?php
$title = 'Destaques'; //20-70 CARATERES
$description = 'Visite o Auto Shopping Raposo, o maior centro automotivo da América, com lojas e serviços para apaixonados por veículos.'; //70 - 160 CARACTERES
$keywords = $title;
include "includes/head-2.php";
include "resources/api.php";

$results = api('GET', 'cars');
$itemLinkType = 'carros';
?>

<section>
    <div class="container py-5">
        <div class="row">
            <div class="col-12 pb-4">
                <h2 class="pb-0">Destaques</h2>
                <?php if (isset($results['total'])): ?>
                    <p><?= $results['total'] ?> encontrados.</p><?php endif; ?>
            </div>
            <?php paginatedAds($results, $url, $itemLinkType); ?>
        </div>
    </div>
</section>

<?php include "includes/footer.php"; ?>
