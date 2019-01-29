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
<section class="section-news section-news__<?=$arParams['SETTING']['HOME_TYPE']?> section-news__<?=mb_strtolower($arParams['SETTING']['TEMPLATE_TYPE'])?>" <?=$arParams['BG_IMAGE'] && ($arParams['SETTING']['HOME_TYPE'] == 1) ? 'style="background-image:url('.$arParams['BG_IMAGE'].');"' : '';?>>
    <div class="section-title <?=$arParams['SETTING']['HOME_TYPE'] == 1 ? 'c-white' : ''?>">
        <div<?=$arParams['SETTING']['HOME_TYPE'] == 1 ? ' class="container"' : ''?>>
            <div class="row justify-content-md-between justify-content-sm-start align-items-end align-items-md-center">
                <div class="col-auto">
                    <h2><?=$arParams['SECTION_TITLE'] ? $arParams['SECTION_TITLE'] : GetMessage('SECTION_TITLE')?></h2>
                </div>
                <div class="col-auto">
                    <a href="/news/" class="btn btn-link"><?=$arParams['SECTION_LINK'] ? $arParams['SECTION_LINK'] : GetMessage('SECTION_LINK_DEFAULT')?></a>
                </div>
            </div>
        </div>
    </div>
    <div class="news__wrapper">
        <div class="news__list">
            <div<?=$arParams['SETTING']['HOME_TYPE'] == 1 ? ' class="container"' : ''?>>
                <div class="row">
                    <?foreach ($arResult['ITEMS'] as $k => $arItem){?>
                        <?
                        $arItem['DATE_NEWS'] = explode(' ', $arItem['DISPLAY_ACTIVE_FROM']);

                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="col-md-4 col-12">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="news__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <div class="news__item-date">
                                    <span class="news__item-day"><?=$arItem['DATE_NEWS'][0]?></span>
                                    <span class="news__item-mounth"><?=$arItem['DATE_NEWS'][1]?> <?=$arItem['DATE_NEWS'][2]?></span>
                                </div>
                                <div class="news__name">
                                    <span><?=$arItem['NAME']?></span>
                                </div>
                            </a>
                        </div>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
</section>
<?}?>
