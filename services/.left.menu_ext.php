<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections",
	"", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "2",
		"SECTION_PAGE_URL" => "/catalog/#SECTION_CODE_PATH#/",
		"CACHE_TIME" => "3600",
		"IS_SEF" => "Y",
		"DEPTH_LEVEL" => "2",
        "CACHE_TYPE" => "A"
    ),
	false
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>