<?php $latest = api("GET", "cars/latest"); ?>

<?php if (!empty($latest) && count($latest) > 0): ?>
    <section class="container pb-4 pt-5">
        <div class="row">
            <div class="col-lg-8 pb-4 pb-lg-0">
                <?php if (empty($latest) || count($latest) <= 0): ?>
                    <div></div>
                <?php else: ?>
                    <div class="cars-hightlights owl-carousel">
                        <?php foreach ($latest as $carro): ?>
                            <div class="item">
                                <a href="carros/<?= $carro['slug'] ?>">
                                    <img src="<?= is_null($carro['single_image']) ? $url . 'assets/img/logo.png' : $apiImagesPath . $carro['single_image']['url'] ?>"
                                        alt="<?= $carro['title'] ?>" />
                                    <div class="subtitle">
                                        <div class="brand-tag"><?= $carro['brand']['name'] ?></div>
                                        <h3><?= $carro['title'] ?></h3>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>
            <div class="col-lg-4">
                <?php include "search-form.php"; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
