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


$pathIncludeFile = $_SERVER['DOCUMENT_ROOT'].'/include/section/title-'.$thisCode.'.php';

if(!file_exists($pathIncludeFile)) {
    $fp = fopen($pathIncludeFile, "w");
    fwrite($fp, $APPLICATION->GetTitle());
    fclose($fp);
}

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
        <? $sectionList = $APPLICATION->GetViewContent('advantages-section');
        if($sectionList) {
            echo $APPLICATION->ShowViewContent('advantages-section');
        } else {
            $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"section", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "section",
		"CHILD_MENU_TYPE" => "left"
	),
	false
);
        }?>
        <div class="container">
            <div class="pin">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/description/services.php",
                    )
                );?>
            </div>
            
            <?/*
            <h3 class="block-title"><?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/section/title-".$thisCode.".php",
                    )
                );?></h3>
            */?>
            <?= $arParams["CONTENT"]; ?>
        </div>
    </div>
</div>
