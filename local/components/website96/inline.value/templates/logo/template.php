<?php
/**
 * @author Danil Syromolotov <ds@itex.ru>
 */
/**
 * @var array $arParams
 */
?>
<a href="<?= $arParams["URL"]; ?>"<? if ($arParams["CSS_CLASS"]): ?> class="<?= $arParams["CSS_CLASS"]; ?>"<? endif; ?>>
    <? if ($arParams["VALUE_IMG"]): ?>
        <img src="<?= $arParams["VALUE_IMG"]; ?>" alt="<?= $arParams["VALUE"]; ?>"/>
    <? else: ?>
        <?= $arParams["VALUE"]; ?>
    <? endif; ?>
</a>
