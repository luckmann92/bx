<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arSizes = array(
    'quad' => array(
        'width' => 260,
        'height' => 275,
    ),
    'vertical' => array(
        'width' => 540,
        'height' => 275,
    ),
    'horizontal' => array(
        'width' => 260,
        'height' => 575,
    )
);

if($arResult['SECTIONS']){
    $index = 1;
    foreach ($arResult['SECTIONS'] as $key => $arSection){
        if($index <= $arParams['MAX_ELEMENTS']){
            if($arSection['UF_SECTION_ON_HOME'] != 0){
                if($index == 3 || $index == 5){
                    $imgSize = $index == 3 ? $arSizes['horizontal'] : $arSizes['vertical'];
                } else {
                    $imgSize = $arSizes['quad'];
                }
                if(is_array($arSection['PICTURE'])){
                    $arResult['SECTIONS'][$key]['PICTURE']['SRC'] = CFile::ResizeImageGet(
                        $arSection['PICTURE'],
                        $imgSize, BX_RESIZE_IMAGE_EXACT,
                        true)['src'];
                } else {
                    $arResult['SECTIONS'][$key]['PICTURE']['SRC'] = SITE_TEMPLATE_PATH.'/public/images/noPhoto.png';
                    $arResult['SECTIONS'][$key]['PICTURE']['ALT'] = 'Изображение отсутствует';
                    $arResult['SECTIONS'][$key]['PICTURE']['TITLE'] = 'Изображение отсутствует';
                }
                $index++;
            } else {
                unset($arResult['SECTIONS'][$key]);
            }
        } else {
            unset($arResult['SECTIONS'][$key]);
        }
    }
}
?>