<?php
/**
 * @author Mikhail Lukmanov <lukmanof92@gmail.com>
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (empty($arResult)) {
    return;
}
ob_start();
?>
<? foreach ($arResult as $key => $arLink): ?>
    <? if ($key != 0): ?>
        <span class="sep">/</span>
    <? endif; ?>
    <? if ($key == count($arResult) - 1): ?>
        <span><?= $arLink["TITLE"]; ?></span>
    <? else: ?>
        <a href="<?= $arLink["LINK"]; ?>"><?= $arLink["TITLE"]; ?></a>
    <? endif; ?>
<? endforeach; ?>
<? return ob_get_clean(); ?>