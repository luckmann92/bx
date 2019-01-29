<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/*echo '<pre>';
var_dump($arParams);
echo '</pre>';*/
if(isset($_REQUEST['ajax_form']) && !empty($_REQUEST['ajax_form'])){?>
    <div class="callback__modal-form modal__box">
        <span onclick="modalClose();" class="modal__close"></span>
        <div class="modal__content">
            <div class="modal__box-title"><?=$arParams['FORM_TITLE'];?></div>
            <form method="POST" action="<?=POST_FORM_ACTION_URI; ?>" class="modal__form">
                <input type="hidden" name="ajax_send" value="Y"/>
                <?=bitrix_sessid_post();?>
                <?foreach ($arResult['FIELDS'] as $arField){?>
                    <div class="form__group<?=$arField['IBLOCK_CODE'] == 'catalog' ? ' product__order-item' : ''?>">
                    <?switch ($arField['PROPERTY_TYPE']) {
                        case 'E':
                            if($arField['IBLOCK_CODE'] == 'catalog'){?>
                                <div class="product__order-image"
                                     style="background-image: url(<?=$arField['PREVIEW_PICTURE']?>)";>
                                </div>
                                <div class="product__order-content">
                                    <div class="product__order-name"><?=$arField['NAME']?></div>
                                    <?if($arField['PROPERTIES']['PRODUCT_PRICE']['VALUE']){?>
                                        <div class="product__order-price">
                                            <span class="product-price"><?=$arField['PROPERTIES']['PRODUCT_PRICE']['VALUE']?></span>
                                            <?=$arField['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE'] ? '<span class="product-price price__old">' . $arField['PROPERTIES']['PRODUCT_OLD_PRICE']['VALUE'] . '</span>' : ''; ?>
                                        </div>
                                    <?} else {?>
                                        <?if($arField['PROPERTIES']['PRODUCT_STATUS']['VALUE']){?>
                                            <div class="product__status <?=$arField['PROPERTIES']['PRODUCT_STATUS']['VALUE_XML_ID']?>"><?=$arField['PROPERTIES']['PRODUCT_STATUS']['VALUE']?></div>
                                        <?}?>
                                    <?}?>
                                </div>
                                <input type="hidden"
                                       name="FIELDS[<?=$arField['CODE']?>]"
                                       value="<?=$arField['ID']?>">
                            <?}
                            break;
                        case 'S':
                            if(is_array($arField['DEFAULT_VALUE'])){?>
                            <textarea id="<?=$arField['CODE']?>"
                                      class="textarea_inp modal__inp"
                                      name="FIELDS[<?=$arField['CODE']?>]"
                                      placeholder="<?=$arField['HINT'] ? $arField['HINT'] : $arField['NAME']?>"></textarea>
                            <?}else{?>
                                <input id="<?=$arField['CODE']?>"
                                       class="inp modal__inp"
                                       <?if(stristr($arField['CODE'], 'PHONE') || stristr($arField['CODE'], 'phone')){?>
                                            data-inputmask="'mask':'+7 (999) 999-99-99'"
                                       <?}?>
                                       type="text"
                                       name="FIELDS[<?=$arField['CODE']?>]"
                                       placeholder="<?=$arField['HINT'] ? $arField['HINT'] : $arField['NAME']?>">
                            <?}
                            break;
                        case 'L':?>
                            <div class="form__group">
                                <label class="lbl politic__checkbox">
                                    <input id="<?=$arField['CODE']?>" type="checkbox" name="FIELDS[<?=$arField['CODE']?>]" checked />
                                    <span class="politic__text"><?=$arField['HINT']?>
                                        <?=$arField['URL'] ? '<a href="'.$arField['URL'].'" target="_blank">'.$arField['NAME'].'</a>' : $arField['NAME']?>
                                    </span>
                                </label>
                            </div>
                            <?break;
                    }?>
                    </div>
                <?}?>
                <div class="form__group form__group-btn">
                    <button type="submit" class="btn btn-primary modal__form-submit"><?=$arParams['FORM_BTN_SUBMIT'];?></button>
                </div>
            </form>
        </div>
    </div>
<?} else {?>
    <a href="#"
       class="btn js-init-modal__form <?=$arParams['FORM_BTN_TYPE']?>"
       data-sign="<?=$arResult["JSON_SIGN"]?>"
       data-modal="<?=$arParams['IBLOCK_ID']?>"><?=$arParams['FORM_BTN_TYPE'] == 'btn-icon' ? GetIconSVG('phone') : $arParams['FORM_BTN_OPEN']?></a>
<?}?>