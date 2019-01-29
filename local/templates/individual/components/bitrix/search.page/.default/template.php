<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>
<div class="search__page">
    <div class="search__page-panel">
        <?$APPLICATION->IncludeComponent(
            "bitrix:search.suggest.input",
            "",
            array(
                "NAME" => "q",
                "VALUE" => $arResult["REQUEST"]["~QUERY"],
                "INPUT_SIZE" => 40,
                "DROPDOWN_SIZE" => 10,
                "FILTER_MD5" => $arResult["FILTER_MD5"],
            ),
            $component, array("HIDE_ICONS" => "Y")
        );?>
    </div>
    <?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])){?>
        <span class="search__notice">
            <?=GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
        </span>
    <?}

    if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false){
        if($arResult["ERROR_CODE"]!=0){?>
            <span class="search__notice"><?=GetMessage("SEARCH_ERROR")?></span>
            <?if(is_array($arResult["ERROR_TEXT"])){
                foreach ($arResult["ERROR_TEXT"] as $MESS){?>
                    <span class="search__notice search__notice-error"><?=$MESS?></span>
                <?}
            }
        }?>
        <span class="search__notice"><?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?></span>
        <span class="search__notice"><?=GetMessage("SEARCH_SINTAX")?><strong><?=GetMessage("SEARCH_LOGIC")?></strong></span>
        <table border="0" cellpadding="5">
            <tr>
                <td align="center" valign="top"><?=GetMessage("SEARCH_OPERATOR")?></td><td valign="top"><?=GetMessage("SEARCH_SYNONIM")?></td>
                <td><?=GetMessage("SEARCH_DESCRIPTION")?></td>
            </tr>
            <tr>
                <td align="center" valign="top"><?=GetMessage("SEARCH_AND")?></td><td valign="top">and, &amp;, +</td>
                <td><?=GetMessage("SEARCH_AND_ALT")?></td>
            </tr>
            <tr>
                <td align="center" valign="top"><?=GetMessage("SEARCH_OR")?></td><td valign="top">or, |</td>
                <td><?=GetMessage("SEARCH_OR_ALT")?></td>
            </tr>
            <tr>
                <td align="center" valign="top"><?=GetMessage("SEARCH_NOT")?></td><td valign="top">not, ~</td>
                <td><?=GetMessage("SEARCH_NOT_ALT")?></td>
            </tr>
            <tr>
                <td align="center" valign="top">( )</td>
                <td valign="top">&nbsp;</td>
                <td><?=GetMessage("SEARCH_BRACKETS_ALT")?></td>
            </tr>
        </table>
    <?} elseif(count($arResult["SEARCH"]) > 0) {?>
        <div class="search__items-list">
            <?foreach($arResult["SEARCH"] as $arItem){?>
                <div class="search__item">
                    <a href="<?=$arItem["URL"]?>" class="search__item-name"><?=$arItem["TITLE_FORMATED"]?></a>
                    <div class="search__item-anons"><?=$arItem["BODY_FORMATED"]?></div>
                </div>
            <?}?>
        </div>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
    <?} else {?>
        <span class="search__notice"><?=GetMessage("SEARCH_NOTHING_TO_FOUND");?></span>
    <?}?>
</div>