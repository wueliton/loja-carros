﻿<?php
$title = 'LOJA DE AUTOMÓVEIS EM ALPHAVILLE';
$description = 'Descubra o Raposo Auto Shopping, um amplo espaço comercial de mais de 100 mil metros quadrados dedicado a venda de veículos novos, seminovos e motos.';
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
				<p>Descubra o Raposo Auto Shopping, um amplo espaço comercial de mais de 100 mil metros quadrados
					dedicado a venda de veículos novos, seminovos e motos.</p>

				<p>Situado perto do Rodoanel e entre as marginais do Rio Pinheiros e Tietê, o Raposo Auto Shopping
					abrange uma ampla quantidade de serviços de loja de automóveis em Alphaville e outras localidades na
					Região Metropolitana de São Paulo.</p>

				<p>A loja de automóveis em Alphaville, dentro do espaço comercial do Shopping Automotivo, inclui
					veículos de todos os portes, categorias e segmentos, com objetivo de prover atendimento
					personalizado a todo tipo de demanda dos clientes.</p>



				<h2><strong>Por que adquirir o seu veículo na loja de automóveis em Alphaville</strong></h2>

				<p>A loja de automóveis em Alphaville (no espaço do Raposo Auto Shopping) possibilita explorar ofertas
					específicas de carros, o que inclui: hatches, sedãs, pick-ups, SUVs, coupés e outros segmentos.</p>

				<p>Assim sendo, o maior diferencial dessa loja de automóveis em Alphaville está no fato de reunir em um
					único ambiente por muitas marcas de veículos.</p>

				<p><br />
					Os benefícios são evidentes: maior praticidade, conveniência, economia de tempo, vasta oferta de
					carros de todos os segmentos para cobrir as buscas de uma clientela diversa.</p>

				<p>Essa loja de automóveis em Alphaville é uma das várias atuantes dentro desse shopping automotivo,
					onde será plenamente possível explorar as oportunidades de escolher o próximo carro, seja novo,
					seminovo ou usado.</p>

				<p>Tanto as marcas nacionais quanto importadas apresentam modelos na loja de automóveis em Alphaville,
					no Raposo Auto Shopping, uma ampla vitrine de veículos.</p>

				<p>Seguramente na loja de automóveis em Alphaville, será possível descobrir uma variada e versátil
					oferta para todo tipo de carro, em um espaço dedicado a venda de carros e motos.</p>

				<p>Então, por que buscar pela sua próxima compra de veículo em um só loja quando pode descobrir vários
					estabelecimentos especializados no ramo no mesmo local?</p>

				<p>Conheça os inúmeros serviços comerciais automotivos em grande escala nesse tradicional e grande
					shopping!</p>
			</div><?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>