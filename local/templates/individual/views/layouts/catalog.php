<?php
/**
 * @author Mikhail Lukmanov <lukmanof92@gmail.com>
 */
/**
 * @var CMain $APPLICATION
 * @var array $arParams
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>
<div class="page page--inside">
    <div class="breadcrumb">
        <div class="container">
            <?$APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                ".default",
                array(
                    "PATH" => "",
                    "SITE_ID" => "s1",
                    "START_FROM" => "0",
                ),
                $component,
                array("HIDE_ICONS" => "Y")
            );?>
        </div>
    </div>
    <div class="page__head">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1><?$APPLICATION->ShowTitle(false);?></h1>
                </div>
            </div>

        </div>
    </div>
    <div class="page-content page-catalog">
        <div class="container">
            <div class="row justified-content-between">
                <?if($APPLICATION->GetViewContent('detail__page') != "Y"){?>
                    <div class="col-lg-3 col-md-4 d-none d-md-block sidebar">
                        <div class="left__menu">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "sidebar",
                                array(
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "CHILD_MENU_TYPE" => "left",
                                    "DELAY" => "N",
                                    "MAX_LEVEL" => "2",
                                    "MENU_CACHE_GET_VARS" => "",
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_TYPE" => "N",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "ROOT_MENU_TYPE" => "left",
                                    "USE_EXT" => "Y",
                                    "COMPONENT_TEMPLATE" => "sidebar"
                                ),
                                false
                            );?>
                        </div>
                        <div class="last__news">
                            <?$APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "last-stocks",
                            array(
                                "ADD_SECTIONS_CHAIN" => "N",
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "N",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "Y",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "A",
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "DISPLAY_DATE" => "N",
                                "DISPLAY_NAME" => "N",
                                "DISPLAY_PICTURE" => "N",
                                "DISPLAY_PREVIEW_TEXT" => "N",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FIELD_CODE" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "FILTER_NAME" => "",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => "10",
                                "IBLOCK_TYPE" => "base",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "INCLUDE_SUBSECTIONS" => "N",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "2",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => ".default",
                                "PAGER_TITLE" => "Новости",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "PROPERTY_CODE" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "SET_BROWSER_TITLE" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_STATUS_404" => "N",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "N",
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER1" => "DESC",
                                "SORT_ORDER2" => "ASC",
                                "STRICT_SECTION_CHECK" => "N",
                                "COMPONENT_TEMPLATE" => "last-stocks",
                                "ACTIVE_DATE_FORMAT" => "j F Y"
                            ),
                            false
                        );?>
                        </div>
                        <div class="last__news">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:news.list",
                                "last-news",
                                array(
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "N",
                                    "CACHE_FILTER" => "N",
                                    "CACHE_GROUPS" => "Y",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_TYPE" => "A",
                                    "CHECK_DATES" => "Y",
                                    "DETAIL_URL" => "",
                                    "DISPLAY_BOTTOM_PAGER" => "N",
                                    "DISPLAY_DATE" => "N",
                                    "DISPLAY_NAME" => "N",
                                    "DISPLAY_PICTURE" => "N",
                                    "DISPLAY_PREVIEW_TEXT" => "N",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "FIELD_CODE" => array(
                                        0 => "",
                                        1 => "",
                                    ),
                                    "FILTER_NAME" => "",
                                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                    "IBLOCK_ID" => "15",
                                    "IBLOCK_TYPE" => "base",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                    "INCLUDE_SUBSECTIONS" => "N",
                                    "MESSAGE_404" => "",
                                    "NEWS_COUNT" => "2",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                    "PAGER_SHOW_ALL" => "N",
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_TEMPLATE" => ".default",
                                    "PAGER_TITLE" => "Новости",
                                    "PARENT_SECTION" => "",
                                    "PARENT_SECTION_CODE" => "",
                                    "PREVIEW_TRUNCATE_LEN" => "",
                                    "PROPERTY_CODE" => array(
                                        0 => "",
                                        1 => "",
                                    ),
                                    "SET_BROWSER_TITLE" => "N",
                                    "SET_LAST_MODIFIED" => "N",
                                    "SET_META_DESCRIPTION" => "N",
                                    "SET_META_KEYWORDS" => "N",
                                    "SET_STATUS_404" => "N",
                                    "SET_TITLE" => "N",
                                    "SHOW_404" => "N",
                                    "SORT_BY1" => "ACTIVE_FROM",
                                    "SORT_BY2" => "SORT",
                                    "SORT_ORDER1" => "DESC",
                                    "SORT_ORDER2" => "ASC",
                                    "STRICT_SECTION_CHECK" => "N",
                                    "COMPONENT_TEMPLATE" => "last-news",
                                    "ACTIVE_DATE_FORMAT" => "j F Y"
                                ),
                                false
                            );?>
                        </div>
                    </div>
                <?}?>
                <div class="<?=$APPLICATION->GetViewContent('detail__page') == "Y" ? ' col-12' : ' col-lg-9 col-md-8'?>">
                    <?= $arParams["CONTENT"]; ?>
                </div>
            </div>
        </div>
    </div>
</div>