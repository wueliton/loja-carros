<?php
$title = 'AGÊNCIA DE VEÍCULOS NOVOS';
$description = 'Na hora de descobrir uma agência de veículos novos com uma oferta completa de carros, permita-se conhecer o Raposo Auto Shopping, uma das maiores referências no ramo automotivo em São Paulo!';
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
				<p>Na hora de descobrir uma agência de veículos novos com uma oferta completa de carros, permita-se
					conhecer o Raposo Auto Shopping, uma das maiores referências no ramo automotivo em São Paulo!</p>

				<p>O Raposo Auto Shopping é um espaço de mais de 100 mil metros quadrados especializado na venda de
					carros e motos, com agência de veículos novos e multimarcas a trazer uma ampla gama de opções de
					carros no mercado.</p>

				<p>Sejam de marcas nacionais e importadas, a agência de veículos novos desse Auto Shopping confere
					modelos de todas as categorias e segmentos. Isso inclui hatches, sedãs, coupés, pick-ups, SUVs,
					compactos, etc.</p>

				<p>Assim, a oferta apresentada pela agência de veículos novos abrange clientes de diversos perfis,
					demandas e necessidades.</p>

				<p>Por meio da oferta de uma agência de veículos novos é possível conhecer modelos de carros para todo
					tipo de preferência, desejo e contexto, com preços competitivos e ótimas condições de financiamento.
				</p>

				<p>Em termos práticos, nessa agência de veículos novos no Auto Shopping, os clientes disporão de uma
					verdadeiro parque automotivo com a maior oferta disponível na Região Metropolitana de São Paulo.</p>

				<h2><strong>Benefícios de conhecer as ofertas do Raposo Auto Shopping e agência de veículos
						novos</strong></h2>

				<p>No Raposo Auto Shopping estão presente inúmeras marcas, das mais tradicionais a luxuosa e
					requintadas.</p>

				<p>Para quem estiver a procura de um veículo básico ou um modelo importado e distinto, nessa agência de
					veículos novos do Auto Shopping, todas as possibilidades são oferecidas ao público.</p>

				<p>Dentre os principais benefícios conferidos, estão a economia de tempo, amplitude de oferta, ambiente
					integralmente dedicado ao setor automotivo e <em>know how</em> de profissionais experientes na área,
					cujo serviço tradicional e exclusivo garante a total satisfação da clientela.</p>

				<p>Venha visitar o amplo parque automotivo do Raposo Auto Shopping, referência total quando se tratar de
					venda de veículos novos, seminovos e usados!</p>
			</div><?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>