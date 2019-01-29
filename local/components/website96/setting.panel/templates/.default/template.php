<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if($arResult['SETTINGS']['SHOW_PANEL'] == 'Y'){?>
<div class="box__modal-setting animated">
    <div class="settings__panel">
        <a onclick="modalClose(event);" href="#" class="settings__panel-show"></a>
        <form action="<?=POST_FORM_ACTION_URI?>" method="get" enctype="multipart/form-data">
            <div class="settings__panel-content active">
                <?=bitrix_sessid_post()?>
                <input type="hidden" value="Y" name="SET_SETTING">
                <div class="group__panel" id="template-type">
                    <div class="group__theme-title">Готовое решение</div>


                    <div class="group__theme-list type__list">
                        <label class="type__label pageType__company <?=$arResult['SETTINGS']['TEMPLATE_TYPE'] == 'COMPANY' ? 'type__checked' : ''?>" for="pageType__company">
                            <input type="radio"
                                   name="TEMPLATE_TYPE"
                                   id="pageType__company"
                                   value="COMPANY"
                                <?=$arResult['SETTINGS']['TEMPLATE_TYPE'] == 'COMPANY' ? 'checked' : ''?>>
                            <span>Сайт компании</span>
                        </label>
                        <label class="type__label pageType__catalog <?=$arResult['SETTINGS']['TEMPLATE_TYPE'] == 'CATALOG' ? 'type__checked' : ''?>" for="pageType__catalog">
                            <input type="radio"
                                   name="TEMPLATE_TYPE"
                                   id="pageType__catalog"
                                   value="CATALOG"
                                <?=$arResult['SETTINGS']['TEMPLATE_TYPE'] == 'CATALOG' ? 'checked' : ''?>>
                            <span>Сайт с каталогом/услугами</span>
                        </label>
                        <label class="type__label pageType__internet <?=$arResult['SETTINGS']['TEMPLATE_TYPE'] == 'SHOP' ? 'type__checked' : ''?>" for="pageType__internet">
                            <input type="radio"
                                   name="TEMPLATE_TYPE"
                                   id="pageType__internet"
                                   value="SHOP"
                                <?=$arResult['SETTINGS']['TEMPLATE_TYPE'] == 'SHOP' ? 'checked' : ''?>>
                            <span>Интернет-магазин</span>
                        </label>
                    </div>
                </div>
                <div class="group__panel">
                    <div class="group__theme-title">Активный (основный) цвет</div>
                    <div class="group__theme-list">
                        <div class="theme__color theme__default">
                            <label class="color__label"
                                   for="actionColor_default"
                                   title="Стандартный" >
                                <input type="radio"
                                       name="COLORS[ACTION]"
                                       id="actionColor_default"
                                       value="default"
                                    <?=$_SESSION['SETTING']['COLORS']['ACTION']  == 'default' || empty($_SESSION['SETTING']['COLORS']['ACTION']) ? 'checked' : ''?> >
                                <span style="background-color: #ff223d"></span>
                            </label>
                        </div>
                        <?foreach ($arResult['COLORS'] as $key => $arColor){?>
                            <div class="theme__color theme__default">
                                <label class="color__label"
                                       for="actionColor_<?=$key?>"
                                       title="<?=$arColor['UF_COLOR_NAME']?>" >
                                    <input type="radio"
                                           name="COLORS[ACTION]"
                                           id="actionColor_<?=$key?>"
                                           value="<?=$arColor['UF_COLOR_CODE']?>"
                                        <?=$_SESSION['SETTING']['COLORS']['ACTION']  == $arColor['UF_COLOR_CODE'] ? 'checked' : ''?> >
                                    <span style="background-color: #<?=$arColor['UF_COLOR_HEX']?>"></span>
                                </label>
                            </div>
                        <?}?>
                    </div>
                </div>
                <div class="group__panel">
                    <div class="group__theme-title">Дополнительный цвет</div>
                    <div class="group__theme-list">
                        <div class="theme__color theme__default">
                            <label class="color__label"
                                   for="mainColor_default"
                                   title="Стандартный" >
                                <input type="radio"
                                       name="COLORS[MAIN]"
                                       id="mainColor_default"
                                       value="default"
                                    <?=$_SESSION['SETTING']['COLORS']['MAIN']  == 'default' || empty($_SESSION['SETTING']['COLORS']['MAIN']) ? 'checked' : ''?> >
                                <span style="background-color: #333"></span>
                            </label>
                        </div>
                        <?foreach ($arResult['COLORS'] as $key => $arColor){?>
                            <div class="theme__color theme__<?=$arColor['UF_COLOR_CODE']?>">
                                <label class="color__label"
                                       for="mainColor_<?=$key?>"
                                       title="<?=$arColor['UF_COLOR_NAME']?>" >
                                    <input type="radio"
                                           name="COLORS[MAIN]"
                                           id="mainColor_<?=$key?>"
                                           value="<?=$arColor['UF_COLOR_CODE']?>"
                                        <?=$_SESSION['SETTING']['COLORS']['MAIN'] == $arColor['UF_COLOR_CODE'] ? 'checked' : ''?> >
                                    <span style="background-color: #<?=$arColor['UF_COLOR_HEX']?>"></span>
                                </label>
                            </div>
                        <?}?>
                    </div>
                </div>
                <?if($arResult['SETTINGS']['FONTS']){?>
                    <div class="group__panel" id="title-font">
                        <div class="group__theme-title">Основной шрифт</div>
                        <div class="group__theme-list">
                            <div class="group__theme-type">
                                <select name="FONTS[SIMPLE]" class="group__theme-template__select" id="selectMainfont">
                                    <?foreach($arResult['SETTINGS']['FONTS']['SIMPLE'] as $arFont){?>
                                        <option <?=$_SESSION['SETTING']['FONTS']['SIMPLE'] == $arFont ? 'selected' : ''?>
                                                value="<?=str_replace(' ', '+', $arFont)?>"><?=$arFont?></option>
                                    <?}?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="group__panel" id="simple-font">
                        <div class="group__theme-title">Шрифт для заголовков</div>
                        <div class="group__theme-list">
                            <div class="group__theme-type">
                                <select name="FONTS[TITLE]" class="group__theme-template__select" id="selectTitlefont">
                                    <?
                                    dump($_SESSION);
                                    foreach($arResult['SETTINGS']['FONTS']['TITLE'] as $arFont){?>
                                        <option <?=str_replace('+', ' ', $_SESSION['SETTING']['FONTS']['TITLE']) == $arFont ? 'selected' : ''?>
                                                value="<?=str_replace(' ', '+', $arFont)?>"><?=$arFont?></option>
                                    <?}?>
                                </select>
                            </div>
                        </div>
                    </div>
                <?}?>
                <?if($arResult['SETTINGS']['TEMPLATE_TYPE'] != 'COMPANY'){?>
                    <div class="group__panel page__view">
                        <div class="group__theme-title">Вид главной страницы</div>
                        <div class="group__theme-list">
                            <div class="col__part">
                                <label class="view__label pageView__sidebar" for="pageView__no_sidebar">
                                    <input type="radio"
                                           name="HOME_TYPE"
                                           id="pageView__no_sidebar"
                                           value="1"
                                        <?=$arResult['SETTINGS']['HOME_TYPE'] == 1 ? 'checked' : ''?>>
                                    <span class="pageView__name">На всю ширину</span>
                                </label>
                            </div>
                            <div class="col__part">
                                <label class="view__label pageView__no_sidebar" for="pageView__sidebar">
                                    <input type="radio"
                                           name="HOME_TYPE"
                                           id="pageView__sidebar"
                                           value="2"
                                        <?=$arResult['SETTINGS']['HOME_TYPE'] == 2 ? 'checked' : ''?>>
                                    <span class="pageView__name">С боковым меню</span>
                                </label>
                            </div>
                        </div>
                    </div>
                <?}?>
                <div class="group__panel">
                    <button class="js-init_apply_settings group__panel-submit">Применить<span class="icon__ok"></span></button>
                </div>
            </div>
        </form>
    </div>
</div>
<?}?>