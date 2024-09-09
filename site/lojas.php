<?php

include "resources/api.php";

$title = "Lojas";
$description = '';
$keywords = $title;

$stores = api("GET", "stores");

include "includes/head.php";
?>
<main class="container py-5">
    <div class="row">
        <div class="col-12 mb-4">
            <h1>Lojas</h1>
        </div>
        <div class="col-12">
            <?= paginatedStores($stores, $url) ?>
        </div>
    </div>
</main>
<?php include "includes/footer.php"; ?>
