<?php
$title = 'AGÊNCIA DE AUTOMÓVEIS';
$description = 'No Raposo Auto Shopping há uma extensa oferta de veículos, em que agência de automóveis e lojas multimarcas se fazem presente, com as mais completas e modernas opções ao mercado.';
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
				<p>No Raposo Auto Shopping há uma extensa oferta de veículos, em que agência de automóveis e lojas
					multimarcas se fazem presente, com as mais completas e modernas opções ao mercado.</p>

				<p>Em uma área de mais de 100 mil metros quadrados dedicada ao ramo automotivo, o Raposo Auto Shopping
					desponta como uma completíssima estrutura a constituir o comércio de veículos de todos os segmentos
					e categorias.</p>

				<p>Então, esse grande parque automotivo a abranger diversas localidades na Região Metropolitana de São
					Paulo apresenta na agência de automóveis, por exemplo, hatches, sedãs, pick-ups, SUVs, utilitários e
					coupés para uma clientela diversa.</p>

				<h2><strong>Por que buscar uma agência de automóveis no Raposo Auto Shopping</strong></h2>

				<p>Uma agência de automóveis nesse Auto Shopping abrange marcas nacionais e importadas, tendo carros
					novos, seminovos e usados, tendo em vista atender a todos os gostos e bolsos.</p>

				<p>Assim, a agência de automóveis expõe uma oferta versátil e exclusiva de carros de todos os tamanhos,
					categorias e segmentos, sempre com preços competitivos e as melhores condições de financiamento.</p>

				<p>O maior diferencial de visitar a agência de automóveis desse Auto Shopping está no fato de se reunir
					muitas ofertas em um único local especializado no ramo automotivo.</p>

				<p>Além disso, o atendimento personalizado, uma oferta completa e valores imperdíveis para aquisição
					tornam o Raposo Auto Shopping um incomparável parque automotivo em SP.</p>

				<p>Em termos práticos, essa agência de automóveis reúne as mais modernas e tradicionais opções de
					veículos de marcas de diversas procedências, exatamente para atender a todas as demandas e perfis.
				</p>

				<p>Venha conhecer a agência de automóveis em um vasto e dedicado ambiente no setor automotivo!</p>
			</div><?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>