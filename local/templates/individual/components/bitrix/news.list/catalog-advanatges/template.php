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
    <div class="col-12 catalog-advantages">
        <div class="row">
            <?foreach ($arResult['ITEMS'] as $k => $arAdvantage){?>
                <?
                $this->AddEditAction($arAdvantage['ID'], $arAdvantage['EDIT_LINK'], CIBlock::GetArrayByID($arAdvantage["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arAdvantage['ID'], $arAdvantage['DELETE_LINK'], CIBlock::GetArrayByID($arAdvantage["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="col-lg-3 col-sm-6 advantage-item" id="<?=$this->GetEditAreaId($arAdvantage['ID']);?>">
                    <div class="row justify-content-start align-items-start">
                        <div class="col-auto advantage__icon">
                            <? if(stristr($arAdvantage['DISPLAY_PROPERTIES']['ICON_FILE']['FILE_VALUE']['CONTENT_TYPE'], 'svg')){
                                echo file_get_contents($_SERVER['DOCUMENT_ROOT'].$arAdvantage['DISPLAY_PROPERTIES']['ICON_FILE']['FILE_VALUE']['SRC']);
                            } else {
                                echo '<img style="max-width:41px;max-height:41px;height:auto;width:auto;" src="'.$arAdvantage['DISPLAY_PROPERTIES']['ICON_FILE']['FILE_VALUE']['SRC'].'" alt="'.$arAdvantage['NAME'].'">';
                            }?>
                        </div>
                    </div>
                    <div class="row justify-content-start align-items-start">
                        <div class="col-12">
                            <span class="advantage-item__name"><?=$arAdvantage['NAME']?></span>
                        </div>
                    </div>
                </div>
            <?}?>
        </div>
    </div>
<?}?>
