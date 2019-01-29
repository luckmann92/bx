<?php
$sSectionName = "";
$thisPath = explode('/', $APPLICATION->GetCurDir());
$thisPath = array_diff($thisPath, array('', NULL, false));
$depthPath = count($thisPath);
$thisCode = $thisPath[count($thisPath)];

if ($depthPath == 1) {
    $sPath = $_SERVER["DOCUMENT_ROOT"]."/.section.php";
} elseif ($depthPath > 1) {
    array_pop($thisPath);
    $pathFull = implode('/', $thisPath);
    $sPath = $_SERVER["DOCUMENT_ROOT"]."/".$pathFull."/.section.php";
}
include($sPath);


?>
<div class="page page--inside">
    <div class="page-head" style="background-image: url(<?=SITE_TEMPLATE_PATH?>/public/images/bg-page.jpg)">
        <div class="container">
            <div class="page-head_caption">
                <span class="page-head_company_name"><?=$sSectionName?></span>
                <h1><?$APPLICATION->ShowTitle(false);?></h1>
            </div>
        </div>
    </div>
    <div class="page-content">
        <?
        $APPLICATION->IncludeComponent("bitrix:menu", "section", Array(
            "ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
            "MENU_CACHE_TYPE" => "A",	// Тип кеширования
            "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
            "MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
            "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
            "MAX_LEVEL" => "1",	// Уровень вложенности меню
            "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
            "DELAY" => "N",	// Откладывать выполнение шаблона меню
            "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
            "COMPONENT_TEMPLATE" => ".default",
            "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
        ),
            false
        );?>
        <div class="container">

            <?= $arParams["CONTENT"]; ?>
        </div>
    </div>
</div>
