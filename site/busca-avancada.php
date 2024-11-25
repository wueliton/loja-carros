<?php
$title = 'Busca Avançada'; //20-70 CARATERES
$description = 'Busca avançada de veículos'; //70 - 160 CARACTERES
$keywords = $title;
include "includes/head.php";
include "resources/api.php";
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
            <div>
                <?php include "./resources/advanced-search-form.php"; ?>
            </div>
        </div>
    </div>
</section>

<?php include "includes/footer.php"; ?>