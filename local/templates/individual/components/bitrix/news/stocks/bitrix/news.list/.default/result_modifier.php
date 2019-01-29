<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult['ITEMS']){
    foreach ($arResult['ITEMS'] as $key => $arStock){
         if($arStock['PREVIEW_PICTURE']['SRC']){
            $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC'] = CFile::ResizeImageGet(
                $arStock['PREVIEW_PICTURE'],
                array(
                    'width' => 555,
                    'height' => 300
                ), BX_RESIZE_IMAGE_EXACT,
                true)['src'];
        } else {
            $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC'] = SITE_TEMPLATE_PATH.'/public/images/noPhoto.png';
            $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['ALT'] = 'Изображение отсутствует';
            $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['TITLE'] = 'Изображение отсутствует';
        }
        $arResult['ITEMS'][$key]['DISPLAY_ACTIVE_TO'] = CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arStock["DATE_ACTIVE_TO"], CSite::GetDateFormat()));
    }
}
