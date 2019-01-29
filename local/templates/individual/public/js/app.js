$(function() {

    //for ie8
    var alertFallback = false;
    if (typeof console === "undefined" || typeof console.log === "undefined") {
        console = {};
        if (alertFallback) {
            console.log = function(msg) {
                alert(msg);
            };
        } else {
            console.log = function() {};
        }
    }

    /*$.itexUp({
        elementID: 'up', //ID элемента
        showButtonHeight: 300, //Высота прокрутки в пикселя, когда появляется кнопка
        speed: 1000 //Скорость прокрутки в милисекундах
    });
*/
    $('table').wrap('<div class="table-responsive">');
});

function SetImagePage(e) {
    console.log(e);
}
/*
function windowManagerShow(event) {

        OpenMedialibDialogbx_file_picture();

    return false;
}*/
$(window).resize(function() {

});
$(document).ready(function() {
    $('input[type="tel"]').inputmask('+7 (999) 999-99-99');

    $('.js-init-clear__cart').on('click', function(e){
        e.preventDefault();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            data: {
                'action': 'clear_all'
            },
            success: function (response) {
                console.log(response);
            }
        });
        return false;
    });

    $('.js-init__menu').on('click', function(){
        if($(this).hasClass('fixed')){
            $.arcticmodal('close');
        }
        $('.head-nav__modal').arcticmodal({
            overlay: {
                css: {
                    backgroundColor: '#fff',
                    opacity: 1
                }
            },
            beforeOpen: function() {
                $('.head-nav__modal').show().addClass('animated').addClass('slideInUp');
                $('.js-init__menu').addClass('box-modal_close').addClass('fixed');
            },
            beforeClose: function() {
                $('.js-init__menu').removeClass('fixed').removeClass('box-modal_close');
                $('.head-nav__modal').removeClass('slideInUp').addClass('slideOutDown');
            },
            afterClose: function () {
                $('.head-nav__modal').hide().removeClass('slideOutDown').removeClass('animated');
            }
        });
    });


    $('.settings__panel-nav ul').on('click', 'li:not(.active)', function() {
        $(this)
            .addClass('active').siblings().removeClass('active')
            .closest('.settings__panel').find('.settings__panel-content').removeClass('active').eq($(this).index()).addClass('active');
    });

    $('.hrefpop').fancybox({
        'overlayOpacity' : 1,
        'autoDimensions'	: false,
        'width'         		: 350,
        'height'        		: 500,
        'padding': 0
    });

    $('.navN .firstpage').attr('title', 'На первую');
    $('.navN .lastpage').attr('title', 'На последнюю');
    $('.navN .nextpage').attr('title', 'На следующую');
    $('.navN .prevpage').attr('title', 'На предыдущую');

    // img alt fix
    $('img').each(function () {
        if (!$(this).attr('alt')) {
            $(this).attr('alt', "");
        }
    });
    $(document).on('click', '.js-init_more_menu', function () {
        return false;
    });

    var sPanelNav = $('.settings__panel-nav');
    var sPanelContent = $('.settings__panel-content');
    var applySetting = $('.js-init_apply_settings');

    $(document).on('click', '.js-init-modal__form', function () {
        $.arcticmodal({
            type: 'ajax',
            url: '/local/tools/ajax_form.php',
            overlay: {
                css: {
                    backgroundColor: '#000',
                    opacity: .65
                }
            },
            afterLoadingOnShow: function (data, el) {
                $('.arcticmodal-container .callback__modal-form').addClass('modal__window');
            },
            ajax: {
                type: 'GET',
                data: {
                    ajax_form: $(this).data('modal') || null,
                    sign: $(this).data('sign') || null
                },
                cache: false,
                dataType: 'html',
                success: function (data, el, responce) {
                    data.body.html(responce);

                    $(":input").inputmask();

                    $('.modal__form').off('submit').on('submit', function (e) {
                        e.preventDefault();
                        $('.modal__box').closest('div').prepend('<div class="arcticmodal-loading"></div>');
                        $.ajax({
                            type: 'GET',
                            url: $(this).attr('action') || window.location.href,
                            data: $(this).serialize(),
                            dataType: 'json',
                            success: function(response) {
                                /*console.log(response);*/
                                $('.arcticmodal-loading').detach();
                                $('.form__group').each(function(){
                                    $(this).removeClass('error');
                                });
                                if (response['error']) {
                                    $.each(response['error'], function(code, val){
                                        $('#' + code).attr('placeholder', val).closest('.form__group').addClass('error');
                                    });
                                }
                                if (response['success']) {
                                    $('.modal__content').empty()
                                        .append('<div class="modal__box-title">' + response['success'] + '</div>')
                                        .append('<p class="modal__content-text">Наш менеджер свяжется с Вами в ближайшее время</p>');

                                }
                                $('.error input').focus(function () {
                                    $(this).attr('placeholder', '').closest('.form__group').removeClass('error');
                                });
                                $('.error input[type="checkbox"]').on('click', function(){
                                    if($(this).prop('checked')){
                                        $(this).closest('.form__group').removeClass('error');
                                    }
                                });
                                $(":input").inputmask();

                            }
                        });
                        return false;
                    });
                }
            }
        });
        return false;
    });

    //detail product tabs
    $('.product__tabs-head').on('click', 'li:not(.active)', function() {
        $(this)
            .addClass('active').siblings().removeClass('active')
            .closest('.product__tabs').find('.tab__content').removeClass('active').eq($(this).index()).addClass('active');
    });

    $('.form__group.error input').keyup(function () {
        $(this).closest('.form__group').removeClass('error');
    });
});

function modalClose(event) {
    if (typeof(event) != "undefined") {
        event.preventDefault();
    }
    $.arcticmodal('close');
}


