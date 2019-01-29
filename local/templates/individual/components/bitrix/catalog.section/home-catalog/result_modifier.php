<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

if($arResult['ITEMS']){
    $resizeType = $arParams['IMAGE_TYPE'] == '2' ? BX_RESIZE_IMAGE_EXACT : BX_RESIZE_IMAGE_PROPORTIONAL_ALT;
    $index = 1;
    foreach ($arResult['ITEMS'] as $key => $arProduct){
        if($arProduct['PREVIEW_PICTURE']){
            $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC'] = CFile::ResizeImageGet(
                $arProduct['PREVIEW_PICTURE'],
                array(
                    'width' => 255,
                    'height' => 260
                ), $resizeType,
                true)['src'];
        } else {
            $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC'] = SITE_TEMPLATE_PATH.'/public/images/noPhoto.png';
            $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['ALT'] = 'Изображение отсутствует';
            $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['TITLE'] = 'Изображение отсутствует';
        }
        if($arProduct['IBLOCK_SECTION_ID'] > 0){
            $arResult['ITEMS'][$key]['PARENT_SECTION'] = CIBlockSection::GetByID($arProduct['IBLOCK_SECTION_ID'])->GetNext();
        }
        if ($arProduct['PROPERTIES']['PRODUCT_LABEL']['VALUE_XML_ID']) {
            $arResult['ITEMS'][$key]['PRODUCT_LABEL'] = 'label__' . $arProduct['PROPERTIES']['PRODUCT_LABEL']['VALUE_XML_ID'];
        }

        $index++;
    }
}