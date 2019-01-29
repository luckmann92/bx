<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult['ITEMS'] || $arResult['SUB_ITEMS']){?>
    <ul class="catalog__menu">
        <?foreach ($arResult['ITEMS'] as $k => $arItem){?>
            <?if($arItem['TEXT'] || $arItem['LINK']){?>
                <li>
                    <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                </li>
            <?}?>
        <?}?>
        <?if($arResult['SUB_ITEMS']) {?>
            <li class="more__menu">
                <a href="#" class="js-init_more_menu"><span class="menu__dots"></span>Еще</a>
                <ul class="submenu">
                    <?foreach ($arResult['SUB_ITEMS'] as $k => $arItem){?>
                        <?if($arItem['TEXT'] || $arItem['LINK']){?>
                            <li>
                                <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                            </li>
                        <?}?>
                    <?}?>
                </ul>
            </li>
        <?}?>
    </ul>
<?}?>