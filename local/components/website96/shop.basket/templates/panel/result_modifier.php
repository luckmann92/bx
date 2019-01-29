<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$basket = new \Website96\Shop\Basket();
$basket->load();
$arResult['ALL_COUNT'] = $basket->getCounts();