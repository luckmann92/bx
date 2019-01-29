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

if($arResult['ITEMS']){
    $APPLICATION->IncludeComponent(
	"website96:sort.panel", 
	".default", 
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"FIELDS_CODE" => array(
			0 => "name",
			1 => "show_counter",
		),
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "base",
		"INCLUDE_SORT_TO_SESSION" => "Y",
		"ORDER_NAME" => "ORDER",
		"PRICE_CODE" => array(
		),
		"PROPERTY_CODE" => array(
			0 => "PRODUCT_PRICE",
		),
		"SORT_NAME" => "SORT",
		"SORT_ORDER" => array(
			0 => "asc",
			1 => "desc",
		),
		"COMPONENT_TEMPLATE" => ".default",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>

    <div class="row">
        <?foreach ($arResult['ITEMS'] as $key => $arProduct){
            $this->AddEditAction($arProduct['ID'], $arProduct['EDIT_LINK'], CIBlock::GetArrayByID($arProduct["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arProduct['ID'], $arProduct['DELETE_LINK'], CIBlock::GetArrayByID($arProduct["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="col-sm-6 col-lg-4 col-12 product__item  <?=$arProduct['PRODUCT_LABEL']?>" id="<?=$this->GetEditAreaId($arProduct['ID']);?>">
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
                    <?

                    if ($arProduct['ALLOW_ADD_BASKET'] == 'Y') {?>
                        <?if (isset($_SESSION['BasketItems'][$arProduct['ID']]) && $_SESSION['BasketItems'][$arProduct['ID']]['quantity'] > 0) {?>
                            <button data-id="<?=$arProduct['ID']?>"
                                    class="product__item-btn btn-primary btn-added btn js-init-add__cart">Оформить</button>
                        <?} else {?>
                            <button data-id="<?=$arProduct['ID']?>"
                                    class="product__item-btn btn-default btn js-init-add__cart">В корзину</button>
                        <?}?>
                    <?}?>
                </div>
            </div>
        <?}?>
    </div>
    <?if($arResult['NAV_STRING']){?>
        <div class="product__nav">
            <?=$arResult['NAV_STRING']?>
        </div>
    <?}?>
<?} elseif($arResult['SECTIONS'] > 0 || $arResult['DESCRIPTION']) {?>
    <div class="pin"><?=$arResult['DESCRIPTION']?></div>
<?} else {?>
    <div class="row">
        <div class="col-auto">
            <p>В данном разделе товаров нет.</p>
            <a class="btn btn-link" href="<?=$arParams['SEF_FOLDER'] ? $arParams['SEF_FOLDER'] : '/catalog/'?>">Вернуться в каталог</a>
        </div>
    </div>
<?}?>
