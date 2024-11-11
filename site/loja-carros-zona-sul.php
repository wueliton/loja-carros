<?php
$title = 'LOJA DE CARROS NA ZONA SUL';
$description = 'A mais completa e moderna loja de carros na zona sul de São Paulo fica localizada no Raposo Auto Shopping, um vasto ambiente comercial de mais de 100 mil metros quadrados dedicados a venda de automóveis novos, seminovos e usados.';
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
				<p>A mais completa e moderna loja de carros na zona sul de São Paulo fica localizada no Raposo Auto
					Shopping, um vasto ambiente comercial de mais de 100 mil metros quadrados dedicados a venda de
					automóveis novos, seminovos e usados.</p>

				<p>A loja de carros na zona sul de SP desse Auto Shopping reúne marcas nacionais e importadas de
					veículos de todos os segmentos e categorias.</p>

				<p>Dentre os tipos de ofertas disponíveis nessa loja de carros na zona sul, estão: hatches, sedãs, SUVs,
					pick-ups, coupés, dentre outros modelos.</p>

				<p>Uma loja de carros na zona sul, a exemplo da situada nesse Auto Shopping, apresenta a mais completa e
					tradicional oferta de veículos para atender a todos os gostos e bolsos na capital paulista.</p>

				<p>Por se tratar de um amplo ambiente dedicado ao comércio automotivo, a loja de carros na zona sul de
					SP reúne não apenas um, mas plurais estabelecimentos do setor.</p>

				<p>Na prática, isso faz toda a diferença, já que os clientes de todos os perfis e demandas poderão
					conhecer uma extensa gama de opções de veículos zero km, seminovo ou usado.</p>

				<p>O fato desse Auto Shopping concentrar variadas ofertas com loja de carros na zona sul torna a
					experiência do cliente a mais completa e específica possível.</p>

				<p>Isso ocorre porque a loja de carros na zona sul, dentre variadas propostas comerciais, consegue
					apresentar tudo o que existe de possibilidades em aquisição de veículo na Região Metropolitana de
					São Paulo.</p>

				<p>Venha descobrir uma ambiente a reunir as mais completas e modernas lojas de automóveis em um espaço
					tradicional a trazer ofertas exclusivas!</p>
			</div><?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>