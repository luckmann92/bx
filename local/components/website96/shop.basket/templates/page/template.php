<div class="row">
    <? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
    <?if ($arResult['ITEMS']) {?>
    <div class="col-12 cart__page-top align-items-center d-flex justify-content-between">
        <span class="cart__page-subtitle">Ваш заказ</span>
    </div>
    <div class="cart__page-inner col-12">
        <div class="cart__page-items">
            <?foreach ($arResult['ITEMS'] as $id => $arProduct) {?>
                <div class="cart__page-outer">
                    <div class="cart__page-item d-flex align-items-center" data-id="<?=$id?>">
                        <button class="cart__page-del"></button>
                        <div class="cart__page-pic" style="background-image: url(<?=$arProduct['img']?>);"></div>
                        <div class="cart__page-col cart__page-colname">
                            <div class="cart__page-coltitle">Наименование</div>
                            <a href="<?=$arProduct['url']?>" class="cart__page-desc"><?=$arProduct['name']?></a>
                        </div>
                        <div class="cart__page-col cart__page-colprice">
                            <div class="cart__page-coltitle">Стоимость</div>
                            <div class="cart__page-desc cart__page-descrub">
                                <?=number_format($arProduct['price'], 0,'', ' ')?>
                            </div>
                        </div>
                        <div class="cart__page-col cart__page-colquant">
                            <!-- <div class="cart__page-coltitle">Кол-во</div>
                                    <div class="cart__page-desc"><?/*=$arProduct['QUANTITY']*/?> шт</div>-->
                            <div class="quantity-box">
                                <button class="quantity-arrow-minus"></button>
                                <input class="field fieldCount quantity-num" type="number" value="<?=$arProduct['quantity']?>">
                                <button class="quantity-arrow-plus"></button>
                            </div>
                        </div>
                        <div class="cart__page-col cart__page-colsum">
                            <div class="cart__page-coltitle">Сумма</div>
                            <div class="cart__page-desc cart__page-descrub cart__page-item-price">
                                <?=number_format($arProduct['total_price'], 0,'', ' ')?>
                            </div>
                        </div>
                    </div>
                </div>
            <?}?>
        </div>
    </div>
    <div class="cart__page-bottom">
        <?foreach ($arResult['TOTAL_PRICE'] as $arPrice) {?>
            <div class="cart__page-total">
                <div class="cart__page-totaldesc">Итого:</div>
                <div class="cart__page-price">
                    <?=number_format($arPrice['value'],0,'', ' ')?>
                </div>
            </div>
        <?}?>
    </div>
    <?$APPLICATION->IncludeComponent("website96:shop.order", "", Array(

    ),
        false
    );?>
    <?} else {?>
        В корзине нет товаров
    <?}?>
</div>
