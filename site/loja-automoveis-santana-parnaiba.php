<?php
$title = 'LOJA DE AUTOMÓVEIS EM SANTANA DE PARNAÍBA';
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

				<p>Localizado perto do Rodoanel e entre as marginais do Rio Pinheiros e Tietê, o Raposo Auto Shopping
					cobre uma grande quantidade de veículos na loja de automóveis em Santana de Parnaíba e outras
					localidade na Região Metropolitana de São Paulo.</p>

				<p>A loja de automóveis em Santana de Parnaíba, dentro do espaço comercial do Shopping Automotivo,
					inclui veículos de todos os portes, categorias e segmentos, com objetivo de entregar um atendimento
					personalizado aos clientes.</p>

				<h2><strong>Por que comprar o seu veículo na loja de automóveis em Santana de Parnaíba</strong></h2>

				<p>A loja de automóveis em Santana de Parnaíba (no espaço do Raposo Auto Shopping) possibilita descobrir
					uma extensa gama de ofertas de carros de todos os tipos: hatches, sedãs, pick-ups, SUVs, etc.</p>

				<p>Logo, o maior diferencial dessa loja de automóveis em Santana de Parnaíba está no fato de reunir em
					um único ambiente por muitas marcas de veículos.</p>

				<p>As vantagens são evidentes: maior praticidade, conveniência, economia de tempo, extensa oferta de
					veículos de todos os tipos para atender as buscas e preferências da clientela.</p>

				<p>Essa loja de automóveis em Santana de Parnaíba compõe uma de várias atuantes nesse shopping
					automotivo, onde será plenamente possível descobrir de perto pelas ofertas na escolha do próximo
					carro, seja novo, seminovo ou usado.</p>

				<p>Tanto as marcas nacionais quanto importadas são expostas no ambiente, tendo modelos para todos os
					perfis na loja de automóveis em Santana de Parnaíba.</p>

				<p>Nesse espaço amplo e exclusivo, você poderá encontrar seu próximo veículo em um lugar especializado!
				</p>

				<p>Permita-se visitar o Raposo Auto Shopping!</p>
			</div><?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>