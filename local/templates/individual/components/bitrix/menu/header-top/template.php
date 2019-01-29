<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)){?>
    <ul class="header-top_navbar">
        <?foreach ($arResult as $arItem){?>
            <li <?=$arItem["SELECTED"] ? 'class="active"' : ''?>>
                <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            </li>
        <?}?>
    </ul>
<?}?>