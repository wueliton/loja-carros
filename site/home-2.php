<?php
$title = 'Auto Shopping Raposo'; //20-70 CARATERES
$description = 'Visite o Auto Shopping Raposo, o maior centro automotivo da América, com lojas e serviços para apaixonados por veículos.'; //70 - 160 CARACTERES
$keywords = $title;
include "resources/api.php";
include "includes/head-2.php";
?>

<section class="section-video">
    <div class="container">
        <video poster="assets/img/video-home.jpg" autoplay loop muted>
            <source src="assets/img/video-home.MP4" type="video/mp4">Your browser does not support the video tag.
        </video>
    </div>
</section>

<?php include "./resources/latest.php"; ?>

<section class="container">
    <div class="row">
        <?php include "./resources/highlights.php"; ?>
    </div>
</section>

<section class="section-about">
    <div class="container">
        <div class="row info">
            <div class="col-12 col-lg-8">
                <h2>Descubra o <strong>maior endereço automotivo da América</strong> </h2>
                <p><strong>Explore o Auto Shopping Raposo, seu destino exclusivo no maior centro automotivo da
                        América.</strong> </p>
                <p>Oferecemos um espaço de 100.000m² com variedade de lojas de veículos novos, semi novos e motos.
                    Encontre suas marcas favoritas e aproveite a facilidade de tudo estar em um só lugar.</p>
                <p>Entregamos praticidade e diversidade de serviços. Venha viver a paixão por automóveis no Raposo Auto
                    Shopping, onde cada visita é uma experiência única!</p>
            </div>
            <div class="col-12 col-lg-4 d-flex">
                <img src="./assets/img/gigantesco.png" alt="<?= $nomeEmpresa; ?>" title="<?= $nomeEmpresa; ?>"
                    class="img-fluid img-gigantesco">
            </div>
        </div>
    </div>
</section>

<a id="como-chegar">
    <section class="section-location">
        <div>
            <img src="./assets/img/localizacao.jpg" alt="<?= $nomeEmpresa; ?>" title="<?= $nomeEmpresa; ?>"
                class="img-fluid img-localizacao">
        </div>
        <div class="container">
            <h2> Rodovia Raposo Tavares, km 18,5 <br> <span>(Em frente ao posto rodoviário)</span> </h2>
            <h3> Descubra seu novo destino em uma das regiões de maior crescimento na Grande São Paulo!</h3>
            <p> Localizado próximo ao Rodoanel e entre as marginais dos rios Pinheiros e Tietê, o Auto Shopping Raposo
                abrange uma extensa área. Com uma variedade de lojas e um completo Centro Automotivo, atrai clientes não
                apenas da cidade de São Paulo e Região Metropolitana, mas também das cidades vizinhas servidas pelas
                rodovias que cruzam o Rodoanel. </p>
        </div>
    </section>
</a>

