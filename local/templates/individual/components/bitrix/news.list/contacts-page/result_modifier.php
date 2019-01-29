<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arValues = [];

foreach($arResult["ITEMS"] as $arItem){
    $Yandex = explode(",", $arItem["PROPERTIES"]["C_MAP"]["VALUE"]);
    $arValues['x'][] = $Yandex[0];
    $arValues['y'][] = $Yandex[1];
}
$arResult['COORDINATES']['X'] = array_sum($arValues['x'])/count($arValues['x']);
$arResult['COORDINATES']['Y'] = array_sum($arValues['y'])/count($arValues['y']);