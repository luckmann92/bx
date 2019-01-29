<?php
/**
 * Created by Mihail Lukmanov <lukmanof92@gmail.com>
 * User: Home
 * Date: 15.11.2017
 * Time: 23:09
 */

function NumPluralForm($number, $titles, $appendNumber = false)
{
    $cases = array(2, 0, 1, 1, 1, 2);

    return ($appendNumber ? ($number . " ") : "") . $titles[ ($number % 100 > 4
            && $number % 100 < 20) ? 2 : $cases[ min($number
            % 10, 5) ] ];
}

/**
 * @param array    $listArray
 * @param array    $targetArray
 * @param int|null $parentID
 * @param string   $parentAttribute
 * @param string   $idAttribute
 */
function dump($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}
function MapToTree($listArray, &$targetArray = [], $parentID = null, $parentAttribute = "IBLOCK_SECTION_ID", $idAttribute = "ID")
{
    foreach ($listArray as $key => $value) {
        if (array_key_exists($parentAttribute, $value) && $value[ $parentAttribute ] == $parentID) {
            $value["TREE_CHILDS"] = [];
            MapToTree($listArray, $value["TREE_CHILDS"], $value[ $idAttribute ], $parentAttribute, $idAttribute);
            if (empty($value["TREE_CHILDS"])) {
                unset($value["TREE_CHILDS"]);
            }
            $targetArray[] = $value;
        }
    }
}

/**
 * @param array  $targetArray
 * @param string $searchKey
 * @param string $searchValue
 * @param array  $defaultValue
 */
function ArrayItemByKeyValue($targetArray, $searchKey, $searchValue, $defaultValue = [])
{
    $dataItem = $defaultValue;
    foreach ($targetArray as $arItem) {
        if (isset($arItem[ $searchKey ]) && $arItem[ $searchKey ] == $searchValue) {
            $dataItem = $arItem;
            break;
        }
    }

    return $dataItem;
}

/**
 * @param string $iblockType
 * @param string $iblockCode
 *
 * @return mixed
 */
function AppGetCascadeDirProperties($PROPERTY_ID, $default_value = false)
{
    global $APPLICATION;
    $pathMap = explode("/", trim(substr($APPLICATION->GetCurDir(), strlen(SITE_DIR)), "/"));
    do {
        $path = SITE_DIR . implode("/", $pathMap);
        $propertyValue = $APPLICATION->GetDirProperty($PROPERTY_ID, $path, false);
        if ($propertyValue !== false) {
            break;
        }
        array_pop($pathMap);
    }
    while (!empty($pathMap));

    return $propertyValue === false ? $default_value : $propertyValue;
}

function GetIconSVG($iconName){
    $iconPath = $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/public/images/icons/'.$iconName.'.svg';
    if(file_exists($iconPath)){
        return file_get_contents($iconPath);
    }
}