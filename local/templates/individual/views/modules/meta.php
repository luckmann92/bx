<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

\Bitrix\Main\Page\Asset::getInstance()->addCss($APPLICATION->GetTemplatePath("public/css/main.css"));
\Bitrix\Main\Page\Asset::getInstance()->addCss($APPLICATION->GetTemplatePath("public/css/custom.css"));

//Установка цветовой схемы

if(is_array($_SESSION['SETTING']['COLORS'])){
    foreach ($_SESSION['SETTING']['COLORS'] as $TYPE => $CODE){
        if($CODE != 'default'){
            if(!file_exists($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/public/css/theme/'.$TYPE.'_'.$CODE.'.css')){
                CWebsiteTemplate::CreateColorTheme($TYPE, $CODE);
            }
            \Bitrix\Main\Page\Asset::getInstance()->addCss($APPLICATION->GetTemplatePath("public/css/theme/".$TYPE."_".$CODE.".css"));
        }
    }
}

//Подключение шрифтов
if($_SESSION['SETTING']['FONTS']){
    foreach ($_SESSION['SETTING']['FONTS'] as $k => $arFont){
        if(str_replace('+', ' ', $arFont) != 'Geometria (По умолчанию)') {
            $w = $k == 'TITLE' ? '700' : '400';
            \Bitrix\Main\Page\Asset::getInstance()->addCss('https://fonts.googleapis.com/css?family=' . $arFont . ':' . $w);
        }
    }
}
?>

<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="UTF-8">
