<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<form class="search__form" method="get" action="/search/">
    <span class="icon__search"><?=GetIconSVG('search');?></span>
    <input class="inp inp-search"
           name="<?=$arParams["NAME"]?>"
           id="<?=$arResult["ID"]?>"
           autocomplete="off"
           placeholder="<?echo $arParams["VALUE"]?>"
           <?=($arParams["INPUT_SIZE"] > 0) ? 'size="'.$arParams["INPUT_SIZE"].'"' : ''?>
    >
    <button class="btn-search" type="submit" title="<?=GetMessage('SEARCH_TITLE')?>">
        <?=GetIconSVG('arrow_small_right');?>
    </button>
</form>