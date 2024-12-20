﻿<?php
$title = 'COMPRA, VENDA E TROCA DE AUTOMÓVEIS EM SÃO PAULO';
$description = 'Para encontrar o mais completo serviço de compra, venda e troca de automóveis em São Paulo, venha conhecer o Raposo Auto Shopping.';
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
				<p>Para encontrar o mais completo serviço de compra, venda e troca de automóveis em São Paulo, venha
					conhecer o Raposo Auto Shopping.</p>

				<p>Situado próximo do Rodoanel e dos rios Tietê e Pinheiros, o Raposo Auto Shopping fica em uma área de
					mais de 100 mil metros quadrados dedicada ao ramo automotivo, com serviços de compra, venda e troca
					de automóveis em São Paulo.</p>

				<p>A compra, venda e troca de automóveis em São Paulo no Raposo Auto Shopping abrange marcas nacionais e
					internacionais, com uma exclusiva e extensa oferta a atender a clientes de todos os perfis, demandas
					e preferências.</p>

				<p>Dentre as principais marcas disponíveis para compra, venda e troca de automóveis em São Paulo nesse
					Auto Shopping, estão a Audi, BMW, Mercedes, Porsche, Volvo, Land Rover, Mitsubishi, dentre outros
					nomes renomados.</p>

				<p>Veículos de todos os segmentos e categorias podem ser encontrados nessa amplo parque automotivo
					especializado na compra, venda e troca de automóveis em São Paulo.</p>

				<p>Dentre as possibilidades de compra, venda e troca de automóveis em São Paulo, estão os hatches,
					sedãs, SUVs, pick-ups, compactos, coupés e utilitários.</p>

				<p>Certamente nas ofertas de compra, venda e troca de automóveis em São Paulo do Raposo Auto Shopping há
					modelos para atender a todas as exigências e expectativas do público.<br />
					Seja para adquirir um carro nacional, popular, ou mesmo um veículo importado de luxo, nas ofertas de
					compra, venda e troca de automóveis em São Paulo desse tradicional e grande espaço do Auto Shopping
					você com certeza encontrará o modelo ideal de carro para você!</p>
			</div><?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>