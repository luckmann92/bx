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
    <?$this->SetViewTarget('btn');?>
	<div class="d-flex align-items-center">
        <?$APPLICATION->IncludeComponent(
	"website96:forms", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"FORM_BTN_OPEN" => "Оставить отзыв",
		"FORM_BTN_SUBMIT" => "Отправить",
		"FORM_BTN_TYPE" => "btn-primary",
		"FORM_FIELDS" => array(
			0 => "18",
			1 => "19",
			2 => "20",
		),
		"FORM_POLITIC_URL" => "/politic/",
		"FORM_PRODUCT_ADD" => "N",
		"FORM_PRODUCT_ID" => "",
		"FORM_REQUIRED_FIELDS" => array(
			0 => "18",
			1 => "19",
		),
		"FORM_TITLE" => "Добавление отзыва",
		"IBLOCK_ID" => "12",
		"IBLOCK_TYPE" => "forms",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
	</div>
    <?$this->EndViewTarget();?>
	<div class="row">
		<?foreach ($arResult['ITEMS'] as $key => $arReview){?>
			<?
			$this->AddEditAction($arReview['ID'], $arReview['EDIT_LINK'], CIBlock::GetArrayByID($arReview["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arReview['ID'], $arReview['DELETE_LINK'], CIBlock::GetArrayByID($arReview["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="col-lg-6 col-12" id="<?=$this->GetEditAreaId($arReview['ID']);?>">
				<div class="review__item">
					<div class="review__item-head">
					<div class="item-top__left">
						<div class="review__image review-nav__image" style="background-image: url(<?=$arReview['PREVIEW_PICTURE']['SRC']?>")"></div>
					</div>
                    <div class="item-top__right">
                        <div class="review-client__name"><?=$arReview['NAME']?></div>

                        <?if($arReview['PROPERTIES']['REVIEW_CLIENT_ADD_OPTION']){?>
                            <div class="review-client__optional"><?=$arReview['PROPERTIES']['REVIEW_CLIENT_ADD_OPTION']['VALUE']?></div>
                        <?}?>
                    </div>
				</div>
				<div class="review__item-content"><?=$arReview['PREVIEW_TEXT']?></div>
				</div>
			</div>
		<?}?>
	</div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]){?>
        <?=$arResult["NAV_STRING"]?>
    <?}?>
<?}?>