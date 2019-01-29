<?php
/**
 * @author Mikhail Lukmanov <lukmanof92@gmail.com>
 */
/**
 * @var CMain $APPLICATION
 * @var array $arParams
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$btn = $APPLICATION->GetViewContent('btn');
?>
<div class="page page--inside">
    <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:breadcrumb",
                        ".default", Array(
                        "PATH" => "",
                        "SITE_ID" => "s1",
                        "START_FROM" => "0",
                    ),
                        $component,
                        array('ICON')
                    );?>
                </div>
            </div>
        </div>
    </div>
    <div class="page__head">
        <div class="container <?=$btn ? 'btn__more-line' : ''?>">
            <div class="row justify-content-between d-flex align-items-start">
                <div class="col-auto">
                    <h1><?$APPLICATION->ShowTitle(false);?></h1>
                </div>
                <div class="col-auto"><?=$btn;?></div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="container">
            <div class="row row-line">
                <div class="col-12 c-pin">
                    <?= $arParams["CONTENT"]; ?>
                </div>
            </div>
        </div>
    </div>
</div>