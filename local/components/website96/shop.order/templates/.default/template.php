<div class="col-12">
    <div class="row cart__page-formbox">
        <div class="col-12 col-lg-6">
            <div class="cart__page-infotitle">Общая <br>информация</div>
        </div>
        <div class="col-12 col-lg-6">
            <form class="cart__page-form">
                <?foreach ($arResult['fields'] as $id => $arField) {

                    ?>
                    <div class="form-group">
                        <?switch ($arField['PROPERTY_TYPE']) {
                            case 'S':
                                ?>
                                <input class="inp cart__page-inp <?=stripos($arField['CODE'], 'PHONE')?>"
                                    <?if (stripos($arField['CODE'], 'PHONE')) {?>
                                        type="tel"
                                        data-inputmask="'mask':'+7 (999) 999-99-99'"
                                    <?} elseif (stripos($arField['CODE'], 'EMAIL')) {?>
                                        type="email"
                                    <?} else {?>
                                        type="text"
                                    <?}?>
                                       placeholder="<?=$arField['HINT'] ? $arField['HINT'] : $arField['NAME']?>"
                                       name="fields[<?=$arField['ID']?>]">
                                <?
                                break;
                            case 'L':
                                ?>
                                <select name="fields[<?=$arField['ID']?>]"
                                        id="cart__page-select"
                                        class="cart__page-select">
                                    <option disabled selected>Не выбрано</option>
                                    <?foreach ($arField['VALUES'] as $arEnumID => $arEnum) {?>
                                        <option value="<?=$arEnumID?>"><?=$arEnum['VALUE']?></option>
                                    <?}?>
                                </select>
                                <?
                                break;
                        } ?>
                    </div>
                <?}?>

                <div class="cart__page-end">
                    <div class="form-group">
                        <div class="cart__page-politic">
                            <label class="cart__page-checkbox politic__checkbox">
                                <input type="checkbox" checked="checked" name="fields[politic]" id="FIELD_POLITIC">
                                <span class="cart__page-checktext politic__text">Я даю свое согласие на обработку <br><a href="/politic/" target="_blank">персональных данных</a></span>
                            </label>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Оформить заказ">
                </div>
            </form>
        </div>
    </div>
</div>
