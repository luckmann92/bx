<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(array("-" => " "));
$arIBlocks = array();

$db_iblock = CIBlock::GetList(array("SORT" => "ASC"), array("SITE_ID" => $_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"] != "-" ? $arCurrentValues["IBLOCK_TYPE"] : "")));
while($arRes = $db_iblock->Fetch()) {
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];
}
if($arCurrentValues['IBLOCK_ID'] > 0){
    $arIBlockProps = array();
    $res = CIBlock::GetProperties($arCurrentValues['IBLOCK_ID']);
    while($prop = $res->Fetch()){
        $arIBlockProps[$prop['ID']] = $prop['NAME'];
    }
}
$arIBlockButtonTypes = [
    'btn-default' => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_BTN_TYPE_DEFAULT'),
    'btn-primary' => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_BTN_TYPE_PRIMARY')
];

$arComponentParameters = array(
	"GROUPS" => array(),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_IBLOCK_TYPE'),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "forms",
			"REFRESH" => "Y",
            "SORT" => 100
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_IBLOCK_ID'),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
            "SORT" => 200
		),
        "FORM_PRODUCT_ADD" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_PRODUCT_ADD'),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
            "REFRESH" => "Y",
            "SORT" => 300
        ),
        'FORM_PRODUCT_ID' => $arCurrentValues['FORM_PRODUCT_ADD'] == 'Y' ? array(
            "PARENT" => "BASE",
            "NAME" => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_PRODUCT_ID'),
            "TYPE" => "STRING",
            "DEFAULT" => '$arResult["ID"]',
            "SORT" => 400
        ) : '',
        "FORM_BTN_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_BTN_TYPE'),
            "TYPE" => "LIST",
            "DEFAULT" => "btn-link_border",
            "VALUES" => $arIBlockButtonTypes,
            "MULTIPLE" => "N",
            "SORT" => 500
        ),
        "FORM_FIELDS" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_FIELDS'),
            "TYPE" => "LIST",
            "VALUES" => $arIBlockProps,
            "MULTIPLE" => "Y",
            "SORT" => 600
        ),
        "FORM_REQUIRED_FIELDS" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_REQUIRED_FIELDS'),
            "TYPE" => "LIST",
            "VALUES" => $arIBlockProps,
            "MULTIPLE" => "Y",
            "SORT" => 700
        ),
        "FORM_TITLE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_TITLE'),
            "TYPE" => "STRING",
            "DEFAULT" => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_TITLE_DEFAULT'),
            "SORT" => 800
        ),
		"FORM_BTN_OPEN" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_BTN_OPEN'),
            "TYPE" => "STRING",
            "DEFAULT" => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_BTN_OPEN_DEFAULT'),
            "SORT" => 900
        ),
        "FORM_BTN_SUBMIT" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_BTN_SUBMIT'),
            "TYPE" => "STRING",
            "DEFAULT" => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_BTN_SUBMIT_DEFAULT'),
            "SORT" => 1000
        ),
        "FORM_POLITIC_URL" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage('WEBSITE96_FORMS_PARAMS_FORM_POLITIC_URL'),
            "TYPE" => "STRING",
            "DEFAULT" => '/politic/',
            "SORT" => 1100
        ),
		"CACHE_TIME"  =>  Array("DEFAULT"=>3600),
	),
);
?>