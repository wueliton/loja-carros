﻿<?php
$title        = 'LOJA DE AUTOMÓVEIS NA ZONA SUL';
$description  = 'Se você está buscando por uma loja de automóveis na zona sul de São Paulo com uma vasta oferta de veículos de todos os segmentos, o Raposo Auto Shopping é um dos locais mais completos em venda automotiva na Região Metropolitana de';
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
			<p>Se você está buscando por uma loja de automóveis na zona sul de São Paulo com uma vasta oferta de veículos de todos os segmentos, o Raposo Auto Shopping é um dos locais mais completos em venda automotiva na Região Metropolitana de São Paulo.</p>

<p>Tendo mais de 100 mil metros quadrados de área, situado perto do Rodoanel e entre as marginais do rio Tietê e Pinheiros, o Raposo Auto Shopping é atualmente uma das principais referência em comércio automotivo, abrangendo carros novos, seminovos e usados.</p>

<p>Poder visitar variadas loja de automóveis na zona sul, dentro do complexo comerciais desse Auto Shopping, certamente trará grandes perspectivas a partir das ofertas apresentadas ao público.</p>

<p>Na loja de automóveis na zona sul, há modelos nacionais e importados, blindados, de diversos segmentos e categorias.</p>

<p>Por exemplo, na loja de automóveis na zona sul há modelos de SUVs, pick-ups, sedãs, coupés, dentre outras opções para atender a todos os gostos e preferências.</p>

<h2><strong>Tradição e exclusividade no Raposo Auto Shopping</strong></h2>

<p>O Raposo Auto Shopping inclui as mais exclusivas e tradicionais ofertas de automóveis nacionais e importados.</p>

<p>Poder encontrar um ambiente específico desse ramo, a exemplo da loja de automóveis na zona sul, onde estão reunidos veículos de todas as marcas e procedências, os benefícios estarão garantidos, como economia de tempo, conveniência, preços competitivos, etc.</p>

<p>Seja para comprar um carro novo ou usado, nacional ou importado, compacto ou grande, na loja de automóveis na zona sul, o cliente encontrará o seu carro ideal.</p>

<p>Portanto, por que buscar o seu próximo veículo em uma só loja se você pode encontrar nessa loja de automóveis na zona sul, um Shopping especializado no ramo automotivo?</p>

<p>Venha explorar inúmeras possibilidades de descobrir uma singular oferta de veículos diretamente com quem é referência no segmento!</p>
			<?php
			include 'includes/carrossel.php';
			include 'includes/tags.php';
			include "includes/regioes.php";
			?>
		</article>
	</div>
</main>
<?php include 'includes/footer.php'; ?>