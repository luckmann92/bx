var selectMainFont,
    selectTitleFont;

$(document).ready(function() {
    //constructor
    $('.settings__panel-show').on('click', function(){
        $.arcticmodal({
            type: 'ajax',
            url: '/local/tools/setting_panel.php',
            overlay: {
                css: {
                    backgroundColor: '#000',
                    opacity: .65
                }
            },
            openEffect: {
                speed: 200
            },
            closeEffect: {
                speed: 200
            },
            beforeOpen: function (data, el) {
                $('.arcticmodal-container table').addClass('setting__container');
            },
            afterLoadingOnShow: function (data, el) {
                $('.arcticmodal-container .settings__panel').addClass('modal__window');
                $('.box__modal-setting').addClass('slideInLeft');
                selectMainFont = new customSelect({
                    elem: 'selectMainfont'
                });
                selectTitleFont = new customSelect({
                    elem: 'selectTitlefont'
                });
            },
            beforeClose: function (data, el) {
                $('.box__modal-setting').addClass('slideOutLeft');
            },
            success: function(response) {

            }
        });
    });

    $(document).mouseup(function (e){
        var div = $(".modal__window");
        if (!div.is(e.target)
            && div.has(e.target).length === 0) {
            modalClose();
        }
    });

    $(document).on('click', '.js-init_apply_settings', function () {
        var sForm = $(this).closest('.settings__panel').find('form');
        $.ajax({
            type: sForm.attr('method'),
            url: sForm.attr('action'),
            data: sForm.serialize(),
            dataType: 'html',
            success: function(response) {
                location.reload();
            }
        });
        return false;
    });

    $(document).on('change', '.js-init-template_select', function() {
        var arTemplate = {
            name: $(this).attr('name'),
            value: $(this).val()
        };

        $.ajax({
            type: 'GET',
            url: '/local/tools/setting_panel.php',
            data: {
                ajax_request: 'y',
                data: arTemplate
            },
            dataType: 'html',
            success: function(responce) {
                if(responce['sites']){

                    var groupPanel = '<div class="group__panel" id="template-list">';
                    groupPanel += '<div class="group__theme-title">Готовое решение</div>';
                    groupPanel += '<div class="group__theme-list">' +
                        '<select name="TEMPLATE_TYPE" class="js-init-template_select group__theme-template__select">';
                    console.log('1');
                    $.each(responce['sites'], function(id, name) {
                        groupPanel += '<option value="' + id + '">' + name + '</option>';
                    });

                    groupPanel += '</select></div></div></div>';

                }


            }
        });
    });

    $('.panel-nav__list').on('click', 'li:not(.active)', function() {
        $(this)
            .addClass('active').siblings().removeClass('active')
            .closest('.settings__panel').find('.settings__panel-content').removeClass('active').eq($(this).index()).addClass('active');
    });

    /*$('.cart__panel-show').on('click', function(){
        $.arcticmodal({
            type: 'ajax',
            url: '/?action=info',
            overlay: {
                css: {
                    backgroundColor: '#000',
                    opacity: .65
                }
            },
            openEffect: {
                speed: 200
            },
            closeEffect: {
                speed: 200
            },
            beforeOpen: function (data, el) {
                $('.arcticmodal-container table').addClass('cart__container');
            },
            afterLoadingOnShow: function (data, el) {
                $('.box__modal-cart').addClass('slideInRight');
                $(document).mouseup(function (e){
                    var div = $(".cart__panel");
                    if (!div.is(e.target)
                        && div.has(e.target).length === 0) {
                        modalClose();
                    }
                });
            },
            beforeClose: function (data, el) {
                $('.box__modal-cart').addClass('slideOutRight');
            },
            success: function(response) {

            }
        });
    });*/

});

//select

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