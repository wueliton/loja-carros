<?php

include "resources/api.php";

$slug = isset($_GET['slug']) ? $_GET['slug'] : null;

$motorcycle = api("GET", "motorcycles/" . $slug);

$title = $motorcycle['title'];
$description = '';
$keywords = $title . "," . $motorcycle['brand']['name'] . "," . $motorcycle['model']['name'];

include "includes/head-2.php";
?>
<main class="container mb-4 adv">
    <div class="row">
        <div class="col-12 mb-4 mt-4">
            <p class="mb-0 pb-0"><?= $motorcycle['year'] ?> | <?= toKM($motorcycle['km']) ?></p>
            <h1><?= $motorcycle['title'] ?></h1>
        </div>
        <div class="col-lg-8 pb-5 pb-lg-0">
            <?php if (count($motorcycle['images']) > 0): ?>
                <div class="mb-4 adv-images">
                    <div class="image-slides owl-carousel">
                        <?php foreach ($motorcycle['images'] as $image): ?>
                            <img src="<?= $apiImagesPath . $image['url'] ?>" title="" class="img-fluid" />
                        <?php endforeach; ?>
                    </div>
                    <div class="image-slides-thumbs owl-carousel">
                        <?php foreach ($motorcycle['images'] as $image): ?>
                            <img src="<?= $apiImagesPath . $image['url'] ?>" title="" class="img-fluid" />
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="contact-card price-card d-flex d-lg-none">
                    <div>
                        <h2>
                            <?= $motorcycle['brand']['name'] ?> | <?= $motorcycle['model']['name'] ?>
                        </h2>
                        <h3 class="price"><?= toBRL($motorcycle['price']) ?></h3>
                    </div>
                    <?php if ($motorcycle['store']['whatsapp']): ?>
                        <div>
                            <a href="https://api.whatsapp.com/send?phone=55<?= $motorcycle['store']['whatsapp'] ?>&text=Ol%C3%A1,%20tudo%20bem?"
                                class="button whatsapp-btn"><i class="fa-brands fa-whatsapp"></i>
                                Whatsapp</a>
                        </div>
                    <?php endif; ?>
                    <?= renderStore($motorcycle['store'], $url) ?>
                </div>
                <div class="divider"></div>
            <?php endif; ?>
            <div>
                <h3>Características</h3>
                <div class="row">
                    <?= renderMotorcycleAttributes($motorcycle) ?>
                </div>
                <div class="row pt-4">
                    <div class="col-12">
                        <?= renderMotorcycleAttributesTable($motorcycle) ?>
                    </div>
                </div>
            </div>
            <?php if (isset($motorcycle['optionals']) && count($motorcycle['optionals']) > 0): ?>
                <div class="divider"></div>
                <div>
                    <h3>Itens Opcionais</h3>
                    <div class="row">
                        <div class="col-12">
                            <?= renderOptionals($motorcycle) ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($motorcycle['details'])): ?>
                <div class="divider"></div>
                <div>
                    <h3>Descrição</h3>
                    <?= $motorcycle['details'] ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-4 store-contacts">
            <div class="contact-card price-card d-none d-lg-flex">
                <div>
                    <h2>
                        <?= $motorcycle['brand']['name'] ?> | <?= $motorcycle['model']['name'] ?>
                    </h2>
                    <h3 class="price"><?= toBRL($motorcycle['price']) ?></h3>
                </div>
                <?php if ($motorcycle['store']['whatsapp']): ?>
                    <div>
                        <a href="https://api.whatsapp.com/send?phone=55<?= $motorcycle['store']['whatsapp'] ?>&text=Ol%C3%A1,%20tudo%20bem?"
                            class="button whatsapp-btn"><i class="fa-brands fa-whatsapp"></i>
                            Whatsapp</a>
                    </div>
                <?php endif; ?>
                <a href="<?= $url ?>lojas/<?= $motorcycle['store']['slug'] ?>" class="store-card p-2">
                    <div class="d-flex gap-4">
                        <div class=""><img src="<?= $apiImagesPath . $motorcycle['store']['logo_url'] ?>"
                                title="<?= $motorcycle['store']['name'] ?>" width="60" height="60" /></div>
                        <div>
                            <div><strong><?= $motorcycle['store']['name'] ?></strong></div>
                            <div>Loja: <?= $motorcycle['store']['store_number'] ?></div>
                            <?php if ($motorcycle['store']['phone']): ?>
                                <div>Tel: <?= formatPhone($motorcycle['store']['phone']) ?></div><?php endif; ?>
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
