<?php
/**
 * @author Danil Syromolotov <ds@itex.ru>
 */
/**
 * @var CBitrixComponent         $component
 * @var CMain                    $APPLICATION
 * @var array                    $arParams
 * @var array                    $arResult
 * @var CBitrixComponentTemplate $this
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$labelProduct = is_array($arResult['PROPERTIES']['PRODUCT_LABEL']['VALUE_XML_ID']) ? 'label__' . $arResult['PROPERTIES']['PRODUCT_LABEL']['VALUE_XML_ID'][0] : false;
?>
<div class="row justify-content-between <?=$labelProduct?> product-detail" id="<?=$this->GetEditAreaId($arResult['ID'])?>">
    <div class="col-lg-5 col-md-7">
        <div class="row product-images">
            <?if(is_array($arResult['MORE_IMAGES'])){?>
                <?if(count($arResult['MORE_IMAGES']) > 1){?>
                    <div class="col-lg-3 col-md-3 product-images__nav js-init-product-images__nav">
                        <?foreach ($arResult['MORE_IMAGES'] as $k => $arImage){?>
                            <div class="product-image__nav">
                                <img src="<?=$arImage['RESIZE_MIN_SRC']?>"
                                     alt="<?=$arImage['ALT']?>"
                                     title="<?=$arImage['TITLE']?>">
                            </div>
                        <?}?>
                    </div>
                <?}?>
                <?$col = count($arResult['MORE_IMAGES']) <= 1 ? '12' : '9';?>
                <div class="col-lg-<?=$col?> col-md-<?=$col?> <?=$col == 9 ? 'js-init-product-images__main' : ''?>">
                    <?foreach ($arResult['MORE_IMAGES'] as $k => $arImage){?>
                        <a href="<?=$arImage['ORIGINAL_SRC']?>"
                           rel="image__group"
                           style="background-image:url(<?=$arImage['RESIZE_FULL_SRC']?>)"
                           class="product-images__main image-main__item hrefpop"></a>
                    <?}?>
                </div>
            <?}?>
        </div>
    </div>
    <div class="col-lg-6 offset-lg-1 col-md-5">
        <div class="product__description">
            <div class="row justify-content-lg-between justify-content-center align-items-center">
                <div class="col-auto product__column">
                    <div class="row align-content-end justify-content-start">
                        <?if($arResult['PROPERTIES']['PRODUCT_PRICE']['VALUE']){?>
                            <div class="col-auto">
                                <span class="product-price price__new"><?=$arResult['PROPERTIES']['PRODUCT_PRICE']['VALUE']?></span>
                                <?if($arResult['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE']){?>
                                    <span class="product-price price__old"><?=$arResult['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE']?></span>
                                <?}?>
                            </div>
                        <?}?>
                    </div>
                    <div class="row">
                        <?if($arResult['PROPERTIES']['PRODUCT_STATUS']['VALUE_XML_ID'] != NULL){?>
                            <div class="col-auto">
                                <span class="product__status <?=$arResult['PROPERTIES']['PRODUCT_STATUS']['VALUE_XML_ID']?>">
                                    <?=$arResult['PROPERTIES']['PRODUCT_STATUS']['VALUE']?>
                                </span>
                            </div>
                        <?}?>
                    </div>
                </div>
                <div class="col-auto product__column">
                    <?$APPLICATION->IncludeComponent(
	"website96:forms", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"FORM_BTN_OPEN" => "Быстрый заказ",
		"FORM_BTN_SUBMIT" => "Оформить заказ",
		"FORM_FIELDS" => array(
			0 => "21",
			1 => "22",
			2 => "23",
		),
		"FORM_REQUIRED_FIELDS" => array(
			0 => "22",
			1 => "23",
		),
		"FORM_TITLE" => "Оформление заказа",
		"IBLOCK_ID" => "13",
		"IBLOCK_TYPE" => "forms",
		"COMPONENT_TEMPLATE" => ".default",
		"FORM_BTN_TYPE" => "btn-default",
		"FORM_PRODUCT_ADD" => "Y",
		"FORM_POLITIC_URL" => "/politic/",
		"FORM_PRODUCT_ID" => $arResult["ID"],
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
                    <a href="#" class="js-init-modal_show btn-btn_fill" style="display: none" data-product-id="<?=$arResult['ID']?>" data-modal="fast_orders">Заказать</a>
                </div>
            </div>
            <?if($arResult['PREVIEW_TEXT'] || is_array($arResult['PROPERTIES']['PRODUCT_OPTIONS']['VALUE'])){?>
                <div class="product__tabs">
                    <ul class="product__tabs-head">
                        <?if($arResult['PREVIEW_TEXT']){?>
                            <li class="tab__name active">Описание</li>
                        <?}?>
                        <?if(is_array($arResult['PROPERTIES']['PRODUCT_OPTIONS']['VALUE'])){?>
                            <li class="tab__name <?=$arResult['PREVIEW_TEXT'] ? '' : 'active';?>"><?=$arResult['PROPERTIES']['PRODUCT_OPTIONS']['NAME']?></li>
                        <?}?>
                    </ul>
                    <div class="product__tabs-content">
                        <?if($arResult['PREVIEW_TEXT']){?>
                            <div class="tab__content active"><?=$arResult['PREVIEW_TEXT'] ? $arResult['PREVIEW_TEXT'] : $arResult['DETAIL_TEXT']?></div>
                        <?}?>
                        <?if(is_array($arResult['PROPERTIES']['PRODUCT_OPTIONS']['VALUE'])){?>
                            <div class="tab__content <?=$arResult['PREVIEW_TEXT'] ? '' : 'active';?>">
                                <div class="product__options-list">
                                    <?foreach ($arResult['PROPERTIES']['PRODUCT_OPTIONS']['VALUE'] as $key => $optionName){?>
                                        <?if($arResult['PROPERTIES']['PRODUCT_OPTIONS']['DESCRIPTION'][$key]){?>
                                            <div class="option__row">
                                                <div class="option__name"><?=$optionName?></div>
                                                <div class="option__value"><?=$arResult['PROPERTIES']['PRODUCT_OPTIONS']['DESCRIPTION'][$key]?></div>
                                            </div>
                                        <?}?>
                                    <?}?>
                                </div>
                            </div>
                        <?}?>
                    </div>
                </div>
            <?}?>
        </div>
    </div>
</div>

<?if($arResult['DETAIL_TEXT']){?>
    <div class="product__detail-description">
        <?=$arResult['DETAIL_TEXT']?>
    </div>
<?}?>
<?if(is_array($arResult['PROPERTIES']['PRODUCT_RECOMMENDED']['ITEMS'])){?>
    <div class="product__recommended">
        <h2><?=$arResult['PROPERTIES']['PRODUCT_RECOMMENDED']['NAME']?></h2>
        <div class="product__list">
            <div class="row">
                <?foreach ($arResult['PROPERTIES']['PRODUCT_RECOMMENDED']['ITEMS'] as $key => $arProduct){
                    $this->AddEditAction($arProduct['ID'], $arProduct['EDIT_LINK'], CIBlock::GetArrayByID($arProduct["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arProduct['ID'], $arProduct['DELETE_LINK'], CIBlock::GetArrayByID($arProduct["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                    $labelProduct = is_array($arProduct['PROPERTIES']['PRODUCT_LABEL']['VALUE_XML_ID']) ? 'label__' . $arProduct['PROPERTIES']['PRODUCT_LABEL']['VALUE_XML_ID'][0] : false;
                    ?>
                    <div class="product__item col-sm-6 col-md-4  col-lg-3 <?=$labelProduct?>" id="<?$this->GetEditAreaId($arProduct['ID'])?>">
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
                        <?if(strlen($arProduct['PROPERTIES']['PRODUCT_PRICE']['VALUE']) > 0){?>
                            <div class="product__item-price">
                                <div class="product-price price__new"><?=number_format($arProduct['PROPERTIES']['PRODUCT_PRICE']['VALUE'], 0, '', ' ')?></div>

                                <?if(strlen($arProduct['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE']) > 0){?>
                                    <div class="product-price price__old"><?=number_format($arProduct['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE'], 0, '', ' ')?></div>
                                <?}?>
                            </div>
                        <?}?>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
<?}?>
    <script>
        $('.js-init-product-images__nav').slick({
            autoplay: false,
            arrows: false,
            slidesToShow: 4,
            vertical: true,
            verticalSwiping: true,
            slidesToScroll: 1,
            focusOnSelect: true,
            asNavFor: '.js-init-product-images__main',
            dots: false,
            prevArrow: '<button type="button" class="product-detail__prev slick-prev"></button>',
            nextArrow: '<button type="button" class="product-detail__next slick-next"></button>',
            responsive:[
                {
                    breakpoint: 768,
                    settings: {
                        vertical: false,
                        slidesToShow: 4
                    }
                }
            ]
        });
        $('.js-init-product-images__main').slick({
            slidesToShow: 1,
            autoplay: false,
            fade: true,
            slidesToScroll: 1,
            arrows:false,
            asNavFor: '.js-init-product-images__nav'
        });
    </script>
<?
/*
echo '<pre>';
var_dump($arResult['MORE_IMAGES']);
echo '</pre>';*/