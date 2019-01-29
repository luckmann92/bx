<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult['ITEMS']){
    foreach ($arResult['ITEMS'] as $key => $arItem){
        if($arItem['PREVIEW_PICTURE']['SRC']){
            $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC'] = CFile::ResizeImageGet(
                $arItem['PREVIEW_PICTURE'],
                array(
                    'width' => 1920,
                    'height' => 620
                ), BX_RESIZE_IMAGE_EXACT,
                true, false,false, 90)['src'];
        }
    }
}