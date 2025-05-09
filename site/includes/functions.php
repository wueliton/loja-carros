<?php

//Trata Letras Removendo acentos
function tratar_letras($string)
{
    $conversao = array('á' => 'a',
     'à' => 'a',
     'ã' => 'a',
     'â' => 'a',
     'é' => 'e',
     'ê' => 'e',
     'í' => 'i',
     'ï' => 'i',
     'ó' => 'o',
     'ô' => 'o',
     'õ' => 'o',
     "ö" => "o",
     'ú' => 'u',
     'ü' => 'u',
     'ç' => 'c',
     'ñ' => 'n',
     'Á' => 'A',
     'À' => 'A',
     'Ã' => 'A',
     'Â' => 'A',
     'É' => 'E',
     'Ê' => 'E',
     'Í' => 'I',
     'Ï' => 'I',
     "Ö" => "O",
     'Ó' => 'O',
     'Ô' => 'O',
     'Õ' => 'O',
     'Ú' => 'U',
     'Ü' => 'U',
     'Ç' => 'C',
     'N' => 'Ñ',
     'ý' => 'y',
     'ÿ' => 'y',
     'Ý' => 'Y'
 );
    foreach($conversao as $key=>$value)
    {
        $string=str_replace($key,$value,$string);
    }
    return $string;
}

## Arquivos Inline - CSS e JS
function arquivos_inline($arquivo) {
    if (file_exists($arquivo)) {
        $extensaoArquivo = explode('.', $arquivo);
        $extensaoArquivo = end($extensaoArquivo);
        $extensaoArquivo = strtolower($extensaoArquivo);
        if ($extensaoArquivo == "css") {
            $retornaCodigo = file_get_contents($arquivo);
            $retornaCodigo = str_replace(array("\n","\r","\t","\n\t"), "", $retornaCodigo);
            $retornaCodigo = str_replace(": ", ":", $retornaCodigo);
            $retornaCodigo = str_replace(", ", ",", $retornaCodigo);
            $retornaCodigo = str_replace("; ", ";", $retornaCodigo);
            $retornaCodigo = str_replace(";   ", ";", $retornaCodigo);
            $retornaCodigo = str_replace("{ ", "{", $retornaCodigo);
            $retornaCodigo = str_replace(" {", "{", $retornaCodigo);
            $retornaCodigo = str_replace(" { ", "{", $retornaCodigo);
            $retornaCodigo = str_replace("   {", "{", $retornaCodigo);
            $retornaCodigo = str_replace("} ", "}", $retornaCodigo);
            $retornaCodigo = str_replace(" }", "}", $retornaCodigo);
            $retornaCodigo = str_replace(" } ", "}", $retornaCodigo);
            $expressaoCSS = '!/\*[^*]*\*+([^/][^*]*\*+)*/!';
            $retornaCodigo = preg_replace($expressaoCSS, '', $retornaCodigo);
            return $retornaCodigo;
        } elseif ($extensaoArquivo == "js") {
            $retornaCodigo = file_get_contents($arquivo);
            $retornaCodigo = str_replace(array("\n","\t","\r","\n\t"), '', $retornaCodigo);
            $expressaoJS = '/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\')\/\/.*))/';
            $retornaCodigo = preg_replace($expressaoJS, '', $retornaCodigo);

            return $retornaCodigo;
        }
    }
}

## Mostrar Tags Randômicas nas Palavras-Chave
function montarTags($menu,$qntTags = 30) {
    global $url;
    $retorno="";
    $mostrarTags=array_rand($menu,$qntTags);
    if(isset($mostrarTags) && count($mostrarTags)>0){
        foreach($mostrarTags as $linkPagina)
        {
            $palavraChave=$menu[$linkPagina];
            $retorno.='<li><a href="'.$url.$linkPagina.'" title="'.$palavraChave.'">'.$palavraChave.'</a></li>';

        }
        return $retorno;
    }
}
## Mostrar Menu das Palavras-Chave
function montarMenu($menu) {
    global $url;
    $retorno="";
    $mostrarMenu=array_rand($menu,count($menu));
    if(isset($mostrarMenu) && count($mostrarMenu)>0){
        foreach($mostrarMenu as $linkPagina)
        {
            $palavraChave=$menu[$linkPagina];
            $retorno.='<li><a href="'.$url.$linkPagina.'" title="'.$palavraChave.'">'.ucfirst(mb_strtolower($palavraChave,'UTF-8')).'</a></li>';
        }
        return $retorno;
    }
}

## Mostrar Thumbs Randômicos no Palavras-Chave
function mostrarCarrossel($menu,$qntThumbsCarrossel = 20) {
    global $url;
    global $caminhoThumbs;
    $retorno="";
    $mostrarThumbsCarrossel=array_rand($menu,$qntThumbsCarrossel);
    if(isset($mostrarThumbsCarrossel) && count($mostrarThumbsCarrossel)>0){
        foreach($mostrarThumbsCarrossel as $linkPagina)
        {
            $palavraChave=$menu[$linkPagina];
            $retorno.='<div class="item">';
            $retorno.='<p><a href="'.$url.$linkPagina.'" title="'.$palavraChave.'"><img class="imgthumbs" src="'.$caminhoThumbs.$linkPagina.'.jpg" alt="'.$palavraChave.'" title="'.$palavraChave.'" /></a></p>';
            $retorno.='<h5><a href="'.$url.$linkPagina.'" class="lateral" title="'.$palavraChave.'">'.$palavraChave.'</a></h5>';
            $retorno.='</div>';
        }
        return $retorno;
    }
}


## Ordenar Array (Sem Levar em Consideração Maiusculos e minusculos)
function acasesort($array,$array2=array("vazia"))
{
    foreach($array as $itemKey=>$itemValue){
        $itemValue=tratar_letras($itemValue);
        $arrayLower[$itemKey]=mb_strtolower($itemValue,'UTF-8');
    }
    asort($arrayLower);
    if(isset($array2[0]) && $array2[0]=="vazia"){
        foreach($arrayLower as $arrayLowerItemKey=>$arrayLowerItemValue){
            $arrayLower[$arrayLowerItemKey]=$array[$arrayLowerItemKey];
        }
        return $arrayLower;
    }else if(isset($array2) && count($array2)>0){
        $arrayNova=array();
        foreach($arrayLower as $arrayLowerItemKey=>$arrayLowerItemValue){
            if(in_array($arrayLowerItemKey,$array2)){
                array_push($arrayNova,$arrayLowerItemKey);
            }
        }
        if(isset($arrayNova) && count($arrayNova)>0){
            return $arrayNova;
        }else{
            return asort($array2);
        }
    }
}


## Verificação de Existência das Páginas
function keysExist(){
    global $url;
    global $menu;
    $i       = 0;
    $qtdMenu = count($menu);
    foreach ($menu as $key => $value){
        if(!file_exists($key.'.php') && !file_exists($key)){
            $i++;
        }
    }
    if($i == $qtdMenu){
        return false;
    }
    else{ return true; }
}

function minimizeCSSsimple($files){
    $url = $GLOBALS['url'];

    $str=file_get_contents($files);
    $str = str_replace("\n", "", $str);
    $str = preg_replace("/([0-9]*px(?!;))/", "$1 ", $str);
    $str = preg_replace('/\\s\\s+/', ' ', $str);
    $str = preg_replace("@assets/@", "{$url}assets/", $str);
    return $str;
}

function sanitize_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );

    $replace = array(
        '>',
        '<',
        '\\1',
        '',
    );

    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}
?>
