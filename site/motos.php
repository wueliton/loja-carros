<?php

include "resources/api.php";

$slug = isset($_GET['slug']) ? $_GET['slug'] : null;

$car = api("GET", "motorcycles/" . $slug);

$title = $car['title'];
$description = '';
$keywords = $title . "," . $car['brand']['name'] . "," . $car['model']['name'];

include "includes/head.php";
?>
<main class="container mb-4 adv">
    <div class="row">
        <div class="col-12 mb-4 mt-4">
            <p class="mb-0 pb-0"><?= $car['year'] ?> | <?= toKM($car['km']) ?></p>
            <h1><?= $car['title'] ?></h1>
        </div>
        <div class="col-lg-8 pb-5 pb-lg-0">
            <div class="mb-4 adv-images">
                <div class="image-slides owl-carousel">
                    <?php foreach ($car['images'] as $image): ?>
                        <img src="<?= $apiImagesPath . $image['url'] ?>" title="" class="img-fluid" />
                    <?php endforeach; ?>
                </div>
                <div class="image-slides-thumbs owl-carousel">
                    <?php foreach ($car['images'] as $image): ?>
                        <img src="<?= $apiImagesPath . $image['url'] ?>" title="" class="img-fluid" />
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="contact-card price-card d-flex d-lg-none">
                <div>
                    <h2>
                        <?= $car['brand']['name'] ?> | <?= $car['model']['name'] ?>
                    </h2>
                    <h3 class="price"><?= toBRL($car['price']) ?></h3>
                </div>
                <?php if ($car['store']['whatsapp']): ?>
                    <div>
                        <a href="" class="button whatsapp-btn"><i class="fa-brands fa-whatsapp"></i>
                            Whatsapp</a>
                    </div>
                <?php endif; ?>
                <?= renderStore($car['store'], $url) ?>
            </div>
            <div class="divider"></div>
            <div>
                <h3>Características</h3>
                <div class="row">
                    <?= renderMotorcycleAttributes($car) ?>
                </div>
                <div class="row pt-4">
                    <div class="col-12">
                        <?= renderMotorcycleAttributesTable($car) ?>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div>
                <h3>Itens Opcionais</h3>
                <div class="row">
                    <div class="col-12">
                        <?= renderOptionals($car) ?>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div>
                <h3>Descrição</h3>
                <?= $car['details'] ?>
            </div>
        </div>
        <div class="col-lg-4 store-contacts">
            <div class="contact-card price-card d-none d-lg-flex">
                <div>
                    <h2>
                        <?= $car['brand']['name'] ?> | <?= $car['model']['name'] ?>
                    </h2>
                    <h3 class="price"><?= toBRL($car['price']) ?></h3>
                </div>
                <?php if ($car['store']['whatsapp']): ?>
                    <div>
                        <a href="" class="button whatsapp-btn"><i class="fa-brands fa-whatsapp"></i>
                            Whatsapp</a>
                    </div>
                <?php endif; ?>
                <a href="<?= $url ?>lojas/<?= $car['store']['slug'] ?>" class="store-card p-2">
                    <div class="d-flex gap-4">
                        <div class=""><img src="<?= $apiImagesPath . $car['store']['logo_url'] ?>"
                                title="<?= $car['store']['name'] ?>" width="60" height="60" /></div>
                        <div>
                            <div><strong><?= $car['store']['name'] ?></strong></div>
                            <div>Loja: <?= $car['store']['store_number'] ?></div>
                            <?php if ($car['store']['phone']): ?>
                                <div>Tel: <?= formatPhone($car['store']['phone']) ?></div><?php endif; ?>
                        </div>
                    </div>
                </a>
            </div>

            <div class="contact-card">
                <h4 class="mb-2">Ou solicite um contato de nossos representantes:</h4>
                <?php include "resources/contact-store-form.php"; ?>
            </div>
        </div>
    </div>
</main>
<?php include "includes/footer.php"; ?>
