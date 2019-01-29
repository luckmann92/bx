<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
    "SECTION_TITLE" => array(
        "NAME" => GetMessage("NEWS_SECTION_TITLE_NAME"),
        "TYPE" => "STRING",
        "PARENT" => "BASE"
    ),
    "SECTION_LINK" => array(
        "NAME" => GetMessage("NEWS_SECTION_LINK_NAME"),
        "TYPE" => "STRING",
        "PARENT" => "BASE"
    ),
	"BG_IMAGE" => array(
		"NAME" => "Фоновое изображение на главной странице",
		"TYPE" => 'FILE',
        "FD_TARGET" => "F",
        "FD_EXT" => "jpg,jpeg,png,gif",
        "FD_UPLOAD" => true,
        "FD_USE_MEDIALIB" => true,
        "FD_MEDIALIB_TYPES" => Array("image")
	),
    "NEWS_COUNT" => ["HIDDEN" => "Y"],
    "FIELD_CODE" => ["HIDDEN" => "Y"],
    "SORT_BY2" => ["HIDDEN" => "Y"],
    "SORT_ORDER2" => ["HIDDEN" => "Y"],
    "FILTER_NAME" => ["HIDDEN" => "Y"],
    "CHECK_DATES" => ["HIDDEN" => "Y"],
    "DETAIL_URL" => ["HIDDEN" => "Y"],
    "PREVIEW_TRUNCATE_LEN" => ["HIDDEN" => "Y"],
    "ACTIVE_DATE_FORMAT" => ["HIDDEN" => "Y"],
    "STRICT_SECTION_CHECK" => ["HIDDEN" => "Y"],
    "INCLUDE_SUBSECTIONS" => ["HIDDEN" => "Y"],
    "PARENT_SECTION_CODE" => ["HIDDEN" => "Y"],
    "PARENT_SECTION" => ["HIDDEN" => "Y"],
    "HIDE_LINK_WHEN_NO_DETAIL" => ["HIDDEN" => "Y"],
    "ADD_SECTIONS_CHAIN" => ["HIDDEN" => "Y"],
    "INCLUDE_IBLOCK_INTO_CHAIN" => ["HIDDEN" => "Y"],
    "SET_TITLE" => ["HIDDEN" => "Y"],
    "SET_LAST_MODIFIED" => ["HIDDEN" => "Y"],
    "SET_META_DESCRIPTION" => ["HIDDEN" => "Y"],
    "SET_META_KEYWORDS" => ["HIDDEN" => "Y"],
    "SET_BROWSER_TITLE" => ["HIDDEN" => "Y"],
    "PAGER_TEMPLATE" => ["HIDDEN" => "Y"],
    "DISPLAY_TOP_PAGER" => ["HIDDEN" => "Y"],
    "DISPLAY_BOTTOM_PAGER" => ["HIDDEN" => "Y"],
    "PAGER_TITLE" => ["HIDDEN" => "Y"],
    "PAGER_SHOW_ALWAYS" => ["HIDDEN" => "Y"],
    "PAGER_DESC_NUMBERING" => ["HIDDEN" => "Y"],
    "PAGER_DESC_NUMBERING_CACHE_TIME" => ["HIDDEN" => "Y"],
    "PAGER_SHOW_ALL" => ["HIDDEN" => "Y"],
    "PAGER_BASE_LINK_ENABLE" => ["HIDDEN" => "Y"],
    "SET_STATUS_404" => ["HIDDEN" => "Y"],
    "SHOW_404" => ["HIDDEN" => "Y"],
    "MESSAGE_404" => ["HIDDEN" => "Y"],
    "AJAX_MODE" => ["HIDDEN" => "Y"],
    "AJAX_OPTION_JUMP" => ["HIDDEN" => "Y"],
    "AJAX_OPTION_STYLE" => ["HIDDEN" => "Y"],
    "AJAX_OPTION_HISTORY" => ["HIDDEN" => "Y"]
);
?>
