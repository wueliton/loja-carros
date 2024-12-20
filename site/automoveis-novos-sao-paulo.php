﻿<?php
$title = 'AUTOMÓVEIS NOVOS EM SÃO PAULO';
$description = 'Para comprar automóveis novos em São Paulo, venha conhecer o Raposo Auto Shopping, um amplo parque automotivo dedicado a venda de veículos nacionais e importados, zero km, seminovos e usados.';
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
				<p>Para comprar automóveis novos em São Paulo, venha conhecer o Raposo Auto Shopping, um amplo parque
					automotivo dedicado a venda de veículos nacionais e importados, zero km, seminovos e usados.</p>

				<p>Em uma área de mais de 100 mil metros quadrados, o Raposo Auto Shopping desponta como uma das maiores
					referências comerciais quando o assunto for compra de automóveis novos em São Paulo.</p>

				<p>Situado próximo do Rodoanel e dos rios Tietê e Pinheiros, o Raposo Auto Shopping concentra muitas
					marcas de todas as procedências para automóveis novos em São Paulo.</p>

				<p>Na prática, há nesse Auto Shopping uma extensa e exclusiva oferta de automóveis novos em São Paulo
					que inclui marcas como a Audi, BMW, Mercedes, Porsche, Volvo, Land Rover, GWM, BYD, Mitsubishi,
					dentre outras.</p>

				<p>Os automóveis novos em São Paulo disponíveis à venda no Raposo Auto Shopping podem ser comprados nos
					mais plurais segmentos e categorias, o que inclui hatches, sedãs, SUVs, coupés, compactos,
					utilitários e pick-ups.</p>

				<h2><strong>Benefícios de comprar automóveis novos em São Paulo no Raposo Auto Shopping</strong></h2>

				<p>O maior benefício de comprar automóveis novos em São Paulo no Raposo Auto Shopping reside no fato
					desse vasto ambiente dedicado reunir muitas lojas e opções de veículos em um só local.</p>

				<p>Então, os clientes de todos os perfis, segmentos, demandas e preferências poderão conhecer e explorar
					inúmeras ofertas para todos os gostos e bolsos, tudo no Auto Shopping.</p>

				<p>Portanto, é inegável a praticidade, conveniência e economia de tempo proporcionado aos clientes que
					visitarem o Auto Shopping em busca de automóveis novos em São Paulo, dentre outras possibilidades.
				</p>

				<p>Venha descobrir esse moderno e completíssimo shopping especializado na venda de veículos, cujo
					serviço abrangente cobre a Região Metropolitana de São Paulo! Confira!</p>
			</div><?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>