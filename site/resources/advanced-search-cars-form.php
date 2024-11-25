<?php

if (!isset($advancedSearchOptions))
    return null;

$brands = $advancedSearchOptions['brands'];
$fuelTypes = $advancedSearchOptions['fuelTypes'];
$colors = $advancedSearchOptions['colors'];
$transmissions = $advancedSearchOptions['cars']['transmissions'];
$stores = $advancedSearchOptions['stores'];
$optionals = $advancedSearchOptions['cars']['optionals'];
?>

<form action="buscar" x-data="advancedCarSearch()">
    <input type="hidden" name="type" value="cars" />
    <div class="row">
        <div class="col-lg-6">
            <div class="form-field">
                <label for="car_brand">Marca</label>
                <div class="field">
                    <select name="brand_id" x-model="brandId" x-on:change="loadModels($event)">
                        <option value="">Selecione uma opção</option>
                        <?php foreach ($brands as $brand): ?>
                            <option value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="error"></div>
            </div>
            <div class="form-field">
                <label for="car_brand_model">Modelo</label>
                <div class="field">
                    <select name="model_id" :disabled="!brandId">
                        <option value="" x-text="isLoading ? 'Carregando' : 'Todos os Modelos'">Selecione uma opção
                        </option>
                        <template x-for="model in modelOptions">
                            <option :value="model.id" x-text="model.name"></option>
                        </template>
                    </select>
                </div>
                <div class="error"></div>
            </div>
            <div class="form-field">
                <label for="version">Versão</label>
                <div class="field">
                    <input name="version" />
                </div>
                <div class="error"></div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-field">
                        <label for="year_start">De Ano</label>
                        <div class="field">
                            <select name="year_start">
                                <option value="">Selecione uma opção</option>
                                <?php for ($i = 0; $i <= 40; $i++): ?>
                                    <?php $year = date('Y') - $i; ?>
                                    <option value="<?= $year ?>"><?= $year ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="error"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-field">
                        <label for="year_end">Até o Ano</label>
                        <div class="field">
                            <select name="year_end">
                                <option value="">Selecione uma opção</option>
                                <?php for ($i = 0; $i <= 40; $i++): ?>
                                    <?php $year = date('Y') - $i; ?>
                                    <option value="<?= $year ?>"><?= $year ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-field">
                <label for="fuel_type_id">Combustível</label>
                <div class="field">
                    <select name="fuel_type_id">
                        <option value="">Selecione uma opção</option>
                        <?php foreach ($fuelTypes as $fuelType): ?>
                            <option value="<?= $fuelType['id'] ?>"><?= $fuelType['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="error"></div>
            </div>
            <div class="form-field">
                <label>Final da Placa</label>
                <div class="check-group">
                    <label>
                        <input type="checkbox" name="last_digit[]" value="1,2" /> 1/2
                    </label>
                    <label>
                        <input type="checkbox" name="last_digit[]" value="3,4" /> 3/4
                    </label>
                    <label>
                        <input type="checkbox" name="last_digit[]" value="5,6" /> 5/6
                    </label>
                    <label>
                        <input type="checkbox" name="last_digit[]" value="7,8" /> 7/8
                    </label>
                    <label>
                        <input type="checkbox" name="last_digit[]" value="9,0" /> 9/0
                    </label>
                </div>
                <div class="error"></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-field">
                <label for="color_id">Cor</label>
                <div class="field">
                    <select name="color_id">
                        <option value="">Selecione uma opção</option>
                        <?php foreach ($colors as $color): ?>
                            <option value="<?= $color['id'] ?>"><?= $color['color'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="error"></div>
            </div>
            <div class="form-field">
                <label for="transmission_id">Câmbio</label>
                <div class="field">
                    <select name="transmission_id">
                        <option value="">Selecione uma opção</option>
                        <?php foreach ($transmissions as $transmission): ?>
                            <option value="<?= $transmission['id'] ?>"><?= $transmission['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="error"></div>
            </div>
            <div class="form-field">
                <label for="doors">Nº de Portas</label>
                <div class="field">
                    <select name="doors">
                        <option value="">Selecione uma opção</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <div class="error"></div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-field">
                        <label for="min_price">Preço mínimo</label>
                        <div class="field">
                            <select name="min_price">
                                <option value="">Selecione uma opção</option>
                                <?php for ($i = 1; $i <= 20; $i++): ?>
                                    <?php $price = $i * 5000; ?>
                                    <option value="<?= $price ?>"><?= toBRL($price) ?></option>
                                <?php endfor; ?>
                                <?php for ($i = 2; $i <= 10; $i++): ?>
                                    <?php $price = $i * 100000; ?>
                                    <option value="<?= $price ?>"><?= toBRL($price) ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="error"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-field">
                        <label for="max_price">Preço máximo</label>
                        <div class="field">
                            <select name="max_price">
                                <option value="">Selecione uma opção</option>
                                <?php for ($i = 1; $i <= 20; $i++): ?>
                                    <?php $price = $i * 5000; ?>
                                    <option value="<?= $price ?>"><?= toBRL($price) ?></option>
                                <?php endfor; ?>
                                <?php for ($i = 2; $i <= 10; $i++): ?>
                                    <?php $price = $i * 100000; ?>
                                    <option value="<?= $price ?>"><?= toBRL($price) ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-field">
                <label for="store_id">Loja</label>
                <div class="field">
                    <select name="store_id">
                        <option value="">Selecione uma opção</option>
                        <?php foreach ($stores as $store): ?>
                            <option value="<?= $store['id'] ?>"><?= $store['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="error"></div>
            </div>
        </div>
        <div>
            <h4>Opcionais:</h4>
            <div class="optionals-list">
                <?php foreach ($optionals as $optional): ?>
                    <label><input type="checkbox" name="optionals[]" value="<?= $optional['id'] ?>"></input>
                        <span><?= $optional['name'] ?></span></label>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="d-flex justify-content-end gap-4">
            <button type="submit" class="btn">Buscar</button>
        </div>
    </div>
</form>
<script>
    const baseUrl = 'https://www.raposoautoshopping.com.br/admin/api';
    const loadBrandModels = (brandId) => {
        return fetch(`${baseUrl}/cars/brand-models?where[and][0][fieldName]=brand_id&where[and][0][value]=${brandId}&where[and][0][comparison]=equals`).then((res) => res.json());
    }

    function advancedCarSearch() {
        return {
            brandId: "",
            modelId: "",
            isLoading: false,
            modelOptions: [],
            loadModels(event) {
                this.isLoading = true;
                const value = event.target.value;
                if (!value) {
                    this.isLoading = false;
                    return;
                };
                loadBrandModels(value).then((res) => {
                    this.modelOptions = res;
                    this.isLoading = false;
                })
            }
        }
    }
</script>
