<?php
ini_set('display_errors', 1);

$pastaEPagina = explode("/", $_SERVER['PHP_SELF']);
$pastaDominio = "";
for ($i = 0; $i < count($pastaEPagina); $i++) {
    if (substr_count($pastaEPagina[$i], ".") == 0) {
        $pastaDominio .= $pastaEPagina[$i] . "/";
    }
}

$url = "http://" . $_SERVER['HTTP_HOST'] . $pastaDominio;

include 'includes/functions.php';

$nomeEmpresa = 'Auto Shopping Raposo';
$slogan = '';
$author = 'https://www.conceitopublicidade.com.br/';
$creditos = 'Conceito Publicidade';
$ramo = 'Auto Shopping Raposo';
$email = 'vendas@raposoautoshopping.com.br';
$tel = '(11) 91371-9497';
$tel2 = 'Troca - Tel';
$tellink = (isset($tel)) ? preg_replace('/\(|\)|\+|\.|-| | /', '', $tel) : '';
$tel2link = (isset($tel2)) ? preg_replace('/\(|\)|\+|\.|-| | /', '', $tel2) : '';
$tel3link = (isset($tel3)) ? preg_replace('/\(|\)|\+|\.|-| | /', '', $tel3) : '';
$whatsapp = '(11) 91371-9497';
$whatsapplink = (isset($whatsapp)) ? "https://api.whatsapp.com/send?1=pr_BR&phone=55" . preg_replace('/\(|\)|\+|\.|-| | /', '', $whatsapp) : '';
$whatsapp2 = '';
$whatsapplink2 = (isset($whatsapp2)) ? "https://api.whatsapp.com/send?1=pr_BR&phone=" . preg_replace('/\(|\)|\+|\.|-| | /', '', $whatsapp2) : '';
$whatsapp3 = '';
$whatsapplink3 = (isset($whatsapp3)) ? "https://api.whatsapp.com/send?1=pr_BR&phone=" . preg_replace('/\(|\)|\+|\.|-| | /', '', $whatsapp3) : '';
$whatsapp4 = '';
$whatsapplink4 = (isset($whatsapp4)) ? "https://api.whatsapp.com/send?1=pr_BR&phone=" . preg_replace('/\(|\)|\+|\.|-| | /', '', $whatsapp4) : '';
$endereco = 'Rodovia Raposo Taveres, KM 18,5';
$bairro = 'Troca - Endereco';
$cidade = 'Troca - Endereco';
$uf = 'Troca - Endereco';
$cep = 'Troca - Endereco';
$horario_s = '';
$horario_sab = '';
$horario_dom = '';

$pastaImg = $url . 'assets/img/';
$logo = $pastaImg . 'logo.png';
$logoCP = $pastaImg . 'conceito.png';
$favicon = $pastaImg . 'favicon2.png';
$caminhoPalavras = $pastaImg . 'palavras-chave/';
// $caminhoThumbs      = $caminhoPalavras.'thumbs/';
$caminhoThumbs = $caminhoPalavras . 'thumbs/';
$card = 'assets/images/card.jpg'; //250x250 pixels
$logoSchema = 'assets/images/card.jpg'; //250x250 pixels

$linkIframeMapa = '';

$conceito = $pastaImg . 'conceito.png';
$googleTransparenci = $pastaImg . 'cadeado.png';
$reposinator = $pastaImg . 'celular.png';

$urlPagina = explode("C:/", $_SERVER['PHP_SELF']);
$urlPagina = end($urlPagina);
$urlPagina = explode("/", $urlPagina);
$urlPagina = end($urlPagina);
$canonical = $url . $urlPagina;
$canonical = str_replace('.php', '', $canonical);
$imagem = str_replace('.php', '.jpg', $urlPagina); //imagem das páginas das palavras-chave
$bannerTopo = str_replace('.jpg', '', $imagem);

if ($_SERVER['HTTP_HOST'] == 'www.onlinepublicidade.com.br' || $_SERVER['HTTP_HOST'] == 'onlinepublicidade.com.br') {
    $infoRobots = "noindex, nofollow";
} else {
    $infoRobots = "index, follow";
}

