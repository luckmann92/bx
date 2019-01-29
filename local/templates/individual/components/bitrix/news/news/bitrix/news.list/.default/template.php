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
<?if($arResult['ITEMS']){?>
    <?if($arParams["DISPLAY_TOP_PAGER"]){?>
        <?=$arResult["NAV_STRING"]?>
    <?}?>
    <div class="page__news news__list">
        <?foreach ($arResult["ITEMS"] as $arNews){
            $this->AddEditAction($arNews['ID'], $arNews['EDIT_LINK'], CIBlock::GetArrayByID($arNews["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arNews['ID'], $arNews['DELETE_LINK'], CIBlock::GetArrayByID($arNews["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="news__item" id="<?=$this->GetEditAreaId($arNews['ID']);?>">
                <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arNews["PREVIEW_PICTURE"])){?>
                    <div class="news__item-image">
                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arNews["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])){?>
                            <a href="<?=$arNews['DETAIL_PAGE_URL']?>">
                            <img src="<?=$arNews['PREVIEW_PICTURE']['SRC']?>"
                                 alt="<?=$arNews['PREVIEW_PICTURE']['ALT'] ? $arNews['PREVIEW_PICTURE']['ALT'] : $arNews['NAME']?>"
                                 title="<?=$arNews['PREVIEW_PICTURE']['TITLE'] ? $arNews['PREVIEW_PICTURE']['TITLE'] : $arNews['NAME']?>"></a>
                        <?}else{?>
                            <img src="<?=$arNews['PREVIEW_PICTURE']['SRC']?>"
                                 alt="<?=$arNews['PREVIEW_PICTURE']['ALT'] ? $arNews['PREVIEW_PICTURE']['ALT'] : $arNews['NAME']?>"
                                 title="<?=$arNews['PREVIEW_PICTURE']['TITLE'] ? $arNews['PREVIEW_PICTURE']['TITLE'] : $arNews['NAME']?>">
                        <?}?>
                    </div>
                <?}?>
                <div class="news__item-content">
                    <?if($arParams["DISPLAY_DATE"]!="N" && $arNews["DISPLAY_ACTIVE_FROM"]){
                        $arNews['DATE_NEWS'] = explode(' ', $arNews['DISPLAY_ACTIVE_FROM']);?>
                        <div class="news__item-date">
                            <span class="news__item-day"><?=$arNews['DATE_NEWS'][0]?></span>
                            <span class="news__item-mounth"><?=$arNews['DATE_NEWS'][1]?> <?=$arNews['DATE_NEWS'][2]?></span>
                        </div>
                    <?}?>
                    <?if($arParams["DISPLAY_NAME"]!="N" && $arNews["NAME"]){?>
                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arNews["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])){?>
                            <div class="news__name">
                                <a href="<?=$arNews['DETAIL_PAGE_URL']?>"><?=$arNews['NAME']?></a>
                            </div>
                        <?}else{?>
                            <div class="news__name">
                                <?=$arNews['NAME']?>
                            </div>
                        <?}?>
                    <?}?>
                    <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arNews["PREVIEW_TEXT"]){?>
                        <div class="news__anons"><?=$arNews['PREVIEW_TEXT']?></div>
                    <?}?>
                </div>
            </div>
        <?}?>
    </div>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]){?>
        <?=$arResult["NAV_STRING"]?>
    <?}?>
<?}?>