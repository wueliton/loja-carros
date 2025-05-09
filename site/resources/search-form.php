<?php
$quickSearchOptions = api("GET", "search/quick/options");
$brands = $quickSearchOptions['brands'];
?>
<div class="search">
    <h4>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="m19.6 21-6.3-6.3A6.096 6.096 0 0 1 9.5 16c-1.817 0-3.354-.63-4.612-1.887C3.629 12.854 3 11.317 3 9.5c0-1.817.63-3.354 1.888-4.612C6.146 3.629 7.683 3 9.5 3c1.817 0 3.354.63 4.613 1.888C15.37 6.146 16 7.683 16 9.5a6.096 6.096 0 0 1-1.3 3.8l6.3 6.3-1.4 1.4ZM9.5 14c1.25 0 2.313-.438 3.188-1.313C13.562 11.813 14 10.75 14 9.5c0-1.25-.438-2.313-1.313-3.188C11.813 5.438 10.75 5 9.5 5c-1.25 0-2.313.438-3.188 1.313S5 8.25 5 9.5c0 1.25.438 2.313 1.313 3.188C7.188 13.562 8.25 14 9.5 14Z" />
        </svg>
        Encontre seu veículo
    </h4>
    <form id="car-form" method="post" action="buscar">
        <div class="btn-toggle">
            <input id="search_type" name="type" value="cars" onchange="onSearchTypeChange()" class="d-none" />
            <button type="button" value="cars" class="active">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M19 9.5h-.32l-1.25-3.12a3 3 0 0 0-2.78-1.88h-6A3 3 0 0 0 5.7 6.91L5.18 9.5H5a3 3 0 0 0-3 3v3a1 1 0 0 0 1 1h1a3 3 0 1 0 6 0h4a3 3 0 0 0 6 0h1a1 1 0 0 0 1-1v-3a3 3 0 0 0-3-3Zm-6-3h1.65a1 1 0 0 1 .92.63l.95 2.37H13v-3Zm-5.34.8a1 1 0 0 1 1-.8H11v3H7.22l.44-2.2ZM7 17.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm10 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm3-3h-.78a3.002 3.002 0 0 0-4.44 0H9.22a3.002 3.002 0 0 0-4.44 0H4v-2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2Z" />
                </svg>
                Carro</button>
            <button type="button" value="motorcycles">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M10.407 4.427c-.333.851.123 1.255 1.419 1.255 1.02 0 1.341.128 1.714.687.603.9.584.985-.215.985-.371 0-1.22.188-1.884.418-1.549.536-3.256.532-4.885-.013-.833-.278-2.035-.401-3.39-.348-2.03.08-2.101.107-2.101.78 0 .677.07.701 2.416.85 3.543.224 5.13 1.156 3.99 2.345-.54.564-.734.609-1.56.36-1.42-.427-2.76-.059-3.87 1.063-2.151 2.177-.77 5.837 2.329 6.17 1.582.17 2.99-.686 3.802-2.31.568-1.136.572-1.138 2.985-1.533l2.416-.394.085-1.6c.07-1.319.196-1.658.711-1.923.344-.177.74-.513.88-.746.2-.335.39-.163.9.807l.645 1.232-.615.65c-.474.5-.616.997-.616 2.155 0 1.37.097 1.602 1.071 2.557.977.958 1.207 1.05 2.625 1.05 4.777 0 5.08-6.789.326-7.314-1.126-.125-1.39-.282-1.898-1.126-.747-1.241-.557-1.408 1.714-1.512 1.759-.08 1.848-.118 1.848-.781 0-.667-.085-.7-1.914-.78-1.052-.045-2.168.052-2.48.215-.508.267-.656.125-1.425-1.37-.473-.918-1.107-1.799-1.41-1.958-.873-.458-3.419-.367-3.613.13Zm1.603 8.052v.944l-1.87.196c-1.03.108-1.948.12-2.042.028-.094-.092.26-.605.789-1.14.765-.774 1.18-.971 2.041-.971 1.04 0 1.082.037 1.082.943Zm-6.236 1.018c.76.4.689.827-.137.827-1.119 0-1.587.296-1.587 1.005 0 .605.12.668 1.279.668 1.41 0 1.61.298.647.96-.908.624-1.849.535-2.65-.25-1.695-1.663.333-4.32 2.448-3.21Zm14.92.396c.383.377.697 1.01.697 1.407 0 .93-1.184 2.09-2.132 2.09-1.45 0-2.61-1.895-1.865-3.05.202-.311.37-.174.753.616.583 1.198 1.075 1.455 1.669.873.386-.38.371-.54-.14-1.522-.69-1.329-.143-1.552 1.017-.414Z"
                        clip-rule="evenodd" />
                </svg>
                Moto
            </button>
        </div>
        <div class="row">
            <div class="col-12">
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
            </div>
            <div class="col-12">
                <div class="form-field">
                    <label for="brand_model">Modelo</label>
                    <div class="field">
                        <select name="model_id" id="brand_model" disabled>
                            <option value="">Selecione uma opção</option>
                            <option>Volkswagen</option>
                        </select>
                    </div>
                    <div class="error"></div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-field">
                    <label for="year_start">De Ano</label>
                    <div class="field">
                        <input type="number" name="year_start" id="year_start" placeholder="2024" />
                    </div>
                    <div class="error"></div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-field">
                    <label for="year_end">Até o Ano</label>
                    <div class="field">
                        <input type="number" name="year_end" id="year_end" placeholder="2024" />
                    </div>
                    <div class="error"></div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-field">
                    <label for="min_price">Preço mínimo</label>
                    <div class="field">
                        <span>R$</span>
                        <input type="number" name="min_price" id="min_price" />
                    </div>
                    <div class="error"></div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-field">
                    <label for="max_price">Preço máximo</label>
                    <div class="field">
                        <span>R$</span>
                        <input type="number" name="max_price" id="max_price" />
                    </div>
                    <div class="error"></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end gap-4">
            <a href="busca-avancada" class="button secondary">Busca Avançada</a>
            <button type="submit">Buscar</button>
        </div>
    </form>
</div>
