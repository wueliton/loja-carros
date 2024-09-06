<?php
$title        = 'AUTOMÓVEIS USADOS EM SÃO PAULO';
$description  = 'No Raposo Auto Shopping, um amplo parque automotivo especializado na venda de automóveis usados em São Paulo, prevalece o mais alto padrão de qualidade do mercado.';
$keywords     = $title . ", Orçamento para " . $title . ", Valores para " . $title . ", Preços para " . $title;
$keyregiao  = "$title";
include "includes/head.php";

?>
<main role="main" class="conteudo">
	<div class="brand-banner">
		<div class="container">
			<h1><?= $title ?></h1>
			<div class="brand-banner-nav">
				<ul>
					<li>
						<a href="<?= $url ?>" style="color:white">Home</a>
						<i class="fa-solid fa-angles-right" style="color:white"></i>
					</li>
					<li>
						<a href="<?= $url ?>mapa-site" style="color:white"> Mapa do Site </a>
						<i class="fa-solid fa-angles-right" style="color:white"></i>
					</li>
					<li style="color:white">
						<?= $title ?>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<article class="style-palavra">
			<?php include 'includes/banner-info.php'; ?>
			<p>No Raposo Auto Shopping, um amplo parque automotivo especializado na venda de automóveis usados em São Paulo, prevalece o mais alto padrão de qualidade do mercado.</p>

<p>Localizado perto do Rodoanel e dos rios Tietê e Pinheiros, o Raposo Auto Shopping possui uma área de mais de 100 mil metros quadrados inteiramente dedicada a serviços de venda de automóveis usados em São Paulo, e também de carros zero km e seminovos.</p>

<p>Os carros usados com procedência e garantia são fundamentais para quem procura uma opção de carro usado assegurado e com a devida comprovação de suas condições.</p>

<p>Na realidade é fundamental para qualquer cliente que procure automóveis usados em São Paulo, que tenha segurança técnica e jurídica ao veículo, sem o risco de problemas mecânicos e legais.</p>

<h2><strong>Por que conhecer o Raposo Auto Shopping para a aquisição de carros usados</strong></h2>

<p>O principal benefício ao explorar o Raposo Auto Shopping está no fato desse ser um dos maiores shopping especializados em carros no Brasil.</p>

<p>Dessa forma, esse Auto Shopping reúne muitas lojas em só local. Isso proporciona aos clientes por maior praticidade, foco, conveniência e economia de tempo ao poderem conhecer muitas opções de carros nacionais e importados, de muitas marcas e de todos os segmentos e categorias.</p>

<p>A gama de veículos usados com procedência e segurança no Raposo Auto Shopping abrange carros de marcas europeias, americanas e asiáticas. Incluem hatches, sedãs, SUVs, compactos, pick-ups, utilitários e coupés. Sempre com garantia.</p>

<p>Seguramente nesse extenso parque automotivo a clientela terá a segurança, o conforto e a certeza de poderem usufruir do mais profissionais e dedicado serviço para compra de carros usados na Região Metropolitana de São Paulo.</p>
			<?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>