$title = (isset($title)) ? $title : '';
$title = (isset($title)) ? $title : '';
$description = (isset($description)) ? $description : '';
$keywords = (isset($keywords)) ? $keywords : '';

//redes sociais
$linkface = 'https://www.facebook.com';
$linkinstagram = 'https://www.instagram.com/raposoautoshopping';
$linktwitter = '';
$linkedin = '';
$linkgoogle = '';
$linkYoutube = '';

$perfilface = str_replace("https://www.facebook.com/", "", $linkface);
$perfilface = str_replace("/", "", $perfilface);
$perfilinstagram = str_replace("https://www.instagram.com/", "@", $linkinstagram);
$perfilinstagram = str_replace("/", "", $perfilinstagram);

$linkNavSecurity = 'https://www.google.com/transparencyreport/safebrowsing/diagnostic/?hl=pt-BR#url=' . $canonical;
$linkResponsinator = 'http://www.responsinator.com/?url=' . $canonical;
$linkPageSpeed = 'https://developers.google.com/speed/pagespeed/insights/?url=' . $canonical;

$googleMaps = 'https://maps.app.goo.gl/GbiZyFHE5kioDWmu8';
$geoLatitude = '-23.509731';
$geoLongitude = '-46.550237';

// Quantidade de tags nas páginas
$qntTags = "30";

// Quantidade de thumbs nas páginas
$qntThumbsCarrossel = "30";

// Configurações necessárias para o MENU!!!
$mapaSite = false;
$menuRodape = false;


