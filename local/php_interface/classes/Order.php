<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

namespace Website96\Shop;

use \Bitrix\Main\Loader;
use \Bitrix\Iblock;
use \Bitrix\Iblock\Template\Entity;
use \Bitrix\Iblock\IblockTable;

class Order
{
    public $IBLOCK_ID;
    public $arOrderFields;

    public function __construct()
    {
        $this->IBLOCK_ID = $this->getIblockID('orders');
        $this->arOrderFields = $this->getFields();
    }

    public function getFields()
    {
        $arFields = array();
        $rsProperty = \Bitrix\Iblock\PropertyTable::getList(array(
            'filter' => array(
                'IBLOCK_ID' => $this->IBLOCK_ID,
                'ACTIVE'=>'Y'
            ),
            'select' => array('*'),
        ));

        while($arProperty = $rsProperty->fetch())
        {
            switch ($arProperty['LIST_TYPE']) {
                case 'L':
                    $rsEnum = \Bitrix\Iblock\PropertyEnumerationTable::getList(array(
                        'filter' => array('PROPERTY_ID' => $arProperty['ID']),
                    ));

                    while($arEnum = $rsEnum->fetch())
                    {
                        $arProperty['VALUES'][$arEnum['ID']] = $arEnum;
                    }
                    break;
            }
            $arFields[$arProperty['ID']] = $arProperty;
        }
        return $arFields;
    }

    protected function getIblockID($iblock_code)
    {
        $entity = new IblockTable();
        return $entity::getList(array(
            'select' => array('ID'),
            'filter' => array('CODE' => $iblock_code)
        ))->fetch()['ID'];
    }

    public function validateFields($arData)
    {
        if (!is_array($arData) || empty($this->arOrderFields)) {
            return false;
        } else {
            $this->arOrderFields['politic'] = array(
                    'IS_REQUIRED' => 'Y',
                    'NAME' => 'Политика конфиденциальности'
            );
        }

        $result = array();
        foreach ($this->arOrderFields as $fieldID => $field) {
            if ($field['IS_REQUIRED'] == 'Y') {
                if (empty($arData[$fieldID]) || !isset($arData[$fieldID])) {
                    $fieldName = $field['HINT'] ? $field['HINT'] : $field['NAME'];
                    $result['errors']['fields[' . $fieldID . ']' ] = 'Поле "' . $fieldName . '" обязательно для заполнения';
                }
            }
        }
        if (empty($result['errors'])) {
            $result['success'] = true;
        }

         return $result;

    }
}