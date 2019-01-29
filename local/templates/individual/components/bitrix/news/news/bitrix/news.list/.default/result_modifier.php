<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult['ITEMS']){
    foreach ($arResult['ITEMS'] as $key => $arNews){
        if($arNews['PREVIEW_PICTURE']['SRC']){
            $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC'] = CFile::ResizeImageGet(
                $arNews['PREVIEW_PICTURE'],
                array(
                    'width' => 230,
                    'height' => 260
                ), BX_RESIZE_IMAGE_EXACT,
                true)['src'];
        } else {
            $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC'] = SITE_TEMPLATE_PATH.'/public/images/noPhoto.png';
            $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['ALT'] = 'Изображение отсутствует';
            $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['TITLE'] = 'Изображение отсутствует';
        }
    }
}