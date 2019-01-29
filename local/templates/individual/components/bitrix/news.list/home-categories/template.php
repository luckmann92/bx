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
<?if($arResult['SECTIONS']){?>
<section class="section-categories">
    <div class="categories__title">
        <div class="container">
            <div class="row row-line">
                <h2 class="section__title">Популярные категории</h2>
                <a href="/catalog/" class="btn-link"><?=GetMessage('LINK_TO_CATALOG')?><?=GetIconSVG('arrow_long_right')?></a>
            </div>
        </div>
    </div>
    <div class="categories__list">
        <div class="container">
            <div class="row row-line">
                <?
                $arResult['SECTIONS'] = array_chunk($arResult['SECTIONS'], 3);
                $index = 1;
                foreach($arResult['SECTIONS'] as $key => $arGroups){?>
                    <div class="categories__group">
                        <?$ind = 1;?>
                        <?foreach ($arGroups as $k => $arSection){?>
                            <?if($index == 1){?>
                                <div class="category__block <?=$ind < 3 ? 'category__quad' : 'category__horizontal'?>">
                                    <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="category__item" style="background-image: url(<?=$arSection['PICTURE']?>)">
                                        <span class="category__name"><?=$arSection['NAME']?></span>
                                    </a>
                                </div>
                            <?} elseif($index == 2) {?>
                                <div class="category__block <?=$ind == 1 ? 'category__vertical' : 'category__quad'?>">
                                    <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="category__item" style="background-image: url(<?=$arSection['PICTURE']?>)">
                                        <span class="category__name"><?=$arSection['NAME']?></span>
                                    </a>
                                </div>
                            <?} else {
                                break;
                            }?>
                            <?$ind++;?>
                        <?}?>
                    </div>
                    <?$index++;?>
                <?}?>
            </div>
        </div>
    </div>
</section>
<?}?>
