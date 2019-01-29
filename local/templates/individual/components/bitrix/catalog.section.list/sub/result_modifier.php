<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if($arResult['SECTIONS']){
    foreach ($arResult['SECTIONS'] as $key => $arSection){
        if($arSection['PICTURE']){
            $arResult['SECTIONS'][$key]['PICTURE']['SRC'] = CFile::ResizeImageGet(
                $arSection['PICTURE'],
                array(
                    'width' => 253,
                    'height' => 195
                ), BX_RESIZE_IMAGE_EXACT,
                true)['src'];
        } else {
            $arResult['SECTIONS'][$key]['PICTURE']['SRC'] = SITE_TEMPLATE_PATH.'/public/images/noPhoto.png';
            $arResult['SECTIONS'][$key]['PICTURE']['ALT'] = 'Изображение отсутствует';
            $arResult['SECTIONS'][$key]['PICTURE']['TITLE'] = 'Изображение отсутствует';
        }
    }
}