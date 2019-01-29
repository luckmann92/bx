<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

$this->setFrameMode(true);

if($arResult['ITEMS']){?>
<section class="section-home section-products section-products__<?=$arParams['SETTING']['HOME_TYPE']?>">
    <div class="section-title">
        <div<?=$arParams['SETTING']['HOME_TYPE'] == 1 ? ' class="container"' : '';?>>
            <div class="row justify-content-md-between justify-content-sm-start align-items-end align-items-md-center">
                <div class="col-auto">
                    <h2><?=$arParams['SECTION_TITLE'] ? $arParams['SECTION_TITLE'] : GetMessage('SECTION_TITLE_DEFAULT')?></h2>
                </div>
                <div class="col-auto">
                    <a href="/catalog/" class="btn btn-link"><?=$arParams['SECTION_LINK'] ? $arParams['SECTION_LINK'] : GetMessage('SECTION_LINK_DEFAULT')?></a>
                </div>
            </div>
        </div>
    </div>

    <div<?=$arParams['SETTING']['HOME_TYPE'] == 1 ? ' class="container"' : '';?>>
        <div class="row justify-content-start">
            <?foreach ($arResult['ITEMS'] as $key => $arProduct){
                $this->AddEditAction($arProduct['ID'], $arProduct['EDIT_LINK'], CIBlock::GetArrayByID($arProduct["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arProduct['ID'], $arProduct['DELETE_LINK'], CIBlock::GetArrayByID($arProduct["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="product__item col-lg-3 col-md-4 col-sm-6 col-12 <?=$arProduct['PRODUCT_LABEL']?>" id="<?=$this->GetEditAreaId($arProduct['ID']);?>">
                    <div class="product__item-image">
                        <a href="<?=$arProduct['DETAIL_PAGE_URL']?>" class="product__item-link">
                            <img src="<?=$arProduct['PREVIEW_PICTURE']['SRC']?>"
                                 alt="<?=$arProduct['PREVIEW_PICTURE']['ALT'] ? $arProduct['PREVIEW_PICTURE']['ALT'] : $arProduct['NAME']?>"
                                 title="<?=$arProduct['PREVIEW_PICTURE']['TITLE'] ? $arProduct['PREVIEW_PICTURE']['TITLE'] : $arProduct['NAME']?>">
                        </a>
                    </div>
                    <div class="product__item-desc">
                        <a href="<?=$arProduct['DETAIL_PAGE_URL']?>" class="product__item-name"><?=$arProduct['NAME']?></a>
                        <?if(is_array($arProduct['PARENT_SECTION'])){?>
                            <a href="<?=$arProduct['PARENT_SECTION']['SECTION_PAGE_URL']?>" class="product__item-category"><?=$arProduct['PARENT_SECTION']['NAME']?></a>
                        <?}?>
                    </div>

                    <div class="product__item-action">
                        <?if(strlen($arProduct['PROPERTIES']['PRODUCT_PRICE']['VALUE']) > 0){?>
                            <div class="product__item-price">
                                <div class="product-price price__new"><?=$arProduct['PROPERTIES']['PRODUCT_PRICE']['VALUE']?></div>

                                <?if(strlen($arProduct['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE']) > 0){?>
                                    <div class="product-price price__old"><?=$arProduct['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE']?></div>
                                <?}?>
                            </div>
                        <?}?>
                        <?if ($arProduct['ALLOW_ADD_BASKET'] == 'Y') {?>
                            <?if (isset($_SESSION['BasketItems'][$arProduct['ID']]) && $_SESSION['BasketItems'][$arProduct['ID']]['quantity'] > 0) {?>
                                <button data-id="<?=$arProduct['ID']?>"
                                        class="product__item-btn btn-primary btn-added btn js-init-add__cart">Оформить</button>
                            <?} else {?>
                                <button data-id="<?=$arProduct['ID']?>"
                                        class="product__item-btn btn-default btn js-init-add__cart">В корзину</button>
                            <?}?>
                        <?}?>
                    </div>

                    <?/*if(strlen($arProduct['PROPERTIES']['PRODUCT_PRICE']['VALUE']) > 0){*/?><!--
                        <div class="product__item-price">
                            <div class="product-price price__new"><?/*=number_format($arProduct['PROPERTIES']['PRODUCT_PRICE']['VALUE'], 0, '', ' ')*/?></div>

                            <?/*if(strlen($arProduct['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE']) > 0){*/?>
                                <div class="product-price price__old"><?/*=number_format($arProduct['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE'], 0, '', ' ')*/?></div>
                            <?/*}*/?>
                        </div>
                    <?/*}*/?>
                    <div class="product__item-buy">
                        <button class="js-init-add__cart btn-primary btn" data-id="<?/*=$arProduct['ID']*/?>" data-price="<?/*=$arProduct['PROPERTIES']['PRODUCT_PRICE']['VALUE']*/?>">В корзину</button>
                    </div>-->
                </div>
            <?}?>
        </div>
    </div>
</section>
<?}?>
