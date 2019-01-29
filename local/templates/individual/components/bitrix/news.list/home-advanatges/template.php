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
<section class="section-advantages section-advantages__<?=$arParams['SETTING']['HOME_TYPE']?>">
    <div class="advantages__wrapper">
        <div class="advantage__list">
            <div class="container">
                <div class="row">
                    <?foreach ($arResult['ITEMS'] as $k => $arItem){?>
                        <?
                       // dump($arItem);
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="col-lg-3 col-sm-6 col-12 advantage__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <div class="row justify-content-start align-items-center">
                                <div class="advantage__icon align-items-center <?=$arParams['SETTING']['HOME_TYPE'] != 2 ? 'col-3' : ''?>">
                                    <img src="<?= $arItem['DISPLAY_PROPERTIES']['ICON_FILE']['FILE_VALUE']['SRC'] ?>" alt="<?= $arItem['NAME'] ?>">
                                </div>
                                <div class="advantage__name <?=$arParams['SETTING']['HOME_TYPE'] != 2 ? 'col-9' : ''?>">
                                    <span><?=$arItem['NAME']?></span>
                                </div>
                            </div>
                        </div>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
</section>
<?}?>
