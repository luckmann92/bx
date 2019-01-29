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
<div class="page page--inside page--events">
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
            <h1><?$APPLICATION->ShowTitle(false);?></h1>
        </div>
    </div>
    <?if($APPLICATION->GetViewContent('detail__page') != "Y"){
        if($arParams['SETTING']['TEMPLATE_TYPE'] != 'COMPANY'){
            $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "section",
                array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "section",
                    "USE_EXT" => "N",
                    "COMPONENT_TEMPLATE" => "section"
                ),
                $component
            );
        }

    }?>
    <div class="page-content">
        <div class="container">
            <div class="content">
                <?= $arParams["CONTENT"]; ?>
            </div>
        </div>
    </div>
</div>