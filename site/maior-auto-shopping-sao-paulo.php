<?php
$title        = 'MAIOR AUTO SHOPPING DE SÃO PAULO';
$description  = 'Descubra o maior Auto Shopping de São Paulo, o Raposo Auto Shopping, um grande parque automotivo focado no comércio de carros zero km, seminovos e usados.';
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
			<p>Descubra o maior Auto Shopping de São Paulo, o Raposo Auto Shopping, um grande parque automotivo focado no comércio de carros zero km, seminovos e usados.</p>

<p>Atuante na Região Metropolitana de São Paulo, esse que é o maior Auto Shopping de São Paulo, se destaca ao apresentar uma completa e exclusiva oferta de veículos nacionais e importados, de todos os segmentos e categorias.</p>

<p>Em termos práticos, o maior Auto Shopping de São Paulo cobre uma área ampla de mais de 100 mil metros quadrados, de forma a reunir as mais tradicionais marcas automotivas nesse ambiente.</p>

<p>Os mais tradicionais fabricantes automotivos se fazem presentes no maior Auto Shopping de São Paulo, que inclui Audi, BMW, Mercedes, Porsche, Volvo, Land Rover, Hyundai, Honda, Toyota, GM, Ford, etc.</p>

<h2><strong>Por que adquirir o seu próximo veículo no maior Auto Shopping de São Paulo</strong></h2>

<p>Há diversos motivos para você conhecer o maior Auto Shopping de São Paulo.</p>

<p>Muitas lojas multimarcas atuam nesse espaço, tornando-o o maior Auto Shopping de São Paulo. São muitas marcas e modelos nacionais e importados de luxo de todos os segmentos e categorias.</p>

<p>A extensa oferta de carros faz desse o maior Auto Shopping de São Paulo, um atributo e título que são se encontra em nenhum outro local.</p>

<p>Como benefícios maiores em comprar no maior Auto Shopping de São Paulo, estão a praticidade, foco, conveniência e economia de tempo em conhecer muitas opções de carros no mesmo lugar.</p>

<p>Aqui no maior Auto Shopping de São Paulo se poderá encontrar hatches, sedãs, SUVs, utilitários, compactos, coupés e pick-ups para cobrir todas as demandas, preferências e necessidades.</p>

<p>Preços muito competitivos, excelentes condições de financiamento e atendimento personalizado caracterizam o trabalho dos profissionais experientes do Raposo Auto Shopping.</p>
			<?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>