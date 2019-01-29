<?php
/**
 * @author Mikhail Lukmanov <lukmanof92@gmail.com>
 */
/**
 * @var CBitrixComponent         $component
 * @var CMain                    $APPLICATION
 * @var array                    $arParams
 * @var array                    $arResult
 * @var CBitrixComponentTemplate $this
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arSizes = array(
    'FULL' => array(
        'width' => 326,
        'height' => 371
    ),
    'MIN' => array(
        'width' => 98,
        'height' => 98
    ),
    'RECOMMENDED' => array(
        'width' => 255,
        'height' => 260
    )
);

if($arResult['PREVIEW_PICTURE'] || is_array($arResult['PROPERTIES']['PRODUCT_MORE_IMAGES']['VALUE'])) {
    $arResult['MORE_IMAGES'] = array();
    if($arResult['PREVIEW_PICTURE']){
        $arResult['MORE_IMAGES'][] = array(
            'ORIGINAL_SRC' => $arResult['PREVIEW_PICTURE']['SRC'],
            'RESIZE_FULL_SRC' => CFile::ResizeImageGet(
                $arResult['PREVIEW_PICTURE'],
				$arSizes['FULL'], BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
                true)['src'],
            'RESIZE_MIN_SRC' => CFile::ResizeImageGet(
                $arResult['PREVIEW_PICTURE'],
                $arSizes['MIN'], BX_RESIZE_IMAGE_EXACT,
                true)['src'],
            'ALT' => $arResult['PREVIEW_PICTURE']['ALT'] ? $arResult['PREVIEW_PICTURE']['ALT'] : $arResult['NAME'],
            'TITLE' => $arResult['PREVIEW_PICTURE']['TITLE'] ? $arResult['PREVIEW_PICTURE']['TITLE'] : $arResult['NAME'],
        );
    }
    if(is_array($arResult['PROPERTIES']['PRODUCT_MORE_IMAGES']['VALUE'])){
        foreach ($arResult['PROPERTIES']['PRODUCT_MORE_IMAGES']['VALUE'] as $key => $arPicture){
            $arImage = CFile::GetByID($arPicture)->GetNext();
            $arResult['MORE_IMAGES'][] = array(
                'ORIGINAL_SRC' => CFile::GetPath($arPicture),
                'RESIZE_FULL_SRC' => CFile::ResizeImageGet(
                    $arPicture,
                    $arSizes['FULL'], BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
                    true)['src'],
                'RESIZE_MIN_SRC' => CFile::ResizeImageGet(
                    $arPicture,
                    $arSizes['MIN'], BX_RESIZE_IMAGE_EXACT,
                    true)['src'],
                'ALT' => $arImage['DESCRIPTION'] ? $arImage['DESCRIPTION'] : $arResult['NAME'],
                'TITLE' => $arImage['DESCRIPTION'] ? $arImage['DESCRIPTION'] : $arResult['NAME']
            );
        }
    }
} else {
    $arResult['PREVIEW_PICTURE']['SRC'] = SITE_TEMPLATE_PATH.'/public/images/noPhoto.png';
    $arResult['PREVIEW_PICTURE']['ALT'] = GetMessage('NO_PHOTO');
    $arResult['PREVIEW_PICTURE']['TITLE'] = GetMessage('NO_PHOTO');
}
if(is_array($arResult['PROPERTIES']['PRODUCT_RECOMMENDED']['VALUE'])){
    foreach ($arResult['PROPERTIES']['PRODUCT_RECOMMENDED']['VALUE'] as $key => $PRODUCT_ID){
        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_*");
        $arFilter = array(
            'IBLOCK_ID' => $arParams['IBLOCK_ID'] ? $arParams['IBLOCK_ID'] : $arResult['IBLOCK_ID'],
            'ID' => $PRODUCT_ID,
            'ACTIVE' => 'Y'
        );
        $res = CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter, false, array(), $arSelect);
        while ($ar = $res->GetNextElement()){
            $arProduct = $ar->GetFields();
            $arPicture = array();
            if($arProduct['PREVIEW_PICTURE'] > 0){
                $arPicture['SRC'] = CFile::ResizeImageGet(
                    $arProduct['PREVIEW_PICTURE'],
                    $arSizes['RECOMMENDED'], BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
                    true)['src'];
            } else {
                $arPicture['SRC'] = SITE_TEMPLATE_PATH.'/public/images/noPhoto.png';
                $arPicture['ALT'] = GetMessage('NO_PHOTO');
                $arPicture['TITLE'] = GetMessage('NO_PHOTO');
            }
            if($arProduct['IBLOCK_SECTION_ID'] > 0){
                $rsSection = CIBlockSection::GetByID($arProduct['IBLOCK_SECTION_ID']);
                if($arSection = $rsSection->GetNext()){
                    $arProduct['PARENT_SECTION'] = $arSection;
                }
            }
            $arProduct['PREVIEW_PICTURE'] = $arPicture;
            $arProduct['PROPERTIES'] =  $ar->GetProperties();
            $arResult['PROPERTIES']['PRODUCT_RECOMMENDED']['ITEMS'][] = $arProduct;
        }
    }
}

if (intval($arResult['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE']) != 0) {
    $arResult['PROPERTIES']['PRODUCT_PRICE']['VALUE'] = number_format($arResult['PROPERTIES']['PRODUCT_PRICE']['VALUE'], 0, '', ' ');
}

if (intval($arResult['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE']) != 0) {
    $arResult['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE'] = number_format($arResult['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE'], 0, '', ' ');
}