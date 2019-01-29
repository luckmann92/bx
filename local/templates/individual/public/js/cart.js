var classesError = {
    input_invalid: 'inp--error',
    select_invalid: 'select--error',
    error: 'error-message'
};


$(document).ready(function () {
    $(".js-init-add__cart").on('click', function(event) {
        if ($(event.target).hasClass('btn-added')) {
            document.location.href = '/cart';
        } else {
            addCart(event, $(this).attr('data-id'), function(event) {
                updateCatalogButton(event);
            },1);
        }
    });

    $(".js-init-add__product").on('click', function(event) {
        if ($(event.target).hasClass('btn-added')) {
            document.location.href = '/cart';
        } else {
            addCart(event, $(this).attr('data-id'), function(event) {
                updateProductButton(event);
            }, 1);
        }
    });



    function addCart(event, id, cb, quantity = 1) {
        $.ajax({
            method: 'GET',
            data: {
                action: 'add',
                id: id,
                quantity: quantity,
                image_size: 150,
            },
            dataType: 'json',
            success: function (response) {
                renderModalMessage(response.item);
                updateTotalCartQuantity(response.total_items);
                if (typeof(cb) !=  'undefined') {
                    cb(event);
                }
            }
        })
    }

    function renderModalMessage(item) {
        var output = `<div class="callback__modal-form modal__box">
                        <span onclick="modalClose(event);" class="modal__close"></span>
                        <div class="modal__content">
                        <div class="modal__box-title">Добавлено в корзину</div>
                            <div class="form__group product__order-item">
                                <div class="product__order-image" style="background-image: url(${ item.img })" ;="">
                                </div>
                                <div class="product__order-content">
                                    <div class="product__order-name">${ item.name }</div>
                                        <div class="product__order-price">
                                            <span class="product-price">${ Number(item.price).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2}) }</span>
                                        </div>
                                        <div class="form__group form__group-btn product__order-buttons">
                                            <button onclick="modalClose(event);" class="btn btn-default modal__form-submit modal__form-continue">Продолжить покупки</button>
                                            <a href="/cart" class="btn btn-primary modal__form-submit">Оформить</a>
                                        </div>                                                                 
                                     </div>
                                </div>
                            </div>
                        </div>`;
        $.arcticmodal({
            content: output,
        });
    }

    function renderModalSuccess() {
        var output = `<div class="callback__modal-form modal__box">
                        <span onclick="modalClose(event);" class="modal__close"></span>
                        <div class="modal__content">
                        <div class="modal__box-title">Ваш заказ подтвержен!</div>
                        <p class="modal__box-text">Спасибо за Ваш заказ! В ближайшее время наш менеджер свяжется с Вами для уточнения деталей.</p>
                        </div>`;
        $.arcticmodal({
            content: output,
        });
    }

    function updateTotalCartQuantity(total) {
        if (total == 0) {
            $('.cart__items-count').hide();
        } else {

            $('.cart__items-count').html(total);
            $('.cart__items-count').show();
        }
    }

    function renderModalProduct(product) {
        var output = `<div class="cart__panel-outer">
                        <div class="cart__panel-item" data-id="${ product.id }">
                            <button class="cart__panel-del"></button>
                                <div class="cart__panel-left">
                                    <div class="cart__panel-pic" style="background-image: url(${ product.img });"></div>
                                    <div class="cart__panel-infobox">
                                        <a class="cart__panel-name" href="${ product.url }">${ product.name }</a>
                                        <div class="cart__panel-pricebox">
                                            <div class="cart__panel-price">${ Number(product.price).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2}) }</div>`;
                if (typeof(product.old_price) != 'undefined' && product.old_price != null) {
                    output += `<div class="cart__panel-oldprice">${ Number(product.old_price).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2}) }</div>`;
                }
                output += `
                                        </div>
                                    </div>
                                </div>
                                <div class="quantity-box">
                                    <button class="quantity-arrow-minus"></button>
                                    <input class="field fieldCount quantity-num" type="number" value="${ product.quantity }">
                                    <button class="quantity-arrow-plus"></button>
                                </div>
                                <div class="cart__panel-itemprice">${ Number(product.total_price).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2}) }</div>
                            </div>
                        </div>`;
        $('.cart__panel-inner').append(output);
    }
    function renderModalTotal(price) {
        var output = `<div class="cart__panel-totalprice"><span>${ price.name }:</span><span class="cart__panel-final">${ Number(price.value).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2}) }</span></div>`;
        $('.cart__panel-totalbox').append(output);
    }

    $(".cart__panel-show").on('click', function() {
        renderCartPanel();
        return false;
    });

    function updateModalQuantity(id, quantity) {
        updateQuantity(id, quantity, function(response) {
            $('.cart__panel-item[data-id="' + id + '"] .cart__panel-itemprice').html(Number(response.item.total_price).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2}));
            $('.cart__panel-totalbox').empty();
            response.prices.forEach(function(price) {
                var output = `<div class="cart__panel-totalprice"><span>${ price.name }:</span><span class="cart__panel-final">${ Number(price.value).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2}) }</span></div>`;
                $('.cart__panel-totalbox').append(output);
            });
        });
    }

    function updateCartQuantity(id, quantity) {
        updateQuantity(id, quantity, function(response) {
            $('.cart__page-item[data-id="' + id + '"] .cart__page-item-price').html(Number(response.item.total_price).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2}));
            $('.cart__page-total').empty();
            response.prices.forEach(function(price) {
                var output = `<div class="cart__page-totaldesc">${ price.name }:</div><div class="cart__page-price">${ Number(price.value).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2}) }</div>`;
                $('.cart__page-total').append(output);
            });
        });
    }

    function updateQuantity(id, quantity, cb) {
        $.ajax({
            method: 'GET',
            data: {
                action: 'update',
                id: id,
                quantity: quantity
            },
            dataType: 'json',
            success: function (response) {
                cb(response);
                updateTotalCartQuantity(response.total_items);
            }
        });
    }

    $(document).on("change", ".cart__panel-item .quantity-num", function() {
        var quantity = $(this).val();
        var id = $(this).closest('.cart__panel-item').attr('data-id');
        updateModalQuantity(id, quantity, '.cart__panel-itemprice');
    });

    $(document).on("change", ".cart__page-item .quantity-num", function() {
        var quantity = $(this).val();
        var id = $(this).closest('.cart__page-item').attr('data-id');
        updateCartQuantity(id, quantity, '.cart__page-desc');
    });

    function removeItem (id, e, cb) {
        $.ajax({
            method: 'GET',
            data: {
                action: 'remove',
                id: id
            },
            dataType: 'json',
            success: function (response) {
                cb(response);
                updateTotalCartQuantity(response.total_items);
            }
        })
    }

    $(document).on("click", ".cart__panel-del", function(e) {
        var id = $(this).closest('.cart__panel-item').attr('data-id');
        removeItem(id, e, function(response) {
            $(e.target).closest('.cart__panel-item').remove();
            if($('.cart__panel-item').length == 0) {
                $(".cart__panel-inner").html('<div class="cart__panel-message">Корзина пуста</div>');
                $(".cart__panel-buttons .btn-primary").remove();
                $(".cart__panel-bottom").remove();
                $(".cart__panel-tablehead").remove();
            }
            $('.cart__panel-totalbox').empty();
            if ('prices' in response) {
                response.prices.forEach(function(price) {
                    var output = `<div class="cart__panel-totalprice"><span>${ price.name }:</span><span class="cart__panel-final">${ Number(price.value).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2}) }</span></div>`;
                    $('.cart__panel-totalbox').append(output);
                });
            }
        });
        return false;
    });

    $(document).on("click", ".cart__page-del", function(e) {
        var id = $(this).closest('.cart__page-item').attr('data-id');
        removeItem(id, e, function(response) {
            $(e.target).closest('.cart__page-item').remove();
            if($('.cart__page-item').length == 0) {
                $(".cart__page-inner").html('<div class="cart__page-message">Корзина пуста</div>');
                $(".cart__page-bottom").remove();
                $(".cart__page-top").remove();
                $(".cart__page-formbox").remove();
            }
            $('.cart__page-total').empty();
            if ('prices' in response) {
                response.prices.forEach(function(price) {
                    var output = `<div class="cart__page-totaldesc">${ price.name }:</div><div class="cart__page-price">${ Number(price.value).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 2}) }</div>`;
                    $('.cart__page-total').append(output);
                });
            }
        });
        return false;
    });

    function clearModalCart () {
        $.ajax({
            method: 'GET',
            data: {
                action: 'clear'
            },
            dataType: 'json',
            success: function () {
                $(".cart__panel-item").remove();
                $(".cart__panel-buttons .btn-primary").remove();
                $(".cart__panel-bottom").remove();
                $(".cart__panel-tablehead").remove();
                $(".cart__panel-inner").html('<div class="cart__panel-message">Корзина пуста</div>');
                updateTotalCartQuantity(0);
            }
        })
    }

    $(document).on("click", ".js-init-clear__cart", function(e) {
        clearModalCart();
        return false;
    });

    function renderCartPanel() {
        $.arcticmodal({
            type: 'ajax',
            url: location.href,
            ajax: {
                method: 'GET',
                data: {
                    action: 'info'
                },
                dataType: 'json',
                success: function (data, el, response) {
                    var cart_panel = `<div class="box__modal-cart animated">
                        <div class="cart__panel">
                            <a onclick="modalClose(event);" href="#" class="cart__panel-show">
                            <?if ($arResult['ALL_COUNT']) {?>
                                <span class="cart__items-count"><?=$arResult['ALL_COUNT']?></span>
                            <?}?>
                            </a>
                            <form action="" method="" class="cart__panel-form">
                                <div class="cart__panel-content active">
                                    <div class="cart__panel-top">
                                        <h3 class="cart__panel-title">Корзина</h3>
                                        <a onclick="modalClose(event);" href="#" class="cart__panel-close modal__close"></a>
                                    </div>
                                    <div class="cart__panel-inner"></div>
                                    <div class="cart__panel-buttons">
                                        <a href="#" class="btn btn-default">Продолжить покупки</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>`;
                    data.body.html(cart_panel);
                    if ('items' in response && Object.keys(response.items).length > 0) {
                        console.log($('.cart__panel-top', cart_panel));
                        $('.cart__panel-top').after('<div class="cart__panel-tablehead"><div class="cart__panel-colname">Наименование</div><div class="cart__panel-colname">Кол-во</div><div class="cart__panel-colname">Сумма</div></div>');
                        $(".cart__panel-buttons").before('<div class="cart__panel-bottom"><a href="#" class="cart__panel-clean js-init-clear__cart">Очистить корзину</a><div class="cart__panel-totalbox"></div></div>');
                        for (var i in response.items) {
                            renderModalProduct(response.items[i]);
                        }
                        response.prices.forEach(renderModalTotal);
                        $(".cart__panel-buttons .btn-default").after('<a href="/cart" class="btn btn-primary">Оформить заказ</a>');
                        updateTotalCartQuantity(response.total_items);
                    } else {
                        $(".cart__panel-inner").html('<div class="cart__panel-message">Корзина пуста</div>');
                        updateTotalCartQuantity(0);
                    }

                },
            },
            beforeOpen: function (data, el) {
                $('.arcticmodal-container').addClass('right-panel');
                $('.arcticmodal-container table').addClass('modal__window');
                $('.cart__panel-show').css('right', '17px');

            },
            afterLoadingOnShow: function (data, el) {
                $('.box__modal-cart').addClass('slideInRight');
            },
            beforeClose: function (data, el) {

                $('.box__modal-cart').addClass('slideOutRight');
            },
            afterClose: function (data, el) {
                $('.cart__panel-show').css('right', '0');
            },
            openEffect: {
                speed: 200
            },
            closeEffect: {
                speed: 200
            },
        });
    }

    //окно успешного добавления в корзину

    function renderCartMessage() {
        var cart_message = `<div class="modal__box ">
                                <a onclick="modalClose(event);" href="#" class="cart__panel-show"></a>
                                <form action="" method="">
                                    <div class="cart__panel-content active">
                                        <div class="cart__panel-top">
                                            <h3 class="cart__panel-title">Корзина</h3>
                                            <a onclick="modalClose(event);" href="#" class="cart__panel-close modal__close"></a>
                                        </div>
                                        <div class="cart__panel-inner"></div>
                                        <div class="cart__panel-buttons">
                                            <a href="#" class="btn btn-default">Продолжить покупки</a>
                                        </div>
                                    </div>
                                </form>
                            </div>`;
        $.arcticmodal({
            content: cart_panel,
            openEffect: {
                speed: 200
            },
            closeEffect: {
                speed: 200
            },
        });
    }

    //Валидация и отправка формы

    $(".cart__page-form").submit(function(event) {
        $.ajax({
            method: 'GET',
            data: $(".cart__page-form").serialize() + "&order=Y",
            dataType: 'json',
            success: function (response) {
                $('.form-group').each(function(){
                    $(this).removeClass('error');
                });
                if ('errors' in response) {
                    $.each(response['errors'], function(code, val){
                        $('[name="'+code+'"]').attr('placeholder', val).closest('.form-group').addClass('error');
                    });
                } else if (response.success) {
                    renderModalSuccess();
                    $(".cart__page-form")[0].reset();
                }
                $('.error input').focus(function () {
                    $(this).attr('placeholder', '').closest('.form-group').removeClass('error');
                });
            }
        });
        return false;
    });


    //добавление в корзину из каталога

    function updateCatalogButton(event) {
        $(event.target).removeClass('btn-default').addClass('btn-primary btn-added').text('Оформить');
    }

    function updateProductButton(event) {
        var svg = $(event.target).children('svg')[0].outerHTML;

        $(event.target).addClass('btn-added').html(svg + 'Оформить');
    }
});

