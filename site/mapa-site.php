<?php

$title = "Mapa do Site"; //20-70 CARATERES
$description = 'Somos a Sinall Locações, especilistas em computadores para aluguel, confira o mapa de nosso site para localizar facilmente o que está buscando.';
$keywords = $title . ' Sinall Locações';

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

<section>
    <div class="container mapa-lista py-5">
        <ul>
            <li>
                <a href="<?= $url ?>">
                    Home
                </a>
            </li>

            <li>
                <ul class="mapa-outros">
                    <?php
                    if (isset($menu)) {
                        echo '<li ><span>Outros Produtos</span><ul  >' . montarMenu($menu) . '</ul></li>';
                    } else {
                        echo '<li><a href="#" title="Outros Serviços">Outros Produtos</a><ul><li>Nenhum item disponível</li></ul></li>';
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </div>
</section>

<?php include("includes/footer.php") ?>