<section class="section-lojas">
    <div class="container">
        <div class="lojas-title">
            <h2>LOJAS</h2>
            <h3>Aqui tem tudo em um só lugar!</h3>
        </div>
        <div class="owl-carousel owl-carousel-lojas owl-theme">
            <div class="item">
                <h2>Zeus Car Multimarcas</h2>
                <p>(11) 4580-4962</p>
                <p><i class="fa-brands fa-instagram"></i> @_zeuscar</p>
            </div>
            <div class="item">
                <h2>Rasauto Multimarcas</h2>
                <p>(11) 4171-5393</p>
                <p><i class="fa-brands fa-instagram"></i> @rasauto.multimarcas </p>
            </div>
            <div class="item">
                <h2>Monster Car Motors </h2>
                <p>(11) 96174-5004</p>
                <p><i class="fa-brands fa-instagram"></i> @Monstercar.motors</p>
            </div>
            <div class="item">
                <h2>MR multimarcas </h2>
                <p>(11) 98180-4170</p>
                <p><i class="fa-brands fa-instagram"></i> @mrmultimarcas.ar</p>
            </div>
            <div class="item">
                <h2>FC4 multimarcas </h2>
                <p>(11) 91161-2569</p>
                <p><i class="fa-brands fa-instagram"></i> @fc4carmulti</p>
            </div>
            <div class="item">
                <h2>Auto Prime Concept </h2>
                <p>(11) 94781-4173</p>
                <p><i class="fa-brands fa-instagram"></i> @autoprimeconcept</p>
            </div>
            <div class="item">
                <h2>VIP Motors </h2>
                <p>(11) 99309-7933</p>
                <p><i class="fa-brands fa-instagram"></i> @vipmotorsvirtual</p>
            </div>
            <div class="item">
                <h2>HR veículos </h2>
                <p>(11) 94139-2620</p>
                <p><i class="fa-brands fa-instagram"></i> @hrveiculososasco</p>
            </div>
            <div class="item">
                <h2>Auto Porto </h2>
                <p>(11) 96541-5212</p>
                <p><i class="fa-brands fa-instagram"></i> @autoportomultimarcasbarueri</p>
            </div>
            <div class="item">
                <h2>Falco Multimarcas </h2>
                <p>(11) 96116-2626</p>
                <p><i class="fa-brands fa-instagram"></i> @falcomultimarcas</p>
            </div>

            <div class="item">
                <h2>Auto esporte multimarcas</h2>
                <p>(11) 96262-8500</p>
                <p><i class="fa-brands fa-instagram"></i>@autoesportemultimarcas</p>
            </div>
            <div class="item">
                <h2>Select Multimarcas </h2>
                <p>(11) 97190-4739</p>
                <p><i class="fa-brands fa-instagram"></i> @selectmultimarcassp</p>
            </div>
            <div class="item">
                <h2>ARV motors </h2>
                <p>(11) 97623-2611</p>
                <p><i class="fa-brands fa-instagram"></i> @arvmotors</p>
            </div>
            <div class="item">
                <h2>Titan </h2>
                <p>(11) 94050-0303</p>
                <p><i class="fa-brands fa-instagram"></i> @titanmotors10</p>
            </div>

            <div class="item">
                <h2>Office Motors </h2>
                <p>(11) 99401-0574</p>
                <p><i class="fa-brands fa-instagram"></i> @officemotorssp</p>
            </div>

            <div class="item">
                <h2>Lusa Map Motors </h2>
                <p>(11)99508-9339</p>
                <p><i class="fa-brands fa-instagram"></i> @lusamapmotors</p>
            </div>

            <div class="item">
                <h2>Dantas</h2>
                <p>(11)91993-1147</p>
                <p><i class="fa-brands fa-instagram"></i> @dantasautomoveiss</p>
            </div>

            <div class="item">
                <h2>Italians Car</h2>
                <p>(11) 99234-0606</p>
                <p><i class="fa-brands fa-instagram"></i> @italianscaroficial</p>
            </div>

            <div class="item">
                <h2>Italians Car</h2>
                <p>(11) 99234-0606</p>
                <p><i class="fa-brands fa-instagram"></i> @italianscaroficial</p>
            </div>

            <div class="item">
                <h2>DT Car </h2>
                <p>(11) 95040-2944</p>
                <p><i class="fa-brands fa-instagram"></i> @absolutcarraposo</p>
            </div>

            <div class="item">
                <h2>3D veículos </h2>
                <p>(11) 93911-6577</p>
                <p><i class="fa-brands fa-instagram"></i>@veiculos3d </p>
            </div>




        </div>

    </div>

</section>

<section class="section-infra">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7 info-infra">
                <img src="./assets/img/fale-conosco.jpg" alt="" class="img-fluid">

            </div>
            <div class="col-12 col-lg-5 info-form">
                <h2>Ficou com alguma dúvida?</h2>
                <h3> Nos envie agora mesmo uma mensagem!</h3>
                <form id="orcamento-formulary" method="post" action="<?= $url; ?>" class="mt-2">
                    <div class="form-field">
                        <label for="nome">Nome Completo</label>
                        <div class="field">
                            <input name="nome" id="nome" />
                        </div>
                        <div class="error"></div>
                    </div>
                    <div class="form-field">
                        <label for="email">Email</label>
                        <div class="field">
                            <input name="email" id="email" placeholder="exemplo@email.com.br" />
                        </div>
                        <div class="error"></div>
                    </div>
                    <div class="form-field">
                        <label for="telefone">Telefone</label>
                        <div class="field">
                            <input name="telefone" id="telefone" />
                        </div>
                        <div class="error"></div>
                    </div>
                    <div class="form-field">
                        <label for="mensagem">Mensagem</label>
                        <div class="field">
                            <textarea rows="4" name="mensagem" id="mensagem"></textarea>
                        </div>
                        <div class="error"></div>
                    </div>
                    <div id='recaptcha' class="g-recaptcha" data-sitekey="6LdZXBcqAAAAAEp-L0K0bG2jVA8VuBajnwwELjOG"
                        data-callback="sendForm" data-size="invisible"></div>
                    <button>Enviar</button>
                </form>

            </div>


        </div>

    </div>

</section>

<?php include "includes/footer.php"; ?>
