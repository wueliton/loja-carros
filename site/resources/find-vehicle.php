<?php
// $highlights = api("GET", "cars/highlights?take=6");
$highlights = [];
?>

<section>
    <div class="container py-5">
        <div class="row py-5">
            <div class="d-flex flex-column align-items-center justify-content-center pb-3">
                <h2 class="h2">Encontre seu veículo</h2>
                <p>Novos veículos são cadastrados todos os meses. Não perca a oportunidade de encontrar o seu!</p>
            </div>
            <div class="py-4">
                <div class="search" x-data="search()" x-init="loadBrandOptions()">
                    <div class="actions">
                        <button type="button" x-on:click="changeOption('cars')"
                            :data-active="type === 'cars'">Carros</button>
                        <button type="button" x-on:click="changeOption('motorcycles')"
                            :data-active="type === 'motorcycles'">Motos</button>
                        <a href="#" class="body2">Busca Avançada <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                    <div class="form d-flex flex-column flex-lg-row gap-4">
                        <label class="field">
                            <span>Marca</span>
                            <select name="brand" x-model="brandId" x-on:change="loadBrandModelOptions(type, $event)">
                                <option value="">Todas as Marcas</option>
                                <template x-for="brand in brandOptions">
                                    <option :value="brand.id" x-text="brand.name"></option>
                                </template>
                            </select>
                        </label>
                        <label class="field">
                            <span>Modelo</span>
                            <select name="model" x-model="modelId" :disabled="!brandId">
                                <option value="" x-text="isLoading ? 'Carregando' : 'Todos os Modelos'">Todos os
                                    Modelos
                                </option>
                                <template x-for="model in modelOptions">
                                    <option :value="model.id" x-text="model.name"></option>
                                </template>
                            </select>
                        </label>
                        <label class="field">
                            <span>Ano</span>
                            <select name="year">
                                <option>Todos os Anos</option>
                                <template x-for="year in yearOptions">
                                    <option :value="year" x-text="year"></option>
                                </template>
                            </select>
                        </label>
                        <label class="field">
                            <span>Preço</span>
                            <select name="year">
                                <option>Todos os Preços</option>
                                <template x-for="price in priceOptions">
                                    <option :value="price" x-text="formatPrice(price)"></option>
                                </template>
                            </select>
                        </label>
                        <button class="btn">Mostrar Resultados</button>
                    </div>
                </div>
            </div>
            <?php if (count($highlights) > 0): ?>
                <div class="pt-4">
                    <div class="row">
                        <?php foreach ($highlights as $car): ?>
                            <?php
                            $carImageUrl = $url . 'assets/img/no-image.jpg';
                            if (isset($car['single_image']))
                                $carImageUrl = 'https://www.raposoautoshopping.com.br/admin/storage/uploads/' . $car['single_image']['url'];
                            ?>
                            <div class="col-6 col-lg-4 mb-3">
                                <a href="<?= $url . "carros/" . $car['slug'] ?>" class="product">
                                    <p class="h6"><?= $car['title'] ?></p>
                                    <p class="body-alt"><?= $car['color']['color'] ?> | <?= toKM($car['km']) ?></p>
                                    <img src="<?= $carImageUrl ?>" alt="<?= $car['title'] ?>" loading="lazy">
                                    <p class="h5 text-right"><?= toBRL($car['price']) ?></p>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="py-4 d-flex justify-content-center">
                    <a href="<?= $url ?>carros" class="btn">Visualizar Todos</a>
                </div>
            <?php else: ?>
                <div class="pt-4">
                    <div class="row">
                        <div class="col">
                            <div class="p-3 d-flex align-items-center flex-column gap-1 justify-content-center">
                                <h3 class="h6">Nossos veículos estão sendo cadastrados.</h3>
                                <p>Volte em breve para conferir todas as nossas novidades</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<script>
    const baseUrl = 'https://www.raposoautoshopping.com.br/admin/api';
    const year = new Date().getFullYear();
    const formatPrice = (price) => new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(price);

    const loadBrands = () => {
        return fetch(`${baseUrl}/search/quick/options`).then((res) => res.json());
    }

    const loadBrandModels = (type, brandId) => {
        return fetch(`${baseUrl}/${type}/brand-models?where[and][0][fieldName]=brand_id&where[and][0][value]=${brandId}&where[and][0][comparison]=equals`).then((res) => res.json());
    }

    function search() {
        return {
            isLoading: false,
            type: "cars",
            model: "",
            brand: "",
            year: "",
            price: "",
            brandId: null,
            modelId: null,
            brandOptions: [],
            modelOptions: [],
            yearOptions: Array.from({ length: 30 }, (_, k) => year - k),
            priceOptions: Array.from({ length: 40 }, (_, k) => k > 19 ? (k + 1) / 2 * 10000 : (k + 1) * 5000),
            changeOption(type) {
                this.type = type;
                this.brandId = null;
                this.modelId = null;
            },
            loadBrandModelOptions(type, event) {
                this.isLoading = true;
                const value = event.target.value;
                if (!value) {
                    this.isLoading = false;
                    return
                };
                loadBrandModels(type, value).then((res) => {
                    this.modelOptions = res;
                    this.isLoading = false;
                });
            },
            loadBrandOptions() {
                loadBrands().then((res) => this.brandOptions = res.brands);
            }
        }
    }
</script>
