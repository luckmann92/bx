<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<section class="section-home section-categories section-categories__<?=$arParams['SETTING']['HOME_TYPE']?>">
    <?if($APPLICATION->GetCurPage(false) === '/'){?>
        <div class="section-title">
            <div<?=$arParams['SETTING']['HOME_TYPE'] == 1 ? ' class="container"' : '';?>>
                <div class="row justify-content-md-between justify-content-sm-start align-items-end align-items-md-center">
                    <div class="col-auto">
                        <h2><?=$arParams['SECTION_TITLE'] ? $arParams['SECTION_TITLE'] : GetMessage('CATEGORIES_SECTION_TITLE_DEFAULT')?></h2>
                    </div>
                    <div class="col-auto">
                        <a href="/catalog/" class="btn btn-link"><?=$arParams['SECTION_LINK'] ? $arParams['SECTION_LINK'] : GetMessage('CATEGORIES_SECTION_LINK_DEFAULT')?></a>
                    </div>
                </div>
            </div>
        </div>
    <?}?>
    <div<?=$arParams['SETTING']['HOME_TYPE'] == 1 ? ' class="container"' : '';?>>
        <div class="container-section">
            <?$i = 1;
            foreach ($arResult['SECTIONS'] as $arSection){
                $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
                <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="section-item item-<?=$i?>" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                    <div class="section-item__image">
                        <img src="<?=$arSection['PICTURE']['SRC']?>"
                             alt="<?=$arSection['PICTURE']['ALT'] ? $arSection['PICTURE']['ALT'] : $arSection['NAME']?>"
                             title="<?=$arSection['PICTURE']['TITLE'] ? $arSection['PICTURE']['TITLE'] : $arSection['NAME']?>">
                    </div>
                    <div class="section-item__name"><?=$arSection['NAME']?></div>
                </a>
            <?$i++;
            }?>
        </div>
    </div>
</section>