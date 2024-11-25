<?php

include "resources/api.php";

$slug = isset($_GET['slug']) ? $_GET['slug'] : null;

$car = api("GET", "cars/" . $slug);

$title = $car['title'];
$description = '';
$keywords = $title . "," . $car['brand']['name'] . "," . $car['model']['name'];

include "includes/head.php";
?>
<section class="bg-third py-3 breadcrumb">
    <div class="container py-4">
        <div class="d-flex gap-1 pb-2 align-items-center">
            <a href="<?= $url ?>">Home</a>
            <i class="fa-solid fa-chevron-right"></i>
            <a href="<?= $url ?>lojas">Lojas</a>
            <i class="fa-solid fa-chevron-right"></i>
            <a href="<?= $url ?>lojas/<?= $car['store']['slug'] ?>"><?= $car['store']['name'] ?></a>
        </div>
        <h1 class="h2"><?= $title ?></h1>
    </div>
</section>
<main class="container mb-4 pt-4 adv">
    <div class="row">
        <div class="col-lg-8 pb-5 pb-lg-0">
            <?php if (count($car['images']) > 0): ?>
                <div class="mb-4 adv-images">
                    <div class="swiper mySwiper2 mb-2">
                        <div class="swiper-wrapper">
                            <?php foreach ($car['images'] as $image): ?>
                                <div class="swiper-slide">
                                    <img src="<?= $apiImagesPath . $image['url'] ?>" title="" class="img-fluid" />
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($car['images'] as $image): ?>
                                <div class="swiper-slide">
                                    <img src="<?= $apiImagesPath . $image['url'] ?>" title="" class="img-fluid" />
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="contact-card d-flex d-lg-none flex-column">
                    <div>
                        <h2 class="mb-2">
                            <?= $car['brand']['name'] ?> | <?= $car['model']['name'] ?>
                            <?php if ($car['version']): ?>         <?= $car['version'] ?>     <?php endif; ?>
                        </h2>
                        <h3 class="h4 mb-4"><?= toBRL($car['price']) ?></h3>
                    </div>
                    <?php if ($car['store']['whatsapp']): ?>
                        <div class="mb-2">
                            <a href="https://api.whatsapp.com/send?phone=55<?= $car['store']['whatsapp'] ?>&text=Ol%C3%A1,%20tudo%20bem?"
                                class="button whatsapp-btn"><i class="fa-brands fa-whatsapp"></i>
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
                <div class="divider"></div>
            <?php endif; ?>
            <div>
                <h3 class="h3 mb-2">Características</h3>
                <div class="row">
                    <?= renderCarAttributes($car) ?>
                </div>
                <div class="row pt-4">
                    <div class="col-12">
                        <?= renderCarAttributesTable($car) ?>
                    </div>
                </div>
            </div>
            <?php if (isset($car['optionals']) && count($car['optionals']) > 0): ?>
                <div class="divider"></div>
                <div>
                    <h3 class="h3 mb-2">Itens Opcionais</h3>
                    <div class="row">
                        <div class="col-12">
                            <?= renderOptionals($car) ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($car['details'])): ?>
                <div class="divider"></div>
                <div>
                    <h3 class="h3 mb-2">Descrição</h3>
                    <?= $car['details'] ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-4 store-contacts">
            <div class="contact-card d-none d-lg-flex flex-column">
                <div>
                    <h2 class="mb-2">
                        <?= $car['brand']['name'] ?> | <?= $car['model']['name'] ?>
                        <?php if ($car['version']): ?>     <?= $car['version'] ?><?php endif; ?>
                    </h2>
                    <h3 class="h4 mb-4"><?= toBRL($car['price']) ?></h3>
                </div>
                <?php if ($car['store']['whatsapp']): ?>
                    <div class="mb-2">
                        <a href="https://api.whatsapp.com/send?phone=55<?= $car['store']['whatsapp'] ?>&text=Ol%C3%A1,%20tudo%20bem?"
                            class="button whatsapp-btn"><i class="fa-brands fa-whatsapp"></i>
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
                <h4 class="h6 mb-2">Ou solicite um contato de nossos representantes:</h4>
                <?php include "resources/contact-store-form.php"; ?>
            </div>
        </div>
    </div>
</main>
<script src="<?= $url ?>assets/js/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 'auto',
        freeMode: true,
        watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
        loop: true,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiper,
        },
    });
</script>

<?php include "includes/footer.php"; ?>