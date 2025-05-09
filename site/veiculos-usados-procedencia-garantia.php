﻿<?php
$title = 'VEÍCULOS USADOS COM PROCEDÊNCIA E GARANTIA';
$description = 'No Raposo Auto Shopping, um vasto parque automotivo especializado na venda de carros novos e veículos usados com procedência e garantia, é oferecido o mais elevado padrão de qualidade ao mercado.';
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
				<p>No Raposo Auto Shopping, um vasto parque automotivo especializado na venda de carros novos e veículos
					usados com procedência e garantia, é oferecido o mais elevado padrão de qualidade ao mercado.</p>

				<p>Situado próximo do Rodoanel e dos rios Tietê e Pinheiros, o Raposo Auto Shopping possui uma área de
					mais de 100 mil metros quadrados dedicada a serviços de comercialização de veículos usados com
					procedência e garantia e também carros zero km e seminovos.</p>

				<p>Os veículos usados com procedência e garantia são essenciais para quem busca uma opção de carro
					usado, porém devidamente regular, assegurado e com a devida comprovação de sua condição adequada.
				</p>

				<p>Na verdade é essencial para qualquer cliente que busque veículos usados com procedência e garantia,
					pois dessa forma se consegue adquirir um automóvel com segurança técnica e jurídica, sem o risco de
					problemas mecânicos, físicos e legais.</p>

				<h2><strong>Por que conhecer o Raposo Auto Shopping para a compra de veículos usados com procedência e
						garantia</strong></h2>

				<p>O maior benefício em conhecer o Raposo Auto Shopping reside no fato de ser esse um dos maiores
					shoppings especializados em veículos do país.</p>

				<p>Desse modo, no Auto Shopping estão reunidas muitas lojas em um só local. Isso proporciona aos
					clientes por maior conveniência, praticidade e economia de tempo ao poderem conhecer inúmeras opções
					de modelos nacionais e importados de todos os segmentos e categorias.</p>

				<p>A oferta de veículos usados com procedência e garantia no Raposo Auto Shopping abrange veículos de
					muitas marcas, sejam europeias, americanas ou asiáticas.</p>

				<p>São hatches, sedãs, SUVs, pick-ups, utilitários, compactos, coupés, dentre outras opções que podem
					ser adquiridas de veículos usados com procedência e garantia.</p>

				<p>Certamente nesse vasto parque automotivo os clientes terão a segurança, o conforto e a certeza de
					poderem usufruir de todos os benefícios trazidos pela aquisição de veículos usados com procedência e
					garantia.</p>
			</div><?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>