var fz152Module = (function () {
    var baseUrl = '',
        modalClass = 'js-cookie--modal';

    return {
        run: function (apiUrl, cancelUrl) {
            var modal = $('.' + modalClass);
            baseUrl = apiUrl;

            modal.find('.js-confirm').on('click', function (event) {
                event.preventDefault();
                $.get(baseUrl, {}, function () {});
                modal.hide();

                return false;
            });

            modal.find('.js-cancel').on('click', function () {
                document.location.href = cancelUrl;
            });
        },
        init: function (content) {
            var modal = '<div class="modal__box c-fz152__block ' + modalClass + '">';
            modal += content;
            modal += '<div class="c-fz152__buttons">';
            modal += '<div class="c-fz152__buttons-block c-fz152__buttons--left">';
            modal += '<span class="c-fz152__button c-fz152__button--confirm js-confirm modal__close"></span>';
            modal += '</div>';
            modal += '<div class="c-fz152__buttons-block c-fz152__buttons--right">';
            modal += '<span class="c-fz152__button c-fz152__button--cancel js-confirm btn btn-default">Согласен</span>';
            modal += '</div>';
            modal += '</div>';

            $('body').append(modal);
        }
    };
})();

//input number
$(function() {

    (function quantityProducts() {

        $(document).on("click", ".quantity-arrow-minus", quantityMinus);
        $(document).on("click", ".quantity-arrow-plus", quantityPlus);


        function quantityMinus(e) {
            var num = $(e.target).siblings('.quantity-num');
            if (num.val() > 1) {
                num.val(+num.val() - 1);
            }
            num.change();

            return false;
        }

        function quantityPlus(e) {
            var num = $(e.target).siblings('.quantity-num');
            num.val(+num.val() + 1);
            num.change();

            return false;
        }

    })();



});

var customSelect = function(options) {
    var elem = typeof(options.elem === 'string') ? document.getElementById(options.elem) : options.elem,
        mainClass = 'custom-dropdown',
        mainClassActive = 'custom-dropdown_active',
        buttonClass = 'custom-dropdown__button',
        buttonClass2 = 'custom-dropdown_button',
        buttonValueClass = 'custom-dropdown_button__value',
        buttonArrowClass = 'custom-dropdown_button__arrow',
        listContainerClass = 'custom-dropdown__content',
        listClass1 = 'custom-dropdown__list',
        listClass2 = 'custom-dropdown-list',
        liClass = 'custom-dropdown-list__item',
        selectedClass = 'custom-dropdown-list__item_active',
        openClass = 'custom-dropdown-list_open',
        selectOptions = elem.querySelectorAll('option'),
        optionsLength = selectOptions.length;

    var selectContainer = document.createElement('div');

    selectContainer.className = mainClass;

    if (elem.id) {
        selectContainer.id = 'custom-dropdown-' + elem.id;
    }

    var button = document.createElement('button');

    button.classList.add(buttonClass, buttonClass2);

    var button_value = document.createElement('div');
    button_value.className = buttonValueClass;
    button_value.textContent = selectOptions[0].textContent;

    var button_arrow = document.createElement('div');
    button_arrow.className = buttonArrowClass;
    //button_arrow.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="26" viewBox="0 0 20 26"><path id="arrows_double" class="cls-1" d="M1416.98,927.02L1407.96,937,1399,927h18Zm-17.96-4.042,9.02-9.978,8.96,10h-18Z" transform="translate(-1398 -912)"/></svg>';

    button.appendChild(button_value);
    button.appendChild(button_arrow);

    var listContainer = document.createElement('div');
    listContainer.className = listContainerClass;

    var ul = document.createElement('ul');

    ul.className = listClass1;
    ul.classList.add(listClass2);

    for (var i=0; i < optionsLength; i++) {
        var li = document.createElement('li');
        li.className = liClass;
        li.innerText = selectOptions[i].textContent;
        li.setAttribute('data-value', selectOptions[i].value);
        li.setAttribute('data-index', i);
        if (selectOptions[i].getAttribute('selected') != null) {
            li.classList.add(selectedClass);
            button_value.textContent = selectOptions[i].textContent;
        }

        ul.appendChild(li);
    }

    selectContainer.appendChild(button);
    listContainer.appendChild(ul);
    selectContainer.appendChild(listContainer);

    selectContainer.addEventListener('click', onClickSelect);

    elem.parentNode.insertBefore(selectContainer, elem);
    elem.style.display = 'none';

    document.addEventListener('click', function(e) {
        if (!selectContainer.contains(e.target)) close();
    });

    function onClickSelect(e) {
        e.preventDefault();

        var t = e.target;

        if (t.className === buttonClass+' '+buttonClass2 || t.className === buttonValueClass) {
            toggle();
        }

        if (t.className === liClass) {
            selectContainer.querySelector('.' + buttonValueClass).innerText = t.innerText;
            elem.options.selectedIndex = t.getAttribute('data-index');

            var evt = new CustomEvent('change');

            elem.dispatchEvent(evt);

            for (var i=0; i < optionsLength; i++) {
                ul.querySelectorAll('.' + liClass)[i].classList.remove(selectedClass);
            }
            t.classList.add(selectedClass);
            close();
        }
    }

    function toggle() {
        selectContainer.classList.toggle(mainClassActive);
        ul.classList.toggle(openClass);
    }

    function open() {
        selectContainer.classList.add(mainClassActive);
        ul.classList.add(openClass);
    }

    function close() {
        selectContainer.classList.remove(mainClassActive);
        ul.classList.remove(openClass);
    }

    return {
        toggle: toggle,
        close: close,
        open: open
    }
}

if($('#cart__page-select').length > 0) {
    var cartSelect = new customSelect({
        elem: 'cart__page-select'
    });
}


