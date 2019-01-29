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

if($arResult['ITEMS']){?>
    <section class="section-slider">
        <div class="slider-home">
            <?foreach ($arResult['ITEMS'] as $k => $arSlide){
                $this->AddEditAction($arSlide['ID'], $arSlide['EDIT_LINK'], CIBlock::GetArrayByID($arSlide["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arSlide['ID'], $arSlide['DELETE_LINK'], CIBlock::GetArrayByID($arSlide["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="slide-item slide-item__<?=$arParams['SETTING']['HOME_TYPE']?><?=$arSlide['PROPERTIES']['SLIDE_SHADOW']['VALUE_XML_ID'] == 'Y' ? ' c-shadow' : ''?>"
                     style="background-image: url(<?=$arSlide['PREVIEW_PICTURE']['SRC']?>);"
                     id="<?=$this->GetEditAreaId($arSlide['ID']);?>">
                    <div class="container">
                        <div class="row">
                            <div class="slide-item__caption slide-item__caption__<?=$arParams['SETTING']['HOME_TYPE']?> <?=$arParams['SETTING']['HOME_TYPE'] == 1 ? 'col-lg-5 col-md-8':'col-12'?>">
                                <div class="section-title c-<?=$arSlide['PROPERTIES']['SLIDE_TITLE_THEME']['VALUE_XML_ID']?>">
                                    <h2><?=$arSlide['NAME']?></h2>
                                </div>
                                <?if($arSlide['PREVIEW_TEXT']){?>
                                    <p class="slide-item__anons c-<?=$arSlide['PROPERTIES']['SLIDE_TITLE_THEME']['VALUE_XML_ID']?>"><?=$arSlide['PREVIEW_TEXT']?></p>
                                <?}?>
                                <?if($arSlide['PROPERTIES']['LINK_SECTION']['VALUE']){?>
                                    <a href="<?=$arSlide['PROPERTIES']['LINK_SECTION']['VALUE']?>" target="_blank" class="btn btn-primary b-<?=$arSlide['PROPERTIES']['SLIDE_TITLE_THEME']['VALUE_XML_ID']?>">
                                        <?=$arSlide['PROPERTIES']['LINK_BUTTON_NAME']['VALUE'] ? $arSlide['PROPERTIES']['LINK_BUTTON_NAME']['VALUE'] : GetMessage('LINK_MORE')?>
                                    </a>
                                <?}?>
                            </div>
                        </div>
                    </div>
                </div>
            <?}?>
        </div>
        <?if(count($arResult['ITEMS']) > 1){?>
            <div class="slider-dots slider-dots__<?=$arParams['SETTING']['HOME_TYPE']?>">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-auto">
                            <div class="slider-home-dots"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?}?>
    </section>
    <script>
        $('.slider-home').slick({
            dots: <?=count($arResult['ITEMS']) > 0 ? 'true':'false'?>,
            arrows: true,
            autoplay: <?=$arParams['SLIDER_AUTOPLAY'] == 'Y'?'true':'false'?>,
            <?=$arParams['SLIDER_TIME'] > 0 ?'autoplaySpeed:'.$arParams['SLIDER_TIME'].',':''?>
            appendDots: $('.slider-home-dots'),
            prevArrow: '<button type="button" class="slide-prev slick-prev"></button>',
            nextArrow: '<button type="button" class="slide-next slick-next"></button>',
            adaptiveHeight: true,
            responsive:[
                {
                    breakpoint: 750,
                    settings: {
                        dots: false
                    }
                }
            ]
        });
    </script>
<?}?>
