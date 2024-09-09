<?php
$carrosDestaques = api("GET", "cars/highlights");
?>

<?php if (empty($carrosDestaques) || count($carrosDestaques) <= 0): ?>
    <div><?= count($carrosDestaques) ?></div>
<?php else: ?>
    <div class="cars-hightlights owl-carousel">
        <?php foreach ($carrosDestaques as $carro): ?>
            <div class="item">
                <a href="carros/<?= $carro['slug'] ?>">
                    <img src="<?= $apiImagesPath . $carro['single_image']['url'] ?>" alt="<?= $carro['title'] ?>" />
                    <div class="subtitle">
                        <div class="brand-tag"><?= $carro['brand']['name'] ?></div>
                        <h3><?= $carro['title'] ?></h3>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
