<?php
$title = 'Auto Shopping Raposo'; //20-70 CARATERES
$description = 'Visite o Auto Shopping Raposo, o maior centro automotivo da América, com lojas e serviços para apaixonados por veículos.'; //70 - 160 CARACTERES
$keywords = $title;
include "resources/api.php";
include "includes/head-3.php";
?>
<main>
    <div class="carousel swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="/assets/img/veiculos-novos-semi-novos.jpg"
                    alt="Os melhores veículos novos e semi novos" class="img-fluid"></div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <section class="about">
        <div class="bg-secondary-light">
            <div class="container">
                <div class="row py-5">
                    <div class="col-lg-6 mb-4 mb-lg-0 py-4">
                        <h2 class="mb-4 h2">O maior endereço automotivo da América</h2>
                        <p>Oferecemos um espaço de 100.000m² com variedade de lojas de veículos novos, semi novos e
                            motos. Encontre suas marcas favoritas e aproveite a facilidade de tudo estar em um só
                            lugar.</p>
                    </div>
                    <div class="col-lg-6 position-relative">
                        <div class="side-menu">
                            <a href="" class="d-flex gap-4 justify-content-between align-items-center">
                                <div>
                                    <h3 class="h6">Carros</h3>
                                    <p class="body-alt">Descubra seu próximo carro com segurança e conforto em nosso
                                        autoshopping!</p>
                                </div>
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                            <hr />
                            <a href="" class="d-flex gap-4 justify-content-between align-items-center">
                                <div>
                                    <h3 class="h6">Motos</h3>
                                    <p class="body-alt">Acelere sua busca e realize o sonho de ter a moto ideal!</p>
                                </div>
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                            <hr />
                            <a href="" class="d-flex gap-4 justify-content-between align-items-center">
                                <div>
                                    <h3 class="h6">Lojas</h3>
                                    <p class="body-alt">Explore as opções disponíveis em nossas lojas e encontre o
                                        automóvel que atende às suas necessidades.</p>
                                </div>
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 py-4">
                        <div class="row">
                            <div class="col-4">
                                <h3 class="h4">23+</h3>
                                <p>Lojas cadastradas</p>
                            </div>
                            <div class="col-4">
                                <h3 class="h4">400+</h3>
                                <p>Carros cadastrados</p>
                            </div>
                            <div class="col-4">
                                <h3 class="h4">200+</h3>
                                <p>Motos cadastradas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-third py-5 mt-4">
        <div class="container py-4">
            <div class="d-flex flex-column flex-lg-row justify-content-center gap-5 py-3">
                <div class="icon-section flex-1 d-flex gap-2 align-items-start flex-column">
                    <i class="fa-solid fa-medal"></i>
                    <div>
                        <h3 class="h6 mb-2"> Atendimento ao Cliente</h3>
                        <p class="body-alt">
                            Equipes de vendas bem treinadas e atenciosas que oferecem suporte personalizado.
                        </p>
                    </div>
                </div>
                <div class="icon-section flex-1 d-flex gap-2 align-items-start flex-column">
                    <i class="fa-solid fa-road-circle-check"></i>
                    <div>
                        <h3 class="h6 mb-2">Fácil acesso</h3>
                        <p class="body-alt">
                            Localizado próximo ao Rodoanel e entre as marginais dos rios Pinheiros e Tietê.
                        </p>
                    </div>
                </div>
                <div class="icon-section flex-1 d-flex gap-2 align-items-start flex-column">
                    <div class="icons">
                        <i class="fa-solid fa-car-side"></i>
                        <i class="fa-solid fa-motorcycle"></i>
                    </div>
                    <div>
                        <h3 class="h6 mb-2">Variedade de Opções</h3>
                        <p class="body-alt">
                            Um amplo portfólio de veículos de diferentes marcas, modelos e faixas de preço.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container py-5">
            <div class="row py-5">
                <div class="d-flex flex-column align-items-center justify-content-center pb-3">
                    <h2 class="h2">Encontre seu veículo</h2>
                    <p>Novos veículos são cadastrados todos os meses. Não perca a oportunidade de encontrar o seu!</p>
                </div>
                <div class="py-4">
                    <div class="search">
                        <div class="actions">
                            <button data-active="true">Carros</button>
                            <button>Motos</button>
                            <a href="" class="body2">Busca Avançada <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                        <div class="form d-flex flex-column flex-lg-row gap-4">
                            <label class="field">
                                <span>Marca</span>
                                <select name="brand">
                                    <option>Todas as Marcas</option>
                                </select>
                            </label>
                            <label class="field">
                                <span>Modelo</span>
                                <select name="model">
                                    <option>Todas os Modelos</option>
                                </select>
                            </label>
                            <label class="field">
                                <span>Ano</span>
                                <select name="year">
                                    <option>Todas os Anos</option>
                                </select>
                            </label>
                            <label class="field">
                                <span>Preço</span>
                                <select name="year">
                                    <option>Todas os Preços</option>
                                </select>
                            </label>
                            <button class="btn">Mostrar Resultados</button>
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <div class="row">
                        <div class="col-6 col-lg-4 mb-3">
                            <a href="" class="product">
                                <p class="h6">Renegade 2021</p>
                                <p class="body-alt">Preto | 80.000 km</p>
                                <img src="https://www.raposoautoshopping.com.br/admin/storage/uploads/1725460729_442207.jpg"
                                    alt="Renegade 2021">
                                <p class="h5 text-right">R$ 90.000,00</p>
                            </a>
                        </div>
                        <div class="col-6 col-lg-4 mb-3">
                            <a href="" class="product">
                                <p class="h6">Renegade 2021</p>
                                <p class="body-alt">Preto | 80.000 km</p>
                                <img src="https://www.raposoautoshopping.com.br/admin/storage/uploads/1725460729_442207.jpg"
                                    alt="Renegade 2021">
                                <p class="h5 text-right">R$ 90.000,00</p>
                            </a>
                        </div>
                        <div class="col-6 col-lg-4 mb-3">
                            <a href="" class="product">
                                <p class="h6">Renegade 2021</p>
                                <p class="body-alt">Preto | 80.000 km</p>
                                <img src="https://www.raposoautoshopping.com.br/admin/storage/uploads/1725460729_442207.jpg"
                                    alt="Renegade 2021">
                                <p class="h5 text-right">R$ 90.000,00</p>
                            </a>
                        </div>
                        <div class="col-6 col-lg-4 mb-3">
                            <a href="" class="product">
                                <p class="h6">Renegade 2021</p>
                                <p class="body-alt">Preto | 80.000 km</p>
                                <img src="https://www.raposoautoshopping.com.br/admin/storage/uploads/1725460729_442207.jpg"
                                    alt="Renegade 2021">
                                <p class="h5 text-right">R$ 90.000,00</p>
                            </a>
                        </div>
                        <div class="col-6 col-lg-4 mb-3">
                            <a href="" class="product">
                                <p class="h6">Renegade 2021</p>
                                <p class="body-alt">Preto | 80.000 km</p>
                                <img src="https://www.raposoautoshopping.com.br/admin/storage/uploads/1725460729_442207.jpg"
                                    alt="Renegade 2021">
                                <p class="h5 text-right">R$ 90.000,00</p>
                            </a>
                        </div>
                        <div class="col-6 col-lg-4 mb-3">
                            <a href="" class="product">
                                <p class="h6">Renegade 2021</p>
                                <p class="body-alt">Preto | 80.000 km</p>
                                <img src="https://www.raposoautoshopping.com.br/admin/storage/uploads/1725460729_442207.jpg"
                                    alt="Renegade 2021">
                                <p class="h5 text-right">R$ 90.000,00</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="py-4 d-flex justify-content-center">
                    <a href="" class="btn">Visualizar Todos</a>
                </div>
            </div>
        </div>
    </section>
    <section class="partners py-4">
        <div class="py-5">
            <div class="container text-center pb-5">
                <h2 class="h3">Nossos parceiros</h2>
                <p>Somos mais de 23 lojas, com uma vasta diversidade de veículos</p>
            </div>
            <div class="marquee mb-2">
                <div class="track">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/auto-prime.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/falco.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/arv.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/rejai.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/af-motors.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/phoenix.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/fast-moters.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/dalibor.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/zeus-car.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/rasauto.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/monster-car.png" alt="Auto Prime">
                </div>
            </div>
            <div class="marquee inverse">
                <div class="track">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/auto-prime.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/falco.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/arv.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/rejai.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/af-motors.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/phoenix.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/fast-moters.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/dalibor.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/zeus-car.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/rasauto.png" alt="Auto Prime">
                    <img src="https://www.raposoautoshopping.com.br/assets/img/logos/monster-car.png" alt="Auto Prime">
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container meet-us py-5">
            <div class="row justify-content-md-center">
                <div class="col-lg-6">
                    <h2 class="h3 mb-3">Venha nos fazer uma visita</h2>
                    <p>Aproveite a experiência de ver de perto os veículos, realizar test drives e tirar suas dúvidas em
                        um ambiente acolhedor e descontraído.</p>

                    <div class="d-flex gap-2 flex-column py-5">
                        <div class="link-info">
                            <i class="fa-solid fa-location-dot"></i>
                            <div>
                                <p class="h6">Rodovia Raposo Taveres, KM 18,5</p>
                                <p>São Paulo - SP, 05576-000</p>
                            </div>
                        </div>
                        <div class="link-info">
                            <i class="fa-solid fa-clock"></i>
                            <div>
                                <p class="h6">10H às 19H</p>
                                <p>Segunda a Sexta</p>
                                <p class="h6 mt-3">09H às 20H</p>
                                <p>Sábado</p>
                                <p class="h6 mt-3">10H às 18H</p>
                                <p>Domingo</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1 map ">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.4733753106098!2d-46.79365932456175!3d-23.58735017878192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce55208e3217cd%3A0xf4098718d737e8d1!2sAuto%20Shopping%20Raposo!5e0!3m2!1spt-BR!2sbr!4v1728938297112!5m2!1spt-BR!2sbr"
                        width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
    <section class="for-business py-4">
        <img src="./assets/img/raposo-autoshopping.jpg" class="bg-image" alt="Raposo Auto Shopping">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <p class="subtitle mb-2 justify-content-center"><i class="fa-solid fa-store"></i> Lojistas</p>
                    <h2 class="h3 mb-5">Potencialize seu negócio com nosso auto shopping!</h2>
                    <a class="btn">Saiba mais <i class="fa-solid fa-up-right-from-square"></i></a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include "./includes/footer-3.php"; ?>