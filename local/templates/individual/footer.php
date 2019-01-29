<?php
/**
 * @var CMain $APPLICATION
 * @var string $headerContent
 */

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$pageContent = ob_get_clean();
$pageContent = trim(implode("", $APPLICATION->buffer_content)) . $pageContent;
$APPLICATION->RestartBuffer();
ob_end_clean();

if (function_exists("getmoduleevents")) {
    foreach (GetModuleEvents("main", "OnLayoutRender", true) as $arEvent) {
        ExecuteModuleEventEx($arEvent);
    }
}

$pageLayout = $APPLICATION->GetPageProperty("PAGE_LAYOUT", AppGetCascadeDirProperties("PAGE_LAYOUT", "column1"));
$arLang = $APPLICATION->GetLang();



//Подключения файла настроек шаблона


$curPage = $APPLICATION->GetCurPage();
if (stripos($curPage, 'w-shop') || stripos($curPage, 'w-catalog') || stripos($curPage, 'w-company')) {
    $module_id = 'website.template';
    CModule::IncludeModule($module_id);

    if (stripos($curPage, 'w-shop')) {
        COption::SetOptionString($module_id, 'WEBSITE_TEMPLATE_SETTING_TEMPLATE_TYPE', 'SHOP', '',SITE_ID);
        $_SESSION['SETTING']['TEMPLATE_TYPE'] = 'SHOP';
    } elseif (stripos($curPage, 'w-catalog')) {
        COption::SetOptionString($module_id, 'WEBSITE_TEMPLATE_SETTING_TEMPLATE_TYPE', 'CATALOG', '',SITE_ID);
        $_SESSION['SETTING']['TEMPLATE_TYPE'] = 'CATALOG';
    } elseif (stripos($curPage, 'w-company')) {
        COption::SetOptionString($module_id, 'WEBSITE_TEMPLATE_SETTING_TEMPLATE_TYPE', 'COMPANY', '',SITE_ID);
        $_SESSION['SETTING']['TEMPLATE_TYPE'] = 'COMPANY';
    }

    LocalRedirect(SITE_DIR);
}

require_once $_SERVER['DOCUMENT_ROOT'].'/local/tools/settings.php';


?>

<!doctype html>
<html lang="<?=$arLang['LANGUAGE_ID']?>">
    <head>
        <base href="/">
        <link rel="shortcut icon" href="<?=SITE_DIR?>favicon.ico">
        <?
        $APPLICATION->IncludeFile("views/modules/meta.php",
            array(
                "SETTING" => $arSetting
            ), array(
                "SHOW_BORDER" => false,
                "MODE" => "php",
            ));
        $APPLICATION->ShowHead(false);
        ?>
        <title><?= $APPLICATION->GetTitle();?><?=' - '.$arLang["SITE_NAME"] ?: ' - '.$arLang["SITE_NAME"]?></title>
        <?if($_SESSION['SETTING']['FONTS']){?>
            <style>
                <?foreach ($_SESSION['SETTING']['FONTS'] as $k => $arFont){?>
                   <?if(str_replace('+', ' ', $arFont) != 'Geometria (По умолчанию)'){?>
                        <?=$k == 'TITLE' ? 'h1, h2, h3' : 'body'?> {
                            font-family: '<?=str_replace('+', ' ', $arFont)?>', sans-serif;
                        }
                    <?}?>
                <?}?>
            </style>
        <?}?>

    </head>
<body class="app<?=strtolower(' template--'.$arSetting['TEMPLATE_TYPE'])?>" ng-app="app">
<?
//Запрет перехода по страницам
if ($arSetting['TEMPLATE_TYPE'] == 'COMPANY') {
    if (stristr($APPLICATION->GetCurPage(false), 'catalog') ||
        stristr($APPLICATION->GetCurPage(false), 'stocks') ||
        stristr($APPLICATION->GetCurPage(false), 'cart')) {
        LocalRedirect('/');
    }
}

if ($arSetting['SHOW_PANEL'] == 'Y'){
    echo '<button class="settings__panel-show"></button>';
}

if ($USER->IsAdmin()) {
    $APPLICATION->ShowPanel();
}

$APPLICATION->IncludeFile(
    "views/modules/headers/responsive.php",
    array(
        "SETTING" => $arSetting
    ),
    array(
        "SHOW_BORDER" => false,
        "MODE" => "php"
    )
);

$APPLICATION->IncludeFile(
    "views/modules/headers/header".$arSetting['HEADER_TYPE'].".php",
    array(
        "SETTING" => $arSetting
    ),
    array(
        "SHOW_BORDER" => false,
        "MODE" => "php"
    )
);

if ($APPLICATION->GetCurPage(false) == SITE_DIR) {
    $APPLICATION->IncludeFile(
        "views/layouts/homes/home".$arSetting['HOME_TYPE'].".php",
        array(
            "CONTENT" => $pageContent,
            "SETTING" => $arSetting
        ),
        ["SHOW_BORDER" => false, "MODE" => "php"]
    );
} else {
    $APPLICATION->IncludeFile(
        "views/layouts/".$pageLayout.".php",
        ["CONTENT" => $pageContent, "SETTING" => $arSetting],
        ["SHOW_BORDER" => false, "MODE" => "php"]
    );
}

$APPLICATION->RestartWorkarea(true);

$APPLICATION->IncludeFile(
    "views/modules/footer.php",
    ["SETTING" => $arSetting],
    ["SHOW_BORDER" => false, "MODE" => "php"]
);

$APPLICATION->IncludeFile(
    "views/scripts.php", [],
    ["SHOW_BORDER" => false, "MODE" => "php"]
);

$APPLICATION->ShowBodyScripts();

?>

</body>
</html>
