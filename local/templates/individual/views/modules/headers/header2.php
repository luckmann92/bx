<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<header class="type__sidebar">
    <?
    $APPLICATION->ShowPanel();
    $APPLICATION->IncludeFile("views/modules/responsive_menu.php", array(), array(
        "SHOW_BORDER" => false,
        "MODE" => "php",
    ));
    ?>
    <div class="header-middle">
        <div class="container">
            <div class="row row-line">
                <button class="js-init-responsive__menu menu__button"></button>
                <div class="header-logo">
                    <?$APPLICATION->IncludeFile('include/'.SITE_ID.'/logo.php',
                        ['SETTING' => $arParams['SETTING']],
                        ['SHOW_BORDER' => false, 'MODE' => 'php']
                    );?>
                </div>
                <div class="header-search">
                    <?$APPLICATION->IncludeComponent(
	"bitrix:search.suggest.input",
	".default",
	array(
		"DROPDOWN_SIZE" => "10",
		"INPUT_SIZE" => "20",
		"NAME" => "q",
		"VALUE" => "Поиск по каталогу",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
                </div>
                <div class="header-address header__info-block">
                    <span class="icon__geo"><?=GetIconSVG('geo');?></span>
                    <span class="header-address__address"><?$APPLICATION->IncludeFile(
                            "include/".SITE_ID."/contact/address.php",
                            array(
                                "SHOW_BORDER" => true,
                                "MODE" => "html"
                            )
                        );?></span>
                </div>
                <div class="header-phone header__info-block">
                    <?$APPLICATION->IncludeComponent(
	"website96:forms", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"FORM_BTN_OPEN" => "Заказать звонок",
		"FORM_BTN_SUBMIT" => "Отправить",
		"FORM_BTN_TYPE" => "icon__phone",
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
                    <span class="header-phone__column"><a href="tel:+790000000" class="phone__number-link"><?$APPLICATION->IncludeFile(
                            "include/".SITE_ID."/contact/phone.php",
                            array(
                                "SHOW_BORDER" => true,
                                "MODE" => "html"
                            )
                        );?></a>
                        <?$APPLICATION->IncludeComponent(
	"website96:forms", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"FORM_BTN_OPEN" => "Заказать звонок",
		"FORM_BTN_SUBMIT" => "Отправить",
		"FORM_BTN_TYPE" => "callback__link",
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
    <nav class="header-bottom">
        <div class="container">
            <div class="row row-line">
                <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"header-top",
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "top",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => "",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "top",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "header-catalog",
		"MAX_ITEMS" => "5"
	),
	false
);?>
                <div class="search__adaptive">
                    <div class="header-search">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:search.suggest.input",
                            "",
                            array(
                                "DROPDOWN_SIZE" => "10",
                                "INPUT_SIZE" => "20",
                                "NAME" => "q",
                                "VALUE" => "Поиск по каталогу",
                                "COMPONENT_TEMPLATE" => ""
                            ),
                            false
                        );?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>