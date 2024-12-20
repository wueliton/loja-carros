﻿<?php
$title = 'AGÊNCIA DE AUTOMÓVEIS BLINDADOS';
$description = 'Na hora de encontrar uma agência de automóveis blindados de confiança e tradição, venha descobrir as inúmeras ofertas comerciais do Raposo Auto Shopping!';
$keywords = $title . ", Orçamento para " . $title . ", Valores para " . $title . ", Preços para " . $title;
$keyregiao = "$title";
include "includes/head.php";

$cssFile = minimizeCSSsimple('assets/css/main.css');
echo "<style>" . $cssFile . "</style>";

?>
<main role="main" class="conteudo">
    <section class="bg-third py-3 breadcrumb">
        <div class="container py-4">
            <div class="d-flex gap-1 pb-2 align-items-center">
                <a href="<?= $url ?>">Home</a>
                <i class="fa-solid fa-chevron-right"></i>
                <a href="<?= $url ?>mapa-site">Mapa do Site</a>
            </div>
            <h1 class="h3"><?= $title ?></h1>
        </div>
    </section>
    <div class="container">
        <article class="style-palavra">
            <?php include 'includes/banner-info.php'; ?>
            <div class='text-palavra'>
                <p>Na hora de encontrar uma agência de automóveis blindados de confiança e tradição, venha descobrir as
                    inúmeras ofertas comerciais do Raposo Auto Shopping!</p>

                <p>Baseado em um ambiente de mais de 100 mil metros quadrados especializado na venda de carros e motos,
                    ter ao dispor uma agência de automóveis blindados é um diferencial que poucos locais oferecem.</p>

                <p>Poder conhecer a oferta de veículos de uma agência de automóveis blindados será de grande valia para
                    os clientes que estejam procurando uma opção de carro blindado.</p>

                <p>Geralmente o setor de veículos blindados abrange modelos de marcas importadas, sendo ofertas mais
                    requintadas e sofisticadas. Então a agência de automóveis blindados traz uma comercialização de
                    veículos geralmente mais potentes, luxuosos e requintados.</p>

                <h2><strong>Por que explorar suas possibilidades no Raposo Auto Shopping e agência de automóveis
                        blindados</strong></h2>

                <p>O Raposo Auto Shopping é um dos maiores shoppings dedicados a venda de veículos novos, seminovos e
                    usados, além de motos.</p>

                <p>A agência de automóveis blindados presente nesse vasto espaço comercial apresenta uma extensa e
                    exclusiva gama de veículos de todos os segmentos e categorias.</p>

                <p>Dentre as opções trazidas pela agência de automóveis blindados, estão modelos de hatchs, sedãs, SUVs,
                    pick-ups, coupés, dentre outros.</p>

                <p>Clientes de variados perfis, demandas e necessidades poderão encontrar nessa agência de automóveis
                    blindados a sua próxima aquisição de veículo!</p>

                <p>Os veículos blindados são destinados para quem precisa de um carro com proteção máxima contra riscos
                    de roubos, assaltos e sequestros. Ou seja, o trabalho da agência de automóveis blindados é alinhado
                    para atender a esse perfil específico de cliente.</p>

                <p>Portanto, venha explorar as principais alternativas de comercio de veículos blindados diretamente no
                    Raposo Auto Shopping, um tradicional e completo ambiente a expor inúmeras ofertas automotivas para a
                    Região Metropolitana de São Paulo!</p>
            </div><?php
            include 'includes/carrossel.php';
            include 'includes/tags.php';
            include "includes/regioes.php";
            ?>
        </article>
    </div>
</main>
<?php include 'includes/footer.php'; ?>