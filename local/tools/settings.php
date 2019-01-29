<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$module_id = "website.template";
CModule::IncludeModule($module_id);
CModule::IncludeModule("iblock");
CModule::IncludeModule('highloadblock');

$arFonts = [
    'TITLE' => [
        'Geometria (По умолчанию)',
        'Montserrat Alternates',
        'Roboto Slab',
        'Play',
        'Tinos',
        'Podkova',
        'Noto Serif'
    ],
    'SIMPLE' => [
        'Geometria (По умолчанию)',
        'Roboto',
        'Open Sans',
        'Montserrat',
        'Ubuntu',
        'PT Sans'
    ]
];


$arSetting = [
    'SHOW_PANEL' => COption::GetOptionString($module_id, 'WEBSITE_TEMPLATE_SETTING_VIEW_PANEL', 'Y', SITE_ID),
    'HEADER_TYPE' => COption::GetOptionString($module_id, 'WEBSITE_TEMPLATE_SETTING_VIEW_HEADER', 1, SITE_ID),
    'HOME_TYPE' => $_SESSION['SETTING']['HOME_TYPE'] > 0 ? $_SESSION['SETTING']['HOME_TYPE'] : COption::GetOptionString($module_id, 'WEBSITE_TEMPLATE_SETTING_VIEW_HOME', 1, SITE_ID),
    'SHOW_FAST_ORDER' => COption::GetOptionString($module_id, 'WEBSITE_TEMPLATE_SETTING_SITE_FAST_ORDER', 'Y', SITE_ID),
    'COLORS' => [
        'MAIN' =>  [
            'VALUE' => $_SESSION['SETTING']['COLOR']['MAIN'] ? $_SESSION['SETTING']['COLOR']['MAIN'] : COption::GetOptionString($module_id, 'WEBSITE_TEMPLATE_SETTING_VIEW_COLOR_MAIN', 'default', SITE_ID),
        ],
        'ACTION' => [
            'VALUE' => $_SESSION['SETTING']['COLOR']['ACTION'] ? $_SESSION['SETTING']['COLOR']['ACTION'] : COption::GetOptionString($module_id, 'WEBSITE_TEMPLATE_SETTING_VIEW_COLOR_ACTION', 'default', SITE_ID)
        ]
    ],
    'FONT_SIMPLE' => $_SESSION['SETTING']['FONT_SIMPLE'] ? $_SESSION['SETTING']['FONT_SIMPLE'] : COption::GetOptionString($module_id, 'WEBSITE_TEMPLATE_SETTING_TEMPLATE_FONT_SIMPLE', 'Geometria', SITE_ID),
    'FONT_TITLE' => $_SESSION['SETTING']['FONT_TITLE'] ? $_SESSION['SETTING']['FONT_TITLE'] : COption::GetOptionString($module_id, 'WEBSITE_TEMPLATE_SETTING_TEMPLATE_FONT_TITLE', 'Geometria', SITE_ID),
    'TEMPLATE_TYPE' => $_SESSION['SETTING']['TEMPLATE_TYPE'] ? $_SESSION['SETTING']['TEMPLATE_TYPE'] : COption::GetOptionString($module_id, 'WEBSITE_TEMPLATE_SETTING_TEMPLATE_TYPE', 'CATALOG', SITE_ID),
    'LOGO' => COption::GetOptionString($module_id, 'WEBSITE_TEMPLATE_SETTING_VIEW_LOGO', 'WEBSITE96', SITE_ID),
    'FONTS' => $arFonts
];

$arColors = CWebsiteTemplate::GetColorsList();

foreach ($arSetting['COLORS'] as $TYPE => $CODE){
    foreach ($arColors as $k => $arColor){
        if($arColor['UF_COLOR_CODE'] == $CODE['VALUE']){
            $arSetting['COLORS'][$TYPE]['HEX'] = $arColor['UF_COLOR_HEX'];
        }
    }
};

if(empty($arSetting['HOME_TYPE'])){
    $arSetting['HOME_TYPE'] = 1;
}