<?php
/**
 * @author Danil Syromolotov <ds@itex.ru>
 */
/**
 * @var array $arParams
 */

?>
<section class="section-about section-about__<?=$arParams['SETTING']['HOME_TYPE']?> section-about__<?=mb_strtolower($arParams['SETTING']['TEMPLATE_TYPE']);?>">
    <div<?=$arParams['SETTING']['HOME_TYPE'] == 1 ? ' class="container"' : '';?>>
        <div class="about-item">
            <div class="row">
                <?if($arParams['BLOCK_IMG']){?>
                    <div class="<?=$arParams['SETTING']['HOME_TYPE'] == 2 ? 'col-12' : 'col-lg-5 col-md-4 col-sm-12'?> about-item__img" style="background-image: url(<?=$arParams['BLOCK_IMG']?>)"></div>
                <?}?>
                <div class="<?=$arParams['BLOCK_IMG'] && ($arParams['SETTING']['HOME_TYPE'] != 2) ? 'col-lg-7 col-md-8 col-sm-12' : 'col-12 '?> about-item_content">
                    <div class="section-title">
                        <h2><?=$arParams['BLOCK_TITLE'] ? $arParams['BLOCK_TITLE'] : GetMessage('CATEGORIES_SECTION_TITLE_DEFAULT')?></h2>
                    </div>
                    <div class="about-item__text"><?if($arParams['BLOCK_DESCRIPTION'] == "Y"){
                            $APPLICATION->IncludeFile(
                                "include/".SITE_ID."/home-about.php",
                                array(), array(
                                    "SHOW_BORDER" => true,
                                    "MODE" => "html"
                                )
                            );
                        }?></div>
                    <?if($arParams['BLOCK_URL']){?>
                        <a href="<?=$arParams['BLOCK_URL']?>" class="btn btn-link"><?=GetMessage('CATEGORIES_SECTION_LINK_DEFAULT')?></a>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
</section>
