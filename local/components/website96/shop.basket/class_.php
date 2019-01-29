<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Context;
use \Bitrix\Iblock;

class Cart extends CBitrixComponent
{
    private $basketItems;

    public function onIncludeComponentLang() {
        Loc::loadMessages(__FILE__);
    }

    protected function actions() {
        $this->basketItems = $this->getBasket();

        $context = Context::getCurrent();
        $request = $context->getRequest();
        $action = trim($request->get('action'));

        switch ($action) {
            case 'info':
                $this->arResult['items'] = $this->getBasketItems();
                break;
            case 'add':
                $this->add($request->get('id'), $request->get('quantity'));
                break;
            case 'update':
                $this->update($request->get('id'), $request->get('quantity'));
                break;
            case 'remove':
                $this->remove($request->get('id'));
                break;
            case 'clear':
                $this->clear();
                break;
        }
    }

    public function add($id, $quantity) {
        if (!isset($quantity)) {
            $quantity = 1;
        }

        if (isset($this->basketItems[$id])) {
            $this->basketItems[$id]['quantity'] = $this->basketItems[$id]['quantity'] + $quantity;
        } else {
            $this->basketItems[$id]['quantity'] = $quantity;
        }

        $this->setBasketItems($this->basketItems);
        $this->arResult['item'] = $this->getItem($id);
    }

    public function update($id, $quantity) {
        if (intval($id) > 0 && isset($this->basketItems[$id])) {
            $this->basketItems[$id]['quantity'] = $quantity;
            $this->setBasketItems($this->basketItems);
            $this->arResult['item'] = $this->getItem($id);
        } else {
            $this->arResult['error'] = true;
            $this->arResult['message'] = 'Ошибка обновления: неверный id';
        }
    }

    public function clear() {
        $this->setBasketItems(array());
        $this->arResult['error'] = false;
    }

    public function remove($id) {
        if (isset($this->basketItems[$id])) {
            unset($this->basketItems[$id]);
        }
        $this->setBasketItems($this->basketItems);
        $this->arResult['error'] = false;
    }

    private function setBasketItems($items) {
        if (is_array($items)) {
            $_SESSION['BasketItems'] = $items;
            $this->basketItems = $this->getBasket();
            return $this->basketItems;
        } else {
            return false;
        }
    }

    public function calculate() {
        $res = array();
        $basketItems = $this->getBasketItems();
        if (!empty($basketItems)) {
            $prices = 0;
            foreach ($basketItems as $id => $arItem) {
                $prices = $prices + ($arItem['price'] * $arItem['quantity']);
            }
            $res = array(
                'name' => 'Итого',
                'value' => $prices
            );
            $this->arResult['prices'] = array($res);
        }
        return $res;
    }

    private function getItem($id) {
        $arItem = array();
        $arSelect = array(
            'ID', 'IBLOCK_ID', 'IBLOCK.DETAIL_PAGE_URL', 'NAME', 'PREVIEW_PICTURE', 'CODE'
        );

        $rsIBlockElement = Iblock\ElementTable::getList(array(
            'filter' => array(
                '=ID' => $id,
            ),
            'select' => $arSelect,
        ));
        $basketItems = $this->getBasket();
        while ($arIBlockElement = $rsIBlockElement->fetch()) {
            $arPrice = $this->getPrice($arIBlockElement['ID']);
            $arItem['name'] = $arIBlockElement['NAME'];
            $arItem['quantity'] = intval($basketItems[$arIBlockElement['ID']]['quantity'] ? $basketItems[$arIBlockElement['ID']]['quantity'] : 1);
            $arItem['price'] = $arPrice['price'];
            if ($arPrice['old_price']) {
                $arItem['old_price'] = $arPrice['old_price'];
            }
            $arItem['url'] = \CIBlock::ReplaceDetailUrl(
                $arIBlockElement['IBLOCK_ELEMENT_IBLOCK_DETAIL_PAGE_URL'],
                $arIBlockElement,
                true,
                'E'
            );
            if ($arIBlockElement['PREVIEW_PICTURE']) {
                $arFileTmp = \CFile::ResizeImageGet(
                    $arIBlockElement['PREVIEW_PICTURE'],
                    array('width' => 90, 'height' => 90),
                    BX_RESIZE_IMAGE_PROPORTIONAL,
                    true
                );

                if($arFileTmp['src']) {
                    $arItem['img'] = \CUtil::GetAdditionalFileURL($arFileTmp['src'], true);
                }
            }
            $arItem['total_price'] = $arItem['price'] * $arItem['quantity'];

        }
        return $arItem;
    }

