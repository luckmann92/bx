<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<header class="header-responsive">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <nav class="col-md col-sm-2 col-3 head-nav">
                <button class="head-nav__button js-init__menu"></button>
                <div class="head-nav__modal" style="display: none;">
                    <div class="container">
                        <div class="head-nav__content">
                            <div class="head-nav__menu menu__catalog">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    ".default",
                                    array(
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "CHILD_MENU_TYPE" => "top",
                                        "DELAY" => "N",
                                        "MAX_LEVEL" => "1",
                                        "MENU_CACHE_GET_VARS" => "",
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_TYPE" => "N",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "ROOT_MENU_TYPE" => "catalog_top",
                                        "USE_EXT" => "Y",
                                        "COMPONENT_TEMPLATE" => ".default"
                                    ),
                                    $component,
                                    ['HIDE_ICONS' => 'Y']
                                );?>
                            </div>
                            <div class="head-nav__menu menu__top">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    ".default",
                                    Array(
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "CHILD_MENU_TYPE" => "top",
                                        "DELAY" => "N",
                                        "MAX_LEVEL" => "1",
                                        "MENU_CACHE_GET_VARS" => array(""),
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_TYPE" => "N",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "ROOT_MENU_TYPE" => "top",
                                        "USE_EXT" => "N",
                                        "COMPONENT_TEMPLATE" => ".default"
                                    ),
                                    $component,
                                    ['HIDE_ICONS' => 'Y']
                                );?>
                            </div>
                            <div class="head-nav__links">
                                <a class="nav__link" href="tel:<?$APPLICATION->IncludeFile("include/".SITE_ID."/contact/phone.php", [], ["SHOW_BORDER" => false, "MODE" => "html"]);?>">
                                    <span class="icon__svg icon__phone"><?=GetIconSVG('phone');?></span>
                                    <span><?$APPLICATION->IncludeFile(
                                            "include/".SITE_ID."/contact/phone.php",
                                            array(
                                                "SHOW_BORDER" => false,
                                                "MODE" => "html"
                                            )
                                        );?>
                        </span>
                                </a>
                                <a class="nav__link" href="<?=SITE_DIR?>contacts/">
                                    <span class="icon__svg icon__address"><?=GetIconSVG('address');?></span>
                                    <span><?$APPLICATION->IncludeFile(
                                            "include/".SITE_ID."/contact/address.php",
                                            array(
                                                "SHOW_BORDER" => false,
                                                "MODE" => "html"
                                            )
                                        );?>
                        </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="col-md-3 col-sm-6 col-6 head-logo d-flex align-items-center">
                <a href="<?=SITE_DIR?>" class="d-inline-flex align-items-center head-logo__link">
                    <?$APPLICATION->IncludeFile('include/'.SITE_ID.'/logo.php',
                        ['SETTING' => $arParams['SETTING']],
                        ['SHOW_BORDER' => false, 'MODE' => 'php']
                    );?></a>
            </div>
            <div class="col-md-4 col-sm-2 col-3 head-phone d-md-block d-none">
                <div class="row align-items-center">
                    <div class="col-12 head-phone__content">
                        <span class="head-phone__icon"><?=GetIconSVG('phone')?></span>
                        <a class="head-phone__value" href="tel:<?$APPLICATION->IncludeFile(
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
                </div>
            </div>
            <div class="col-sm-auto head-callback d-md-block d-none">
                <?$APPLICATION->IncludeComponent(
                "website96:forms",
                ".default",
                array(
                    "CACHE_TIME" => "3600",
                    "CACHE_TYPE" => "A",
                    "FORM_BTN_OPEN" => "Заказать звонок",
                    "FORM_BTN_SUBMIT" => "Отправить",
                    "FORM_BTN_TYPE" => "btn-primary",
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
            <div class="col-sm-2 col-3 head-modal__icon d-md-none">
                <?$APPLICATION->IncludeComponent(
                    "website96:forms",
                    ".default",
                    array(
                        "CACHE_TIME" => "3600",
                        "CACHE_TYPE" => "A",
                        "FORM_BTN_OPEN" => "",
                        "FORM_BTN_SUBMIT" => "Отправить",
                        "FORM_BTN_TYPE" => "btn-icon",
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
</header>
