<?php include 'includes/geral.php';

/* Chama a função de verificação */
$arrayMenuStark = $menu;
/* Funcao verifica se as paginas existem */
if (keysExist() == false) {
    /* destrói a variavel menu. */
    unset($menu);
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <!-- Site Desenvolvido por <?php echo $creditos; ?> / <?php echo $author; ?> -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title><?= $title; ?> | <?= $nomeEmpresa; ?></title>
    <meta name="title" content="<?= $title; ?>" />
    <meta name="author" content="<?= $author; ?>" />
    <meta name="description" content="<?= $description; ?>" />
    <meta name="keywords" content="<?= $keywords; ?>" />
    <meta name="robots" content="<?= $infoRobots; ?>" />

    <meta name="geo.region" content="BR-SP" />
    <meta name="geo.position" content="<?= $geoLatitude; ?>;<?= $geoLongitude; ?>" />
    <meta name="ICBM" content="<?= $geoLatitude; ?>, <?= $geoLongitude; ?>" />

    <!-- SEO -->
    <meta name="language" content="pt-br" />
    <meta name="copyright" content="<?= $nomeEmpresa . " " . $slogan ?>" />
    <meta name="distribution" content="global" />
    <meta name="audience" content="all" />
    <meta name="url" content="<?= $canonical; ?>" />
    <meta name="classification" content="<?= $ramo; ?>" />
    <meta name="category" content="<?= $ramo; ?>" />
    <meta name="Page-Topic" content="<?= $title . " - " . $nomeEmpresa; ?>" />
    <meta name="rating" content="general" />
    <meta name="fone" content="<?= $tel; ?>" />
    <meta name="city" content="<?= $cidade; ?>" />
    <meta name="country" content="Brasil" />
    <meta property="publisher" content="<?= $creditos; ?>" />

    <!-- Google -->
    <link rel="canonical" href="<?= $canonical; ?>" />
    <meta name="googlebot" content="<?= $infoRobots; ?>" />
    <meta name="geo.placename" content="Brasil" />
    <meta name="geo.region" content="<?= $cidade; ?>" />
    <meta name="name" content="<?= $nomeEmpresa; ?>" />
    <!--<meta name="description" content="<?= $description; ?>" />-->
    <meta name="image" content="<?= $url . $card; ?>" />

    <!-- Twitter -->
    <meta name="twitter:card" content="<?= $url . $card; ?>" />
    <meta name="twitter:url" content="<?= $canonical; ?>" />
    <meta name="twitter:site" content="<?= $canonical; ?>" />
    <meta name="twitter:title" content="<?= $title . " - " . $nomeEmpresa; ?>" />
    <meta name="twitter:description" content="<?= $description; ?>" />
    <meta name="twitter:image" content="<?= $url . $card; ?>" />

    <!-- Facebook -->
    <meta property="og:title" content="<?= $title . " - " . $nomeEmpresa; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= $canonical; ?>" />
    <meta property="og:site_name" content="<?= $nomeEmpresa; ?>" />
    <meta property="og:author" content="<?= $nomeEmpresa; ?>" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:region" content="Brasil" />
    <meta property="og:image" content="<?= $url . $card; ?>" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:width" content="250" />
    <meta property="og:image:height" content="250" />
    <meta property="og:description" content="<?= $description; ?>" />

    <link rel="icon" href="<?= $url ?>favicon.png" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="<?= $url ?>favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Troca - Link CSS -->
    <style>
        /* latin-ext */
        @font-face {
            font-family: 'Montserrat';
            font-style: italic;
            font-weight: 100 900;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/montserrat/v26/JTUQjIg1_i6t8kCHKm459WxRxy7m0dR9pBOi.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Montserrat';
            font-style: italic;
            font-weight: 100 900;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/montserrat/v26/JTUQjIg1_i6t8kCHKm459WxRyS7m0dR9pA.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 100 900;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/montserrat/v26/JTUSjIg1_i6t8kCHKm459WdhyyTh89ZNpQ.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 100 900;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/montserrat/v26/JTUSjIg1_i6t8kCHKm459WlhyyTh89Y.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
    </style>

    <?php
    $cssFile = minimizeCSSsimple('assets/css/home-3.css');
    echo "<style>" . $cssFile . "</style>";
    ?>
</head>
<?php include("includes/header-3.php"); ?>
