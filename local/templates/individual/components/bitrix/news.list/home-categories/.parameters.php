<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"NEWS_COUNT" => array("HIDDEN" => "Y"),
	"SECTION_TITLE" => array(
		"NAME" => GetMessage('SECTION_TITLE_LABEL'),
		"TYPE" => "STRING",
		"DEFAULT" => GetMessage('SECTION_TITLE_DEFAULT'),
		"PARENT" => "BASE"
	),
	"SORT_BY1" => array("HIDDEN" => "Y"),
	"SORT_ORDER1" => array("HIDDEN" => "Y"),
	"SORT_BY2"  => array("HIDDEN" => "Y"),
	"SORT_ORDER2" => array("HIDDEN" => "Y"),
	"FILTER_NAME" => array("HIDDEN" => "Y"),
	"DETAIL_URL" => array("HIDDEN" => "Y"),
	"AJAX_MODE" => array("HIDDEN" => "Y"),
	"AJAX_OPTION_JUMP" => array("HIDDEN" => "Y"),
	"AJAX_OPTION_STYLE" => array("HIDDEN" => "Y"),
	"AJAX_OPTION_HISTORY" => array("HIDDEN" => "Y"),
	"PREVIEW_TRUNCATE_LEN" => array("HIDDEN" => "Y"),
	"ACTIVE_DATE_FORMAT" => array("HIDDEN" => "Y"),
	"SET_TITLE" => array("HIDDEN" => "Y"),
	"SET_BROWSER_TITLE" => array("HIDDEN" => "Y"),
	"SET_META_KEYWORDS" => array("HIDDEN" => "Y"),
	"SET_META_DESCRIPTION" => array("HIDDEN" => "Y"),
	"SET_LAST_MODIFIED" => array("HIDDEN" => "Y"),
	"INCLUDE_IBLOCK_INTO_CHAIN" => array("HIDDEN" => "Y"),
);
?>
