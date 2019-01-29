<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

?>

<button class="cart__panel-show">
    <?if ($arResult['ALL_COUNT']) {?>
        <span class="cart__items-count"><?=$arResult['ALL_COUNT']?></span>
    <?}?>
</button>

