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
/*echo '<pre>';
var_dump($arResult);
echo '</pre>';*/
?>
<?if($arResult['ITEMS']){?>
    <?if($arParams["DISPLAY_TOP_PAGER"]){?>
        <?=$arResult["NAV_STRING"]?>
    <?}?>
    <div class="page__stocks stocks__list">
        <?foreach ($arResult["ITEMS"] as $arStock){
            $this->AddEditAction($arStock['ID'], $arStock['EDIT_LINK'], CIBlock::GetArrayByID($arStock["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arStock['ID'], $arStock['DELETE_LINK'], CIBlock::GetArrayByID($arStock["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="stocks__item" id="<?=$this->GetEditAreaId($arStock['ID']);?>">
                <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arStock["PREVIEW_PICTURE"])){?>
                    <div class="stocks__item-image">
                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arStock["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])){?>
                            <a href="<?=$arStock['DETAIL_PAGE_URL']?>">
                                <img src="<?=$arStock['PREVIEW_PICTURE']['SRC']?>"
                                     alt="<?=$arStock['PREVIEW_PICTURE']['ALT'] ? $arStock['PREVIEW_PICTURE']['ALT'] : $arStock['NAME']?>"
                                     title="<?=$arStock['PREVIEW_PICTURE']['TITLE'] ? $arStock['PREVIEW_PICTURE']['TITLE'] : $arStock['NAME']?>"></a>
                        <?}else{?>
                            <img src="<?=$arStock['PREVIEW_PICTURE']['SRC']?>"
                                 alt="<?=$arStock['PREVIEW_PICTURE']['ALT'] ? $arStock['PREVIEW_PICTURE']['ALT'] : $arStock['NAME']?>"
                                 title="<?=$arStock['PREVIEW_PICTURE']['TITLE'] ? $arStock['PREVIEW_PICTURE']['TITLE'] : $arStock['NAME']?>">
                        <?}?>
                    </div>
                <?}?>
                <?if($arParams["DISPLAY_NAME"]!="N" && $arStock["NAME"]){?>
                    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arStock["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])){?>
                        <div class="stocks__name">
                            <a href="<?=$arStock['DETAIL_PAGE_URL']?>"><?=$arStock['NAME']?></a>
                        </div>
                    <?}else{?>
                        <div class="stocks__name">
                            <?=$arStock['NAME']?>
                        </div>
                    <?}?>
                <?}?>
                <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arStock["PREVIEW_TEXT"]){?>
                    <div class="stocks__anons"><?=$arStock['PREVIEW_TEXT']?></div>
                <?}?>
                <?if($arParams["DISPLAY_DATE"]!="N" && $arStock["DISPLAY_ACTIVE_TO"]){
                    $arStock['DATE_STOCK'] = explode(' ', $arStock['DISPLAY_ACTIVE_TO']);?>
                    <div class="stocks__item-date"><i class="time__icon"></i>До <?=$arStock['DATE_STOCK'][0]?> <?=$arStock['DATE_STOCK'][1]?></div>
                <?}?>
            </div>
        <?}?>
    </div>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]){?>
        <?=$arResult["NAV_STRING"]?>
    <?}?>
<?} else {?>
    К сожалению, сейчас нет действующих акций или распродаж.
<?}?>
