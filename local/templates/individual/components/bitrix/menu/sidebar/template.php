<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)){?>
    <ul class="catalog__menu sidebar__menu">
<?
$previousLevel = 0;
foreach($arResult as $arItem){
    if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel){
        echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
    }
	if ($arItem["IS_PARENT"]){
        if ($arItem["DEPTH_LEVEL"] == 1) {?>
            <li<?=$arItem["SELECTED"] ? ' class="active"' : '';?>>
                <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                    <ul class="submenu">
        <?
        } else {
        ?>
            <li<?=$arItem["SELECTED"] ? ' class="active"' : '';?>>
                <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                    <ul class="sub__submenu">
        <?
        }
    } else {
        ?>
        <li<?=$arItem["SELECTED"] ? ' class="active"' : '';?>>
            <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
    <?
    }
    $previousLevel = $arItem["DEPTH_LEVEL"];
}
if ($previousLevel > 1){
    echo str_repeat("</ul></li>", ($previousLevel-1));
}?>
                    </ul>
                <?}?>