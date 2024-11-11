<?php

function include_image(string $imageName, string $alt)
{
    global $url;

    $imageSplittedExtesion = explode(".", $imageName);
    $name = $imageSplittedExtesion[0];
    $extension = $imageSplittedExtesion[1];
    $mobileSizes = [320, 480, 768];
    $desktopSizes = [1024, 1920];

    $mobilePath = $url . "assets/img/banners/mobile/images/";
    $desktopPath = $url . "assets/img/banners/images/";

    function generatePath(string $size, string $name, string $path, string $extension)
    {
        return $path . $name . "-" . $size . "." . $extension . " " . $size . "w";
    }

    $mobileImages = array_map(function (string $size) use ($name, $mobilePath, $extension) {
        return generatePath($size, $name, $mobilePath, $extension);
    }, $mobileSizes);
    $desktopImages = array_map(function (string $size) use ($desktopPath, $name, $extension) {
        return generatePath($size, $name, $desktopPath, $extension);
    }, $desktopSizes);

    $mobileWebpImages = array_map(function (string $size) use ($name, $mobilePath) {
        return "<source media=\"(max-width: " . $size . "px)\" type=\"image/webp\" srcset=\"" . generatePath($size, $name, $mobilePath . "webp/", "webp") . "\" />";
    }, $mobileSizes);
    $desktopWebpImages = array_map(function (string $size) use ($desktopPath, $name) {
        return "<source media=\"(max-width: " . $size . "px)\" type=\"image/webp\" srcset=\"" . generatePath($size, $name, $desktopPath . "webp/", "webp") . "\" />";
    }, $desktopSizes);

    $imageSizes = implode(", ", array_merge($mobileImages, $desktopImages));
    $imageWebpSizes = implode("", array_merge($mobileWebpImages, $desktopWebpImages));


    ?>
    <picture>
        <?= $imageWebpSizes ?>
        <img src="<?= $url ?>assets/img/banners/<?= $imageName ?>" srcset="<?= $imageSizes ?>"
            class="img-fluid object-cover" alt="<?= $alt ?>" height="500" width="480" loading="eager" />
    </picture>
    <?php
}
?>
<div class="carousel">
    <?= include_image("veiculos-novos-semi-novos.jpg", "Os melhores veículos novos e semi novos") ?>
</div>
