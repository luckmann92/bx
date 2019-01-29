<?php
/**
 * @author Danil Syromolotov <ds@itex.ru>
 */
/**
 * @var CBitrixComponent         $component
 * @var CMain                    $APPLICATION
 * @var array                    $arParams
 * @var array                    $arResult
 * @var CBitrixComponentTemplate $this
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
if ($arResult["nEndPage"] == $arResult["nStartPage"]) {
    return;
}
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");


?>
<ul class="navN">
    <? if ($arResult["NavPageNomer"] > 1): ?>
        <li class="navn-prev">
            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?=GetIconSVG('arrow_long_right');?></a>
        </li>
    <? endif; ?>
    <? for ($curPage = $arResult["nStartPage"]; $curPage <= $arResult["nEndPage"]; $curPage++): ?>
        <li class="usually<? if ($curPage == $arResult["NavPageNomer"]): ?> on<? endif; ?><?if($curPage == $arResult["nEndPage"] && $arResult['NavPageCount'] > 5 && $arResult['NavPageNomer'] < 4){?> touches<?}?>">
            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $curPage ?>"><?= $curPage; ?><?if($curPage == $arResult["nEndPage"] && $arResult['NavPageCount'] > 5 && $arResult['NavPageNomer'] < 4){?>...<?}?></a>
        </li>
    <? endfor; ?>
    <?/* if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
        <li class="navn-last">
            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"></a>
        </li>
    <? endif; */?>
    <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
        <li class="navn-next">
            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><?=GetIconSVG('arrow_long_right');?></a>
        </li>
    <?endif;?>
</ul>
