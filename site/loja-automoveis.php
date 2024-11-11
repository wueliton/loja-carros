<?php
$title = 'LOJA DE AUTOMÓVEIS';
$description = 'Se você está em busca de uma loja de automóveis para conhecer uma extensa oferta de veículos de diversas marcas e modelos, a Raposo Auto Shopping é um dos locais mais completos na região da Grande São Paulo!';
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
				<p>Se você está em busca de uma loja de automóveis para conhecer uma extensa oferta de veículos de
					diversas marcas e modelos, a Raposo Auto Shopping é um dos locais mais completos na região da Grande
					São Paulo!</p>

				<p>A Raposo Auto Shopping reúne marcas nacionais e importadas em um espaço de mais de 100 mil metros
					quadrados, com variedade de lojas de automóveis novos, seminovos e motos.</p>

				<p>Então, nesse conceito de loja de automóveis fica muito mais fácil de encontrar nessa extensa gama de
					possibilidades, as suas marcas favoritas, podendo aproveitar a facilidade de tudo estar em um só
					lugar!</p>

				<h2><strong>Praticidade e diversidade de serviços na loja de automóveis</strong></h2>

				<p>Dentro desse grupo de lojas de automóveis, é entregue praticidade e diversidade de serviços no
					comércio de veículos.</p>

				<p>Cada visita é uma experiência única, cuja oferta é certamente uma das mais amplas da região &ndash; e
					do país.</p>

				<p>Localizado próximo do Rodoanel e entre as marginais dos rios Pinheiros e Tietê, o Raposo Auto
					Shopping cobre uma grande variedade de lojas de automóveis e um completo centro automotivo.</p>

				<p>Assim, o espaço atrai clientes da capital paulista e Região Metropolitana, tal como das cidades
					vizinhas.</p>

				<h2><strong>Benefícios de visitar uma área dedicada a loja de automóveis</strong></h2>

				<p>Sem dúvidas, o fato de poder conhecer os mais plurais tipos de veículos, segmentos, tamanhos e
					categorias será extremamente útil para potenciais clientes que buscam conhecer o serviço e encontrar
					sua próxima aquisição.</p>

				<p>A praticidade e a reunião de uma abrangente gama de veículos no grupo de loja de automóveis
					proporciona uma experiência única e diferenciada para o público de todos os perfis e segmentos
					sócio-econômicos.</p>

				<p>Esteja precisando comprar um carro popular ou modelos de SUVs modernos e requintados, no Raposo Auto
					Shopping há opções para todos os gostos, preferências e necessidades!</p>

				<p>Permita conhecer esse conceito de loja de automóveis a reunir com abrangência e totalidade o que há
					de mais moderno e atual em vendas de carros nesse local dedicado ao ramo automotivo!</p>

				<p>Pensou em comprar um carro novo ou usado? Descubra as suas inúmeras possibilidades no Raposo Auto
					Shopping!</p>
			</div><?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>