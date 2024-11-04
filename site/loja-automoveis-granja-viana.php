<?php
$title = 'LOJA DE AUTOMÓVEIS NA GRANJA VIANA';
$description = 'Conheça o Raposo Auto Shopping, um vasto ambiente comercial com mais de 100 mil metros quadrados especializado na venda de veículos novos, seminovos e motos.';
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
				<p>Conheça o Raposo Auto Shopping, um vasto ambiente comercial com mais de 100 mil metros quadrados
					especializado na venda de veículos novos, seminovos e motos.</p>

				<p>Localizado próximo do Rodoanel e entre as marginais do Rio Pinheiros e Tietê, o Raposo Auto Shopping
					abrange uma grande quantidade de serviços de loja de automóveis na Granja Viana e outras localidades
					na Região Metropolitana de São Paulo.</p>

				<p>A loja de automóveis na Granja Viana, dentro do espaço comercial do Shopping Automotivo, inclui
					veículos de todos os portes, categorias e segmentos, com objetivo de prover um atendimento
					customizado nas demandas dos clientes.</p>



				<h2><strong>Por que comprar o seu veículo na loja de automóveis na Granja Viana</strong></h2>



				<p>A loja de automóveis na Granja Viana (no ambiente do Raposo Auto Shopping) permite conhecer uma
					extensa gama de ofertas de carros de todos os tipos: hatches, sedãs, pick-ups, SUVs e outros
					segmentos.</p>

				<p>Então, o principal diferencial dessa loja de automóveis na Granja Viana reside no fato de unir em um
					só local por muitas marcas de veículos.</p>

				<p>Os benefícios são óbvios: maior praticidade, conveniência, economia de tempo, vasta oferta de
					veículos de todos os tipos para atender as demandas e necessidades de diversos clientes.</p>

				<p>Essa loja de automóveis na Granja Viana constitui uma de várias presentes nesse shopping automotivo,
					em que será absolutamente possível conhecer de perto pelas ofertas na escolha do próximo carro, seja
					novo, seminovo ou usado.</p>

				<p>Tanto as marcas nacionais quanto importadas são apresentadas no local, com modelos para todos os
					gostos e bolsos na loja de automóveis na Granja Viana.</p>

				<p>Essa ampla vitrine de veículo garante uma versátil e variada gama de opções de carros, em um espaço
					exclusivo e amplo.</p>

				<p>Portanto, por que procurar pelo seu próximo veículo em um local único quando você pode encontrar um
					conjunto de estabelecimentos especializados no setor?</p>

				<p>Venha conhecer o Raposo Auto Shopping e suas vastas possibilidades!</p>
			</div><?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>