<?php

include "resources/api.php";

$title = 'Motos';
$description = 'Busca de motos';
$keywords = $title . ", Orçamento para " . $title . ", Valores para " . $title . ", Preços para " . $title;
$keyregiao = "$title";

$page = isset($_GET['page']) ? $_GET['page'] : "1";
$results = api("GET", "motorcycles?page=" . $page);
$itemLinkType = 'motorcycles';

include "includes/head.php";
?>
<main class="mb-4 adv">
    <section class="bg-third py-3 breadcrumb">
        <div class="container py-4">
            <div class="d-flex gap-1 pb-2 align-items-center">
                <a href="<?= $url ?>">Home</a>
            </div>
            <h1 class="h3"><?= $title ?></h1>
        </div>
    </section>
    <div class="container py-5">
        <div class="row">
            <?php paginatedAds($results, $url, $itemLinkType); ?>
        </div>
    </div>
</main>
<?php include "includes/footer.php"; ?>