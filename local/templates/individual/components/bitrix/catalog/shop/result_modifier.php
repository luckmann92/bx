<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($_GET["sort"] == "name" || $_GET["sort"] == "property_PRODUCT_PRICE" || $_GET["sort"] == "property_PRODUCT_STATUS"){
    $arParams["ELEMENT_SORT_FIELD"] = $_GET["sort"];
    $arParams["ELEMENT_SORT_ORDER"] = $_GET["order"];
}
if (isset($_GET["list_num"]) && $_GET["list_num"] > 0) {
    $arParams["PAGE_ELEMENT_COUNT"] = $_GET["list_num"];
}


?>