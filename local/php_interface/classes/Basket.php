<?php
/**
 * Created by PhpStorm.
 * User: Notebook
 * Date: 07.01.2019
 * Time: 16:11
 */

namespace Website96\Shop;

use \Bitrix\Main\Loader;
use \Bitrix\Iblock;
use \Bitrix\Iblock\Template\Entity;
use \Bitrix\Iblock\IblockTable;

class Basket
{
    protected $basketItems;

    public function load()
    {
        if (!Loader::includeModule('iblock')) {
            return false;
        }
        $this->basketItems = self::getBasket();
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

        return $this->setBasket($this->basketItems);
    }

    public function update($id, $quantity) {
        if (intval($id) > 0 && isset($this->basketItems[$id])) {
            $this->basketItems[$id]['quantity'] = $quantity;

            return $this->setBasket($this->basketItems);
        } else {
            return false;
        }
    }

    public function clear() {
        return $this->setBasket(array());;
    }

    public function remove($id) {
        if (isset($this->basketItems[$id])) {
            unset($this->basketItems[$id]);
        }

        return $this->setBasket($this->basketItems);
    }

    public function calculate() {
        $res = array();
        $basketItems = $this->getItems();
        if (!empty($basketItems['items'])) {
            $prices = 0;
            foreach ($basketItems['items'] as $id => $arItem) {
                $prices = $prices + ($arItem['price'] * $arItem['quantity']);
            }
            $res = array(array(
                'name' => 'Итого',
                'value' => $prices
            ));
        }
        return $res;
    }

    public function getCounts()
    {
        $counts = 0;
        $basketItems = $this->getItems();
        if (!empty($basketItems['items'])) {
            foreach ($basketItems['items'] as $item) {
                $counts = $counts + $item['quantity'];
            }
        }

        return $counts;
    }

    public function getItem($id)
    {
        $basketItems = $this->basketItems;
        if (is_array($basketItems) && !empty($basketItems) && isset($basketItems[$id])) {
            $arItem = array();

            $arSelect = array('ID', 'IBLOCK_ID', 'IBLOCK.DETAIL_PAGE_URL', 'NAME', 'PREVIEW_PICTURE', 'CODE');
            $rsIBlockElement = Iblock\ElementTable::getList(array(
                'filter' => array(
                    '=ID' => $id,
                ),
                'select' => $arSelect,
            ));

            while ($arIBlockElement = $rsIBlockElement->fetch()) {
                $arItem['name'] = $arIBlockElement['NAME'];
                $arItem['url'] = \CIBlock::ReplaceDetailUrl(
                    $arIBlockElement['IBLOCK_ELEMENT_IBLOCK_DETAIL_PAGE_URL'],
                    $arIBlockElement,
                    true,
                    'E'
                );
                $arItem['quantity'] = $this->basketItems[$id]['quantity'];
                $arPrice = $this->getPrice($id);
                $arItem['price'] = $arPrice['price'];
                if ($arPrice['old_price']) {
                    $arItem['old_price'] = $arPrice['old_price'];
                }
                $arItem['total_price'] = $arPrice['price'] * $arItem['quantity'];
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
            }
        }

        if (!empty($arItem)) {
            return array('item' => $arItem);
        } else {
            return array(
                'error' => true,
                'message' => 'В корзине остутствует данный товар'
            );
        }
    }

    public function getItems()
    {
        if (is_array($this->basketItems) && !empty($this->basketItems)) {
            $arItems = array();

            foreach ($this->basketItems as $id => $basketItem) {
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
            return array('items' => $arItems);
        } else {
            return array(
                'error' => true,
                'message' => 'В корзине нет товаров'
            );
        }
    }

    public function getPrice($id)
    {
        $itemProperty = new Entity\ElementProperty($id);
        $itemProperty->setIblockId($this->getIblockID('catalog'));
        $arPrice = array(
            'price' => intval($itemProperty->getField('product_price')),
            'old_price' => intval($itemProperty->getField('product_old_price'))
        );

        return $arPrice;
    }

    protected function getIblockID($iblock_code) {
        $entity = new IblockTable();
        return $entity::getList(array(
            'select' => array('ID'),
            'filter' => array('CODE' => $iblock_code)
        ))->fetch()['ID'];
    }

    public function getBasket()
    {
        $basketItems = isset($_SESSION['BasketItems']) ? $_SESSION['BasketItems'] : array();
        return $basketItems;
    }

    public function setBasket($arItems)
    {
        if (is_null($arItems)) {
            return false;
        }

        $_SESSION['BasketItems'] = $arItems;
        $this->basketItems = self::getBasket();

        return true;
    }

    protected function actions() {
        $this->basketItems = $this->getBasket();

        $context = Context::getCurrent();
        $request = $context->getRequest();
        $action = trim($request->get('action'));

        switch ($action) {
            case 'order':

                return true;
                break;
        }
    }
}