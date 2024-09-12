<?php $highlights = api("GET", "cars/highlights"); ?>
<?php if (isset($highlights) && count($highlights) > 0): ?>
    <div>
        <h3>Destaques</h3>
    </div>
    <?php foreach ($highlights as $highlight): ?>
        <div class="col-lg-3">
            <?php renderAds($highlight, $url, 'carros') ?>
        </div>
    <?php endforeach; ?>
    <div class="d-flex justify-content-center py-4">
        <a href="<?= $url ?>destaques" class="button">Visualizar mais destaques</a>
    </div>
<?php endif ?>
