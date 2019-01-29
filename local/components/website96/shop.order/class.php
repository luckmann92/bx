<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Loader;
use Website96\Shop;
use \Bitrix\Main\Context;

class Order extends CBitrixComponent
{
    public function onIncludeComponentLang() {
        Loc::loadMessages(__FILE__);
    }

    public function executeComponent() {
        $order = new Shop\Order();

        $context = Context::getCurrent();
        $request = $context->getRequest();
        $action = trim($request->get('order'));

        if (!empty($action) && ($action == 'y' || $action == 'Y')) {
            global $APPLICATION;
            $APPLICATION->RestartBuffer();
            $result = $order->validateFields($request->get('fields'));
            header('Content-type: application/json');
            echo \Bitrix\Main\Web\Json::encode($result);
            die();
        } else {
            $this->arResult['fields'] = $order->arOrderFields;
            $this->includeComponentTemplate();
        }

    }
}