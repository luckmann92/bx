<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(is_array($arResult['DETAIL_PICTURE'])){
    $arResult['DETAIL_PICTURE']['RESIZE_SRC'] = CFile::ResizeImageGet(
        $arResult['DETAIL_PICTURE'],
        array(
            'width' => 390,
            'height' => 430
        ), BX_RESIZE_IMAGE_EXACT,
        true)['src'];
}