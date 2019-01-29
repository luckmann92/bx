<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<header class="header">
    <nav class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"header-top", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "top",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => $arParams["SETTING"]["TEMPLATE_TYPE"]!="COMPANY"?"top":"company_top",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "header-top",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>
                </div>
                <address class="col-lg-5 header-address d-flex align-items-center justify-content-end">
                    <a href="/contacts/" class="address__link d-flex">
                        <span class="icon__geo"><?=GetIconSVG('address');?></span>
                        <span class="address-value"><?$APPLICATION->IncludeFile(
                                "include/".SITE_ID."/contact/address.php",
                                array(), array(
                                    "SHOW_BORDER" => true,
                                    "MODE" => "text"
                                )
                            );?></span></a>
                </address>
            </div>
        </div>
    </nav>
    <div class="header-middle">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-auto d-flex align-items-center header-logo">
                    <a href="<?=SITE_DIR?>" class="d-flex align-items-center">
                        <?$APPLICATION->IncludeFile('include/'.SITE_ID.'/logo.php',
                            ['SETTING' => $arParams['SETTING']],
                            ['SHOW_BORDER' => false, 'MODE' => 'php']
                        );?>
                    </a>
                </div>
                <div class="col-xl-5 col-lg-auto header-search">
                    <?$APPLICATION->IncludeComponent(
	"bitrix:search.suggest.input", 
	".default", 
	array(
		"DROPDOWN_SIZE" => "10",
		"INPUT_SIZE" => "20",
		"NAME" => "q",
		"VALUE" => "Поиск по сайту",
		"COMPONENT_TEMPLATE" => ".default",
		"COMPOSITE_FRAME_MODE" => "Y",
		"COMPOSITE_FRAME_TYPE" => "STATIC"
	),
	false
);?>
                </div>
                <div class="col-lg-auto header-phone">
                    <?=GetIconSVG('phone')?>
                    <a href="tel:<?$APPLICATION->IncludeFile(
                        "include/".SITE_ID."/contact/phone.php",
                        array(), array(
                            "SHOW_BORDER" => false,
                            "MODE" => "text"
                        )
                    );?>"><?$APPLICATION->IncludeFile(
                            "include/".SITE_ID."/contact/phone.php",
                            array(), array(
                                "SHOW_BORDER" => true,
                                "MODE" => "text"
                            )
                        );?></a>
                </div>
                <div class="col-lg-auto header-callback">
                    <?$APPLICATION->IncludeComponent(
	"website96:forms", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"FORM_BTN_OPEN" => "Заказать звонок",
		"FORM_BTN_SUBMIT" => "Отправить",
		"FORM_BTN_TYPE" => "btn-default",
		"FORM_FIELDS" => array(
			0 => "24",
			1 => "25",
		),
		"FORM_POLITIC_URL" => "/politic/",
		"FORM_PRODUCT_ADD" => "N",
		"FORM_PRODUCT_ID" => "",
		"FORM_REQUIRED_FIELDS" => array(
			0 => "24",
			1 => "25",
		),
		"FORM_TITLE" => "Оставьте заявку",
		"IBLOCK_ID" => "14",
		"IBLOCK_TYPE" => "forms",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
                </div>
            </div>
        </div>
    </div>
    <?if($arParams['SETTING']['TEMPLATE_TYPE'] != 'COMPANY') {?>
        <nav class="header-bottom">
            <div class="container">
                <div class="row row-line"><?$APPLICATION->IncludeFile(
                        "include/".SITE_ID."/header__catalog-menu.php",
                        array(),
                        array(
                            "SHOW_BORDER" => false,
                            "MODE" => "html"
                        )
                    );?>
                </div>
            </div>
        </nav>
    <?}?>
</header>