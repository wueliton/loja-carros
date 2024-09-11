<?php $highlights = api("GET", "cars/highlights"); ?>
<div>
    <h3>Destaques</h3>
</div>
<?php foreach ($highlights as $highlight): ?>
    <div class="col-lg-3">
        <?php renderAds($highlight, $url, 'carros') ?>
    </div>
<?php endforeach; ?>
<div class="d-flex justify-content-center py-4">
    <a href="" class="button">Visualizar mais destaques</a>
</div>
