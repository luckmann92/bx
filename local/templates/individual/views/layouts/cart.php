<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
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
        <div class="container">
            <div class="row justify-content-between d-flex align-items-start">
                <div class="col-auto">
                    <h1><?$APPLICATION->ShowTitle(false);?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="container">
            <div class="row row-line">
                <div class="col-12 c-cart">
                    <div class="cart__page">
                        <div class="container">
                            <?=$arParams['CONTENT']?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

