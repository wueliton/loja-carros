<?php

include "resources/api.php";

$title = "Lojas";
$description = '';
$keywords = $title;

$stores = api("GET", "stores?" . $_SERVER['QUERY_STRING']);

include "includes/head.php";
?>
<section class="bg-third py-3 breadcrumb">
    <div class="container py-4">
        <div class="d-flex gap-1 pb-2 align-items-center">
            <a href="<?= $url ?>">Home</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span><?= $title ?></span>
        </div>
        <h1 class="h2"><?= $title ?></h1>
    </div>
</section>
<main class="container py-5">
    <div class="col-12">
        <?= paginatedStores($stores, $url) ?>
    </div>
</main>
<?php include "includes/footer.php"; ?>