    public function getBasket() {
        if (is_array($_SESSION['BasketItems'])) {
            $this->basketItems = $_SESSION['BasketItems'];
        } else {
            $this->basketItems = array();
        }
        return $this->basketItems;
    }

    public function getBasketItems() {
        $basketItems = $this->getBasket();

        if (is_array($basketItems) && !empty($basketItems)) {
            $arItems = array();

            foreach ($basketItems as $id => $basketItem) {
                $arItems[$id] = array(
                    'id' => $id,
                    'quantity' => intval($basketItem['quantity'])
                );
            }
            $arSelect = array(
                'ID', 'IBLOCK_ID', 'IBLOCK.DETAIL_PAGE_URL', 'NAME', 'PREVIEW_PICTURE', 'CODE'
            );
            $rsIBlockElement = Iblock\ElementTable::getList(array(
                'filter' => array(
                    '=ID' => array_keys($arItems),
                ),
                'select' => $arSelect,
            ));
            while ($arIBlockElement = $rsIBlockElement->fetch()) {
                if (isset($arItems[$arIBlockElement['ID']])) {
                    $arItem = &$arItems[$arIBlockElement['ID']];
                    $arItem['name'] = $arIBlockElement['NAME'];

                    if ($arIBlockElement['PREVIEW_PICTURE']) {
                        $arFileTmp = \CFile::ResizeImageGet(
                            $arIBlockElement['PREVIEW_PICTURE'],
                            array('width' => 90, 'height' => 90),
                            BX_RESIZE_IMAGE_PROPORTIONAL,
                            true
                        );

                        if($arFileTmp['src']) {
                            $arItem['img'] = \CUtil::GetAdditionalFileURL($arFileTmp['src'], true);
                        }
                    }

                    $arItem['url'] = \CIBlock::ReplaceDetailUrl(
                        $arIBlockElement['IBLOCK_ELEMENT_IBLOCK_DETAIL_PAGE_URL'],
                        $arIBlockElement,
                        true,
                        'E'
                    );
                    $arPrice = $this->getPrice($arIBlockElement['ID']);

                    $arItem['price'] = $arPrice['price'];

                    if ($arPrice['old_price']) {
                        $arItem['old_price'] = $arPrice['old_price'];
                    }
                    $arItem['total_price'] = $arItem['price'] * $arItem['quantity'];
                }
            }
            unset($arItem);
        }

        if (!empty($arItems)) {
            return $arItems;
        } else {
            return array(
                'error' => true,
                'message' => 'В корзине нет товаров'
            );
        }
    }

    protected function getIblockID($iblock_code) {
        $entity = new Bitrix\Iblock\IblockTable();
        return $entity::getList(array(
            'select' => array('ID'),
            'filter' => array('CODE' => $iblock_code)
        ))->fetch()['ID'];
    }

    public function getPrice($id) {
        $itemProperty = new Iblock\Template\Entity\ElementProperty($id);
        $itemProperty->setIblockId($this->getIblockID('catalog'));
        $arPrice = array(
            'price' => intval($itemProperty->getField('product_price')),
            'old_price' => intval($itemProperty->getField('product_old_price'))
        );

        return $arPrice;
    }

    public function executeComponent() {
        $this->actions();

        if ($this->arResult) {
            $this->calculate();
            define("NO_KEEP_STATISTIC", true);
            global $APPLICATION;
            $APPLICATION->RestartBuffer();
            header('Content-type: application/json');
            echo \Bitrix\Main\Web\Json::encode($this->arResult);
            die();
        } else {
            $this->includeComponentTemplate();
        }
    }
}
