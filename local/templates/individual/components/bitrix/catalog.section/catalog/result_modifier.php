<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

if($arResult['ITEMS']){
    foreach ($arResult['ITEMS'] as $key => $arProduct){
        if($arProduct['PREVIEW_PICTURE']){
            $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC'] = CFile::ResizeImageGet(
                $arProduct['PREVIEW_PICTURE'],
                array(
                    'width' => 255,
                    'height' => 260
                ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
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
    }

    if(is_array($_GET)){
        $arResult['URL'] = $arResult['SECTION_PAGE_URL'].'?';
        $k = 0;
        foreach($_GET as $CODE => $val){
            $arResult['URL'] .= $CODE.'='.$val;
            $k++;
            if(count($_GET) != $k){
                $arResult['URL'] .= '&';
            }
        }
    }
    $arResult['SORT_FIELDS'] = array(
        "property_PRODUCT_PRICE" => "Цене",
        "name" => "Названию",
        "property_PRODUCT_STATUS" => "Наличию"
    );
}
if($arResult['ID']){
    $arResult['DESCRIPTION'] = CIBlockSection::GetByID($arResult['ID'])->GetNext()['DESCRIPTION'];
}
$arResult['SECTIONS'] = $APPLICATION->GetViewContent('countSubCats');
