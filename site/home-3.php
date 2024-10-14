<?php
$title = 'Auto Shopping Raposo'; //20-70 CARATERES
$description = 'Visite o Auto Shopping Raposo, o maior centro automotivo da América, com lojas e serviços para apaixonados por veículos.'; //70 - 160 CARACTERES
$keywords = $title;
include "resources/api.php";
include "includes/head-3.php";
?>
<main>
    <div class="carousel"></div>
    <section class="about">
        <div class="bg-secondary-light">
            <div class="container">
                <div class="row py-5">
                    <div class="col-lg-6 mb-4 mb-lg-0">
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
                                    <p class="body-alt">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Sit, voluptatum!</p>
                                </div>
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                            <hr />
                            <a href="" class="d-flex gap-4 justify-content-between align-items-center">
                                <div>
                                    <h3 class="h6">Motos</h3>
                                    <p class="body-alt">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Sit, voluptatum!</p>
                                </div>
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                            <hr />
                            <a href="" class="d-flex gap-4 justify-content-between align-items-center">
                                <div>
                                    <h3 class="h6">Lojas</h3>
                                    <p class="body-alt">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Sit, voluptatum!</p>
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
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-4">
                                <h3 class="h4">23+</h3>
                                <p>Lojas cadastradas</p>
                            </div>
                            <div class="col-4">
                                <h3 class="h4">400+</h3>
                                <p>Veículos cadastrados</p>
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
    <section class="bg-third mt-4">
        <div class="container py-5">
            <div class="d-flex flex-column flex-lg-row gap-4 py-3">
                <div class="icon-section d-flex gap-2 align-items-start">
                    <i class="fa-solid fa-medal"></i>
                    <div>
                        <h3 class="h6 mb-2">Qualidade</h3>
                        <p class="body-alt">
                            Controle de qualidade de todos os veículos
                        </p>
                    </div>
                </div>
                <div class="icon-section d-flex gap-2 align-items-start">
                    <i class="fa-solid fa-medal"></i>
                    <div>
                        <h3 class="h6 mb-2">Qualidade</h3>
                        <p class="body-alt">
                            Controle de qualidade de todos os veículos
                        </p>
                    </div>
                </div>
                <div class="icon-section d-flex gap-2 align-items-start">
                    <i class="fa-solid fa-medal"></i>
                    <div>
                        <h3 class="h6 mb-2">Qualidade</h3>
                        <p class="body-alt">
                            Controle de qualidade de todos os veículos
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="d-flex flex-column align-items-center justify-content-center pb-3">
                    <h2 class="h2">Encontre seu veículo</h2>
                    <p>Mensalmente são cadastrados novos veículos.</p>
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
            </div>
        </div>
    </section>
</main>
