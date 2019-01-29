<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
    "SECTION_URL" => array(
        "HIDDEN" => "Y"
    ),
    "SECTION_USER_FIELDS" => array("HIDDEN" => "Y"),
    "SECTION_ID_VARIABLE" => array("HIDDEN" => "Y"),
    "DETAIL_URL" => array("HIDDEN" => "Y"),
    "FILTER_NAME" => array("HIDDEN" => "Y"),
    "INCLUDE_SUBSECTIONS" => array("HIDDEN" => "Y"),
    "PAGE_ELEMENT_COUNT" => array("HIDDEN" => "Y"),
    "LINE_ELEMENT_COUNT" => array("HIDDEN" => "Y"),
    "OFFERS_LIMIT" => array("HIDDEN" => "Y"),
    "BACKGROUND_IMAGE" => array("HIDDEN" => "Y"),
    "SEF_MODE" => array(
        'VALUE' => 'N',
        "HIDDEN" => "Y"
    ),
    "AJAX_MODE" => array("HIDDEN" => "Y"),
    "AJAX_OPTION_JUMP" => array("HIDDEN" => "Y"),
    "AJAX_OPTION_STYLE" => array("HIDDEN" => "Y"),
    "AJAX_OPTION_HISTORY" => array("HIDDEN" => "Y"),
    "SHOW_ALL_WO_SECTION" => array("HIDDEN" => "Y"),
    "USE_PRODUCT_QUANTITY" => array("HIDDEN" => "Y"),
    "ADD_PROPERTIES_TO_BASKET" => array("HIDDEN" => "Y"),
    "DISPLAY_COMPARE" => array("HIDDEN" => "Y"),
    "PRICE_CODE" => array("HIDDEN" => "Y"),
    "SECTION_TITLE" => array(
        "NAME" => GetMessage("NAME_SECTION_TITLE"),
        "TYPE" => "STRING",
        "PARENT" => "BASE"
    ),
    "SECTION_LINK" => array(
        "NAME" => GetMessage("NAME_SECTION_LINK"),
        "TYPE" => "STRING",
        "PARENT" => "BASE"
    ),
    "IMAGE_TYPE" => array(
        'NAME' => GetMessage("NAME_IMAGE_TYPE"),
        'TYPE' => 'LIST',
        'PARENT' => 'VISUAL',
        'VALUES' => array(
            '1' => GetMessage('NAME_IMAGE_TYPE_ALT'),
            '2' => GetMessage('NAME_IMAGE_TYPE_EXACT')
        )
    )
);