<?php
$title = 'AGÊNCIA DE VEÍCULOS';
$description = 'Na hora de encontrar uma agência de veículos com a mais completa oferta de carros zero km, seminovos e usados, venha conhecer o Raposo Auto Shopping, uma das maiores referências em comércio automotivo em São Paulo!';
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
				<p>Na hora de encontrar uma agência de veículos com a mais completa oferta de carros zero km, seminovos
					e usados, venha conhecer o Raposo Auto Shopping, uma das maiores referências em comércio automotivo
					em São Paulo!</p>

				<p>O Raposo Auto Shopping é um centro de mais de 100 mil metros quadrados especializado na venda de
					carros e motos, tendo agência de veículos e lojas multimarcas a apresentar inúmeras opções de
					automóveis.<br />
					<br />
					Sejam de marcas nacionais e importadas, a agência de veículos e o Shopping trazem modelos de todas
					as categorias e segmentos. Isso inclui hatches, sedãs, coupés, pick-ups, SUVs, compactos,
					utilitários, etc.
				</p>

				<p>Desse modo, a oferta apresentada pela agência de veículos cobre a clientes com diversos perfis,
					demandas e preferências.</p>

				<p>Através da oferta de uma agência de veículos, é possível conhecer modelos de automóveis a diferentes
					contextos, necessidades e desejos, sempre com preços competitivos e as melhores condições de
					financiamento do mercado.</p>

				<p>Na prática, nessa agência de veículos e em todo o Auto Shopping, os clientes terão ao dispor por um
					verdadeiro parque automotivo com a mais extensa oferta disponível na Região Metropolitana de São
					Paulo.</p>

				<h2><strong>Benefícios de conhecer as ofertas do Raposo Auto Shopping e agência de veículos</strong>
				</h2>

				<p>No Raposo Auto Shopping estão presentes todas as marcas, das mais tradicionais a luxuosas e
					requintadas.</p>

				<p>Esteja em busca de um carro mais básico ou um modelo importado e diferenciado, na agência de veículos
					atuante nesse Auto Shopping, todas as possibilidades são apresentadas ao público.</p>

				<p>Economia de tempo, conveniência, amplitude de oferta, espaço totalmente dedicado ao ramo automotivo e
					expertise de profissionais nesse ambiente tradicional e exclusivo caracterizam os principais
					benefícios aos clientes.</p>

				<p>Venha descobrir o extenso parque de vendas de automóveis no Raposo Auto Shopping, referência absoluta
					quando o assunto for comércio de carros novos, seminovos e usados! Confira!</p>
			</div><?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>