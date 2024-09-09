<?php

$title = "Mapa do Site"; //20-70 CARATERES
$description  = 'Somos a Sinall Locações, especilistas em computadores para aluguel, confira o mapa de nosso site para localizar facilmente o que está buscando.';
$keywords = $title . ' Sinall Locações';

include "includes/head.php";

?>

<section>
    <div class="brand-banner">
        <div class="container">
            <h1><?= $title ?></h1>
            <div class="brand-banner-nav">
                <ul>
                    <li>
                        <a href="<?= $url ?>" style="color:white">Home</a>
                        <i class="fa-solid fa-angles-right" style="color:white"></i>
                    </li>
                    <li style="color:white">
                        <?= $title ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>


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
                        echo '<li ><a href="#" title="Outros Serviços">Outros Produtos</a><ul  >' . montarMenu($menu) . '</ul></li>';
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