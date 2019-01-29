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

<div class="container-section catalog-section">
    <? foreach ($arResult['SECTIONS'] as $k => $arSection) {
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT"));
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'))); ?>
            <a href="<?= $arSection['SECTION_PAGE_URL'] ?>" class="section-item" id="<?=$this->GetEditAreaId($arSection['ID']); ?>">
                <div class="section-item__image">
                    <img src="<?=$arSection['PICTURE']['SRC']?>"
                         alt="<?=$arSection['PICTURE']['ALT'] ? $arSection['PICTURE']['ALT'] : $arSection['NAME']?>">
                </div>
                <div class="section-item__name"><?= $arSection['NAME'] ?></div>
            </a>
    <? } ?>
</div>