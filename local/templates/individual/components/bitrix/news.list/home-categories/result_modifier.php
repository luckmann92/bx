<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

$arFilterSection = array(
    'IBLOCK_ID' => $arResult['ID'],
    'UF_SECTION_ON_HOME' => 1
);
$arSelectSection = array(
    'ID', 'IBLOCK_ID', 'NAME', 'IBLOCK_SECTION_ID', 'PICTURE', 'SECTION_PAGE_URL', 'UF_*'
);
$rsSections = CIBlockSection::GetList(array("SORT"=>"ASC"), $arFilterSection, false, $arSelectSection);
while($arSection = $rsSections->GetNext()){
    if(isset($arSection['PICTURE']) && $arSection['PICTURE'] > 0){
        $arSection['PICTURE'] = CFile::GetPath($arSection['PICTURE']);
    }
    $arResult['SECTIONS'][$arSection['ID']] = $arSection;
}