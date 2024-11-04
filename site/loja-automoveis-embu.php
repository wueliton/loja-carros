<?php
$title = 'LOJA DE AUTOMÓVEIS EM EMBU';
$description = 'Conheça o Raposo Auto Shopping, um ambiente dedicado de mais de 100 mil metros quadrados dedicado ao comércio de veículos novos, seminovos e motos.';
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
				<p>Conheça o Raposo Auto Shopping, um ambiente dedicado de mais de 100 mil metros quadrados dedicado ao
					comércio de veículos novos, seminovos e motos.</p>

				<p>Localizado próximo do Rodoanel e entre as marginais do Rio Pinheiros e Tietê, o Raposo Auto Shopping
					cobre uma extensa quantidade de serviços de loja de automóveis em Embu e outros municípios da Região
					Metropolitana de São Paulo.</p>

				<p>A loja de automóveis em Embu, dentro do espaço comercial desse Shopping Automotivo, inclui a venda de
					veículos de todos as categorias, portes e características, justamente para que clientes de todos os
					perfis possam encontrar o seu próximo carro.</p>

				<h2><strong>Por que comprar seu veículo na loja de automóveis em Embu</strong></h2>

				<p>A loja de automóveis em Embu (no espaço do Raposo Auto Shopping) possibilita descobrir ofertas
					específicas de veículos, o que inclui: hatches, sedãs, pick-ups, SUVs, coupés e variados segmentos.
				</p>

				<p>Então, o grande diferencial dessa loja de automóveis em Embu, reside no fato de estar situado em um
					local a trazer todas as marcas de veículos e inúmeros modelos em um só local.</p>

				<p>As vantagens são muitas: praticidade, conveniência, economia de tempo, enorme oferta de veículos de
					todos os tipos para clientes de todos os perfis e preferências.</p>

				<p>Literalmente, a loja de automóveis em Embu se trata de um shopping de veículos, onde se poderá
					encontrar o que há de mais completo no ramo para quem estiver a procura de um veículo novo, seminovo
					ou usado.</p>

				<p>Tanto marcas nacionais quanto importadas se fazem presente na loja de automóveis em Embu, no Raposo
					Auto Shopping, em que uma grande vitrine de veículos são apresentados no amplo espaço.</p>

				<p>Certamente na loja de automóveis em Embu, você poderá encontrar muitas ofertas para o tipo de veículo
					que está buscando, diretamente em um centro especializado em carros e motos.</p>

				<p>Por que buscar o seu próximo carro em uma só loja quando você pode conhecer inúmeras lojas situadas
					no mesmo local, de forma a unificar suas possibilidades e abranger todo tipo de escolha?</p>

				<p>Conheça o trabalho em grande escala para a venda de veículos diretamente com um centro de referência
					em comércio automotivo na Região Metropolitana de São Paulo!</p>
			</div><?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>