<?php

if (!isset($advancedSearchOptions))
    return null;

$brands = $advancedSearchOptions['brands'];
$colors = $advancedSearchOptions['colors'];
$stores = $advancedSearchOptions['stores'];
$optionals = $advancedSearchOptions['motorcycles']['optionals'];
$types = $advancedSearchOptions['motorcycles']['types'];
?>

<form method="post" action="buscar">
    <input type="hidden" name="type" value="motorcycles" />
    <div class="row">
        <div class="col-lg-6">
            <div class="form-field">
                <label for="brand">Marca</label>
                <div class="field">
                    <select name="brand_id" id="brand" onchange="onModelChange()">
                        <option value="">Selecione uma opção</option>
                        <?php foreach ($brands as $brand): ?>
                            <option value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="error"></div>
            </div>
            <div class="form-field">
                <label for="brand_model">Modelo</label>
                <div class="field">
                    <select name="model_id" id="brand_model" disabled>
                        <option value="">Selecione uma opção</option>
                    </select>
                </div>
                <div class="error"></div>
            </div>
            <div class="form-field">
                <label for="version">Versão</label>
                <div class="field">
                    <input name="version" id="version" />
                </div>
                <div class="error"></div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-field">
                        <label for="year_start">De Ano</label>
                        <div class="field">
                            <select name="year_start" id="year_start">
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
                            <select name="year_end" id="year_end">
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
        </div>
        <div class="col-lg-6">
            <div class="form-field">
                <label for="color_id">Cor</label>
                <div class="field">
                    <select name="color_id" id="color_id">
                        <option value="">Selecione uma opção</option>
                        <?php foreach ($colors as $color): ?>
                            <option value="<?= $color['id'] ?>"><?= $color['color'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="error"></div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-field">
                        <label for="min_price">Preço mínimo</label>
                        <div class="field">
                            <select name="min_price" id="min_price">
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
                            <select name="max_price" id="max_price">
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
                <label for="motorcycle_type">Tipo</label>
                <div class="field">
                    <select name="motorcycle_type" id="motorcycle_type">
                        <option value="">Selecione uma opção</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="error"></div>
            </div>
            <div class="form-field">
                <label for="ports">Loja</label>
                <div class="field">
                    <select name="ports" id="ports">
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
                    <label><input type="checkbox" name="optionals" value="<?= $optional['id'] ?>"></input>
                        <span><?= $optional['name'] ?></span></label>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="d-flex justify-content-end gap-4">
            <button type="submit">Buscar</button>
        </div>
    </div>
</form>
