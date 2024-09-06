<?php
$carrosDestaques = api("GET", "cars/highlights");
?>

<?php if (empty($carrosDestaques) || count($carrosDestaques) <= 0): ?>
    <div><?= count($carrosDestaques) ?></div>
<?php else : ?>
    <div class="cars-hightlights owl-carousel">
        <?php foreach ($carrosDestaques as $carro): ?>
            <div class="item">
                <a href="carros/<?= $carro['id'] ?>">
                    <img src="<?= $apiImagesPath . $carro['single_image'][0]['url'] ?>" alt="<?= $carro['title'] ?>" />
                    <div class="subtitle">
                        <a href="" class="brand-tag"><?= $carro['brand']['name'] ?></a>
                        <h3><?= $carro['title'] ?></h3>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
