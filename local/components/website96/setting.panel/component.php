<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

//Подключения файла настроек шаблона
require_once $_SERVER['DOCUMENT_ROOT'].'/local/tools/settings.php';

$module_id = "website.template";
CModule::IncludeModule($module_id);

$arResult['SETTINGS'] = $arSetting;
$arResult['COLORS'] = CWebsiteTemplate::GetColorsList();


if(check_bitrix_sessid() && $_REQUEST['SET_SETTING'] == 'Y') {

    $arValues = [];

    //Установка цвета
    if ($_REQUEST['COLORS']){
        $arValues['COLORS'] = $_REQUEST['COLORS'];
    }

    /*foreach ($_REQUEST['COLORS'] as $type => $value) {
        if ($arResult['SETTINGS']['COLORS'][$type] != $value) {
           // COption::SetOptionString($module_id, "WEBSITE_TEMPLATE_SETTING_VIEW_COLOR_" . $type, $value, '', SITE_ID);
            $arValues['COLORS'][$type] = $value;
        }
    }*/

    //Установка типа главной страницы
    if ($_REQUEST['HOME_TYPE']) {
        //COption::SetOptionString($module_id, "WEBSITE_TEMPLATE_SETTING_VIEW_HOME", $_REQUEST['HOME_TYPE'], '', SITE_ID);
        $arValues['HOME_TYPE'] = $_REQUEST['HOME_TYPE'];
    }

    //Установка типа готового решения
    if ($_REQUEST['TEMPLATE_TYPE']) {
        //COption::SetOptionString($module_id, "WEBSITE_TEMPLATE_SETTING_TEMPLATE_TYPE", $_REQUEST['TEMPLATE_TYPE'], '', SITE_ID);
        $arValues['TEMPLATE_TYPE'] = $_REQUEST['TEMPLATE_TYPE'];
    }

    //Установка шрифтов
    if ($_REQUEST['FONTS']){
        $arValues['FONTS'] = $_REQUEST['FONTS'];
    }

    if(!empty($arValues)){
        session_start();
        $_SESSION['SETTING'] = $arValues;
    }

    LocalRedirect($APPLICATION->GetCurPage());
}

$this->IncludeComponentTemplate();