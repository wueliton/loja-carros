<?php
$title = 'Auto Shopping Raposo'; //20-70 CARATERES
$description = 'Visite o Auto Shopping Raposo, o maior centro automotivo da América, com lojas e serviços para apaixonados por veículos.'; //70 - 160 CARACTERES
$keywords = $title;
include "includes/head-2.php";
include "resources/api.php";
?>

<section>
    <div class="container py-5">
        <div class="row">
            <div>
                <h2>Busca Avançada</h2>
            </div>
            <div>
                <?php include "./resources/advanced-search-form.php"; ?>
            </div>
        </div>
    </div>
</section>

<?php include "includes/footer.php"; ?>
