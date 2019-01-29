<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(is_array($arResult)){
    $i = 1;
    foreach ($arResult as $k => $arItem) {
        if ($i > $arParams['MAX_ITEMS']) {
            $arMenu['SUB_ITEMS'][$k] = $arItem;
        } else {
            $arMenu['ITEMS'][$k] = $arItem;
        }
        $i++;
    }
    $arResult = $arMenu;
}