$menu["loja-automoveis"] = "LOJA DE AUTOMÓVEIS";
$menu["loja-automoveis-sp"] = "LOJA DE AUTOMÓVEIS EM SP";
$menu["loja-automoveis-sao-paulo"] = "LOJA DE AUTOMÓVEIS EM SÃO PAULO";
$menu["loja-automoveis-embu"] = "LOJA DE AUTOMÓVEIS EM EMBU";
$menu["loja-automoveis-barueri"] = "LOJA DE AUTOMÓVEIS EM BARUERI";
$menu["loja-automoveis-butanta"] = "LOJA DE AUTOMÓVEIS NO BUTANTÃ";
$menu["loja-automoveis-alphaville"] = "LOJA DE AUTOMÓVEIS EM ALPHAVILLE";
$menu["loja-automoveis-granja-viana"] = "LOJA DE AUTOMÓVEIS NA GRANJA VIANA";
$menu["loja-automoveis-santana-parnaiba"] = "LOJA DE AUTOMÓVEIS EM SANTANA DE PARNAÍBA";
$menu["loja-veiculos-blindados"] = "LOJA DE VEÍCULOS BLINDADOS";
$menu["loja-automoveis-blindados"] = "LOJA DE AUTOMÓVEIS BLINDADOS";
$menu["agencia-automoveis-blindados"] = "AGÊNCIA DE AUTOMÓVEIS BLINDADOS";
$menu["agencia-carros-importados"] = "AGÊNCIA DE CARROS IMPORTADOS";
$menu["loja-automoveis-osasco"] = "LOJA DE AUTOMÓVEIS EM OSASCO";
$menu["loja-automoveis-zona-norte"] = "LOJA DE AUTOMÓVEIS NA ZONA NORTE";
$menu["loja-automoveis-zona-leste"] = "LOJA DE AUTOMÓVEIS ZONA LESTE";
$menu["loja-automoveis-zona-oeste"] = "LOJA DE AUTOMÓVEIS NA ZONA OESTE";
$menu["loja-automoveis-zona-sul"] = "LOJA DE AUTOMÓVEIS NA ZONA SUL";
$menu["loja-carros-usados-sao-paulo"] = "LOJA DE CARROS USADOS EM SÃO PAULO";
$menu["carros-usados-embu"] = "CARROS USADOS EM EMBU";
$menu["veiculos-usados-sao-paulo"] = "VEÍCULOS USADOS EM SÃO PAULO";
$menu["automoveis-usados-sp"] = "AUTOMÓVEIS USADOS EM SP";
$menu["loja-carros-zona-sul"] = "LOJA DE CARROS NA ZONA SUL";
$menu["loja-carros-zona-norte"] = "LOJA DE CARROS NA ZONA NORTE";
$menu["agencia-veiculos"] = "AGÊNCIA DE VEÍCULOS";
$menu["agencia-veiculos-novos"] = "AGÊNCIA DE VEÍCULOS NOVOS";
$menu["agencia-veiculos-usados"] = "AGÊNCIA DE VEÍCULOS USADOS";
$menu["agencia-veiculos-zona-norte"] = "AGÊNCIA DE VEÍCULOS NA ZONA NORTE";
$menu["agencia-automoveis"] = "AGÊNCIA DE AUTOMÓVEIS";
$menu["agencia-automoveis-zona-sul"] = "AGÊNCIA DE AUTOMÓVEIS NA ZONA SUL";
$menu["agencia-automoveis-zona-oeste"] = "AGÊNCIA DE AUTOMÓVEIS NA ZONA OESTE";
$menu["agencia-automoveis-cotia"] = "AGÊNCIA DE AUTOMÓVEIS EM COTIA";
$menu["comercio-veiculos-sao-paulo"] = "COMÉRCIO DE VEÍCULOS EM SÃO PAULO";
$menu["comercio-automoveis-taboao-serra"] = "COMÉRCIO DE AUTOMÓVEIS EM TABOÃO DA SERRA";
$menu["compra-venda-carros-pinheiros"] = "COMPRA E VENDA DE CARROS EM PINHEIROS";
$menu["compra-venda-automoveis-zona-norte"] = "COMPRA E VENDA DE AUTOMÓVEIS NA ZONA NORTE";
$menu["compra-venda-carros-zona-leste"] = "COMPRA E VENDA DE CARROS NA ZONA LESTE";
$menu["compra-venda-carros-guarulhos"] = "COMPRA E VENDA DE CARROS EM GUARULHOS";
$menu["compra-venda-carros-importados"] = "COMPRA E VENDA DE CARROS IMPORTADOS";
$menu["compra-venda-carros-importados-sao-paulo"] = "COMPRA E VENDA DE CARROS IMPORTADOS EM SÃO PAULO";
$menu["compra-venda-carros-luxo"] = "COMPRA E VENDA DE CARROS DE LUXO";
$menu["compra-venda-carros-luxo-sp"] = "COMPRA E VENDA DE CARROS DE LUXO EM SP";
$menu["comercio-carros-luxo-sao-paulo"] = "COMÉRCIO DE CARROS DE LUXO EM SÃO PAULO";
$menu["compra-venda-veiculos-luxo-sp"] = "COMPRA E VENDA DE VEÍCULOS DE LUXO EM SP";
$menu["comercio-veiculos-luxo-sp"] = "COMÉRCIO DE VEÍCULOS DE LUXO EM SP";
$menu["comercio-automoveis-luxo-sp"] = "COMÉRCIO DE AUTOMÓVEIS DE LUXO EM SP";
$menu["loja-carros-luxo-sp"] = "LOJA DE CARROS DE LUXO EM SP";
$menu["loja-carros-luxo-sao-paulo"] = "LOJA DE CARROS DE LUXO EM SÃO PAULO";
$menu["comercio-veiculos-importados-sp"] = "COMÉRCIO DE VEÍCULOS IMPORTADOS EM SP";
$menu["comercio-automoveis-importados-sp"] = "COMÉRCIO DE AUTOMÓVEIS IMPORTADOS EM SP";
$menu["comercio-carros-importados-sp"] = "COMÉRCIO DE CARROS IMPORTADOS EM SP";
$menu["loja-automoveis-importados-tatuape"] = "LOJA DE AUTOMÓVEIS IMPORTADOS NO TATUAPÉ";
$menu["veiculos-importados-a-venda-sp"] = "VEÍCULOS IMPORTADOS À VENDA EM SP";
$menu["comercio-carros-importados-luxo-sp"] = "COMÉRCIO DE CARROS IMPORTADOS DE LUXO EM SP";
$menu["carros-importados-a-venda-sp"] = "CARROS IMPORTADOS À VENDA EM SP";
$menu["comprar-carros-importados-luxo-sp"] = "COMPRAR CARROS IMPORTADOS DE LUXO EM SP";
$menu["comprar-carros-luxo-sp"] = "COMPRAR CARROS DE LUXO EM SP";
$menu["comercio-carros-usados-sao-paulo"] = "COMÉRCIO DE CARROS USADOS EM SÃO PAULO";
$menu["loja-veiculos-usados-sp"] = "LOJA DE VEÍCULOS USADOS EM SP";
$menu["compra-venda-veiculos-usados-sp"] = "COMPRA E VENDA DE VEÍCULOS USADOS EM SP";
$menu["compra-venda-veiculos-usados-sao-paulo"] = "COMPRA E VENDA DE VEÍCULOS USADOS EM SÃO PAULO";
$menu["onde-comprar-veiculos-importados-sao-paulo"] = "ONDE COMPRAR VEÍCULOS IMPORTADOS EM SÃO PAULO";
$menu["onde-comprar-carros-luxo-sp"] = "ONDE COMPRAR CARROS DE LUXO EM SP";
$menu["loja-automoveis-usados-morumbi"] = "LOJA DE AUTOMÓVEIS USADOS NO MORUMBI";
$menu["loja-autos-usados-zona-sul"] = "LOJA DE AUTOS USADOS NA ZONA SUL";
$menu["multimarcas-sao-paulo"] = "MULTIMARCAS EM SÃO PAULO";
$menu["auto-shopping-guarulhos"] = "AUTO SHOPPING EM GUARULHOS";
$menu["auto-shopping-sao-paulo"] = "AUTO SHOPPING EM SÃO PAULO";
$menu["auto-shopping-sp"] = "AUTO SHOPPING EM SP";
$menu["auto-shopping-raposo-tavares"] = "AUTO SHOPPING NA RAPOSO TAVARES";
$menu["auto-shopping-pinheiros"] = "AUTO SHOPPING EM PINHEIROS";
$menu["melhor-auto-shopping-sao-paulo"] = "MELHOR AUTO SHOPPING DE SÃO PAULO";
$menu["maior-auto-shopping-sao-paulo"] = "MAIOR AUTO SHOPPING DE SÃO PAULO";
$menu["melhor-loja-carros-sao-paulo"] = "MELHOR LOJA DE CARROS EM SÃO PAULO";
$menu["loja-automoveis-importados-zona-sul"] = "LOJA DE AUTOMÓVEIS IMPORTADOS NA ZONA SUL";
$menu["veiculos-importados-luxo-sp"] = "VEÍCULOS IMPORTADOS DE LUXO EM SP";
$menu["agencia-automoveis-importados-sao-paulo"] = "AGÊNCIA DE AUTOMÓVEIS IMPORTADOS EM SÃO PAULO";
$menu["agencia-carros-multimarcas-sao-paulo"] = "AGÊNCIA DE CARROS MULTIMARCAS EM SÃO PAULO";
$menu["compra,-venda-troca-automoveis-sao-paulo"] = "COMPRA, VENDA E TROCA DE AUTOMÓVEIS EM SÃO PAULO";
$menu["venda-carros-usados-sp"] = "VENDA DE CARROS USADOS EM SP";
$menu["venda-carros-usados-zona-sul"] = "VENDA DE CARROS USADOS ZONA SUL";
$menu["venda-carros-usados-tatuape"] = "VENDA DE CARROS USADOS NO TATUAPÉ";
$menu["como-comprar-carro-usado-seguranca"] = "COMO COMPRAR CARRO USADO COM SEGURANÇA";
$menu["comprar-carros-usados-seguranca"] = "COMPRAR CARROS USADOS COM SEGURANÇA";
$menu["melhores-agencias-carros-usados-sao-paulo"] = "MELHORES AGÊNCIAS DE CARROS USADOS DE SÃO PAULO";
$menu["melhores-agencias-carros-importados-sao-paulo"] = "MELHORES AGÊNCIAS DE CARROS IMPORTADOS EM SÃO PAULO";
$menu["veiculos-usados-procedencia-garantia"] = "VEÍCULOS USADOS COM PROCEDÊNCIA E GARANTIA";
$menu["automoveis-usados-sao-paulo"] = "AUTOMÓVEIS USADOS EM SÃO PAULO";
$menu["automoveis-novos-sao-paulo"] = "AUTOMÓVEIS NOVOS EM SÃO PAULO";
$menu["onde-comprar-carros-usados-sao-paulo"] = "ONDE COMPRAR CARROS USADOS EM SÃO PAULO";
$menu["o-e-um-autoshopping"] = "O QUE É UM AUTOSHOPPING";
$menu["por-comprar-carro-autoshopping"] = "POR QUE COMPRAR CARRO EM AUTOSHOPPING";
$menu["vantagens-comprar-automovel-autoshopping"] = "VANTAGENS DE COMPRAR AUTOMÓVEL EM AUTOSHOPPING";
$menu["venda-toyota-sao-paulo"] = "VENDA DE TOYOTA EM SÃO PAULO";
$menu["venda-honda-sao-paulo"] = "VENDA DE HONDA EM SÃO PAULO";
$menu["venda-hyundai-sao-paulo"] = "VENDA DE HYUNDAI EM SÃO PAULO";
$menu["toyota-seminovo-sao-paulo"] = "TOYOTA SEMINOVO EM SÃO PAULO";
$menu["onde-comprar-toyota-usado-sao-paulo"] = "ONDE COMPRAR TOYOTA USADO EM SÃO PAULO";
$menu["veiculos-seminovos-volkswagen"] = "VEÍCULOS SEMINOVOS VOLKSWAGEN";
$menu["veiculos-seminovos-fiat"] = "VEÍCULOS SEMINOVOS FIAT";
$menu["veiculos-seminovos-gm"] = "VEÍCULOS SEMINOVOS GM";
$menu["veiculos-seminovos-hyundai"] = "VEÍCULOS SEMINOVOS HYUNDAI";
$menu["veiculos-seminovos-toyota"] = "VEÍCULOS SEMINOVOS TOYOTA";
$menu["veiculos-seminovos-jeep"] = "VEÍCULOS SEMINOVOS JEEP";
$menu["veiculos-seminovos-renault"] = "VEÍCULOS SEMINOVOS RENAULT";
$menu["veiculos-seminovos-honda"] = "VEÍCULOS SEMINOVOS HONDA";
$menu["veiculos-seminovos-nissan"] = "VEÍCULOS SEMINOVOS NISSAN";
$menu["veiculos-seminovos-peugeot"] = "VEÍCULOS SEMINOVOS PEUGEOT";
$menu["veiculos-seminovos-citroen"] = "VEÍCULOS SEMINOVOS CITROEN";
$menu["veiculos-seminovos-caoa-chery"] = "VEÍCULOS SEMINOVOS CAOA CHERY";
$menu["veiculos-seminovos-bmw"] = "VEÍCULOS SEMINOVOS BMW";
$menu["veiculos-seminovos-byd"] = "VEÍCULOS SEMINOVOS BYD";
$menu["veiculos-seminovos-gwm"] = "VEÍCULOS SEMINOVOS GWM";
$menu["veiculos-seminovos-volvo"] = "VEÍCULOS SEMINOVOS VOLVO";
$menu["veiculos-seminovos-audi"] = "VEÍCULOS SEMINOVOS AUDI";
$menu["veiculos-seminovos-mitsubishi"] = "VEÍCULOS SEMINOVOS MITSUBISHI";
$menu["veiculos-seminovos-porsche"] = "VEÍCULOS SEMINOVOS PORSCHE";
$menu["veiculos-seminovos-land-rover"] = "VEÍCULOS SEMINOVOS LAND ROVER";
