<?php
$title        = 'LOJA DE CARROS NA ZONA NORTE';
$description  = 'A mais completa e moderna loja de carros na zona norte de São Paulo fica situada no Raposo Auto Shopping, um amplo espaço comercial com mais de 100 mil metros quadrados dedicados na venda de automóveis novos, seminovos e usados.';
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
			<p>A mais completa e moderna loja de carros na zona norte de São Paulo fica situada no Raposo Auto Shopping, um amplo espaço comercial com mais de 100 mil metros quadrados dedicados na venda de automóveis novos, seminovos e usados.</p>

<p>A loja de carros na zona norte de SP do Auto Shopping abrange marcas nacionais e importadas de veículos de todos os segmentos e categorias.</p>

<p>Nas ofertas caracterizadas nessa loja de carros na zona norte, podemos citar: sedãs, SUVs, pick-ups, coupés, hatches, dentre outras opções.</p>

<p>Uma loja de carros na zona norte, a exemplo da localizada no Raposo Auto Shopping, garante a mais completa e tradicional gama de carros para satisfazer a todas as exigências e demandas da clientela na capital paulista.</p>

<p>Devido ao fato de estarmos falando de um local grande e especializado no ramo automotivo, a loja de carros na zona norte inclui uma multiplicidade de lojas e produtos diversos para todos os bolsos e gostos.</p>

<p>Em termos práticos, os clientes disporão de uma extensa e diversificada oferta de carros zero, seminovos, usados e motos, tudo em um só local.</p>

<p>Então, dentre os principais diferenciais desse Auto Shopping, está a concentração de todo tipo de oferta de loja de carros na zona norte, o que garante uma experiência muito completa e refinada na busca pela próxima aquisição de veículo.</p>

<p>Todas as possibilidades de escolha de veículo, marca, categoria e procedência poderão ser encontradas diretamente na loja de carros na zona norte e outras opções comerciais do Shopping.</p>

<p>Permita-se conhecer um espaço comercial automotivo a prover tradicionais e exclusivas ofertas de automóveis na capital paulista! Confira!</p>
			<?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>