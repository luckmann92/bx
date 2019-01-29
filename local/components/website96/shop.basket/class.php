<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
define("NO_KEEP_STATISTIC", true);

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Context;
use \Website96\Shop\Basket;

class ShopBasket extends CBitrixComponent
{
    public $basketItems;

    public function onIncludeComponentLang() {
        Loc::loadMessages(__FILE__);
    }

    protected function actions() {
        $basket = new Basket();
        $basket->load();
        $this->basketItems = $basket->getItems();

        $context = Context::getCurrent();
        $request = $context->getRequest();
        $action = trim($request->get('action'));

        switch ($action) {
            case 'info':
                $this->arResult = $this->basketItems;
                $this->arResult['total_items'] = $basket->getCounts();
                $this->arResult['prices'] = $basket->calculate();
                break;
            case 'add':
                $basket->add($request->get('id'), $request->get('quantity'));
                $this->arResult = $basket->getItem($request->get('id'));
                $this->arResult['total_items'] = $basket->getCounts();
                $this->arResult['prices'] = $basket->calculate();
                break;
            case 'update':
                $basket->update($request->get('id'), $request->get('quantity'));
                $basketItem = $basket->getItem($request->get('id'));
                if ($basketItem['error'] != true) {
                    $this->arResult = $basketItem;
                } else {
                    $this->arResult = $basketItem;
                }
                $this->arResult['total_items'] = $basket->getCounts();
                $this->arResult['prices'] = $basket->calculate();
                break;
            case 'remove':
                $basket->remove($request->get('id'));
                $this->arResult['total_items'] = $basket->getCounts();
                $this->arResult['prices'] = $basket->calculate();
                break;
            case 'clear':
                $this->arResult = $basket->clear();
                break;
        }

    }

    public function executeComponent() {;
        $this->actions();

        global $APPLICATION;


        if (stripos($APPLICATION->GetCurPage(), 'cart') && empty($_REQUEST['action'])) {
            $basketItems = $this->basketItems;

            if ($basketItems['error'] != true) {
                $basket = new Basket();
                $basket->load();
                $this->arResult['ITEMS'] = $basketItems['items'];
                $this->arResult['TOTAL_PRICE'] = $basket->calculate();
            } else {
                $this->arResult = $basketItems;

            }
            $this->includeComponentTemplate();
        } else {
            if ($this->arResult) {
                $APPLICATION->RestartBuffer();
                header('Content-type: application/json');
                echo \Bitrix\Main\Web\Json::encode($this->arResult);
                die();
            } else {
                $this->arResult = $this->basketItems;
                $this->includeComponentTemplate();
            }
        }
    }
}
