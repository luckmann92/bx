<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if($arResult['SECTIONS']){?>
    <div class="row">
        <?foreach ($arResult['SECTIONS'] as $key => $arSection){?>
            <?
            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT"));
            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="col-sm-6 col-lg-4">
                <a class="sub__category" href="<?=$arSection['SECTION_PAGE_URL']?>" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                    <div class="sub__category-image">
                        <img src="<?=$arSection['PICTURE']['SRC']?>"
                             alt="<?=$arSection['PICTURE']['ALT'] ? $arSection['PICTURE']['ALT'] : $arSection['NAME']?>"
                             title="<?=$arSection['PICTURE']['TITLE'] ? $arSection['PICTURE']['TITLE'] : $arSection['NAME']?>">
                    </div>
                    <div class="sub__categoty-name"><?=$arSection['NAME']?></div>
                </a>
            </div>
        <?}?>
    </div>
<?}?>
<?
$this->SetViewTarget("countSubCats");
echo (count($arResult['SECTIONS']));
$this->EndViewTarget();
?>
