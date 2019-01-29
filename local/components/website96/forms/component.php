<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
}
$arResponse = array();
$arPolicyField = array(
    'CODE' => 'PRIVACY_POLICY',
    'PROPERTY_TYPE' => 'L',
    'URL' => $arParams['FORM_POLITIC_URL'] ?: '',
    'NAME' => GetMessage('WEBSITE96_FORMS_COMPONENT_PRIVACY_POLICY'),
    'HINT' => GetMessage('WEBSITE96_FORMS_COMPONENT_PRIVACY_POLICY_HINT'),
    'DEFAULT_VALUE' => 'on'
);
if(is_array($arParams['FORM_REQUIRED_FIELDS'])){
    $arParams['FORM_REQUIRED_FIELDS'][$arPolicyField['CODE']] = $arPolicyField['CODE'];
}

if(!isset($arParams['IBLOCK_ID']) || strlen($arParams['IBLOCK_ID']) == 0){
    echo GetMessage("WEBSITE96_FORMS_COMPONENT_ERROR_NOT_IBLOCK");
    return false;
}

if (!isset($_REQUEST["ajax_form"]) || empty($_REQUEST["ajax_form"])) {
    $signer = new \Bitrix\Main\Security\Sign\Signer;
    $params = $arParams;
    $newParams = [];
    foreach ($params as $key => $value) {
        if (strncmp($key, "~", strlen("~")) == 0) {
            $newParams[ substr($key, 1) ] = $value;
        }
    }
    $arResult["JSON_SIGN"] = urlencode(base64_encode($signer->sign(base64_encode(serialize($newParams)), "ajax_form_" . $arParams["IBLOCK_ID"])));
}


if(CModule::IncludeModule("iblock") && $arParams['IBLOCK_ID'] > 0) {
    $arPropList = array();
    $rsIBlockProps = CIBlockProperty::GetList(array("SORT"=>"ASC"), array('ACTIVE'=>'Y', 'IBLOCK_ID' => $arParams['IBLOCK_ID']));
    while ($arIBlockProp = $rsIBlockProps->GetNext()){
        $arPropList[$arIBlockProp['ID']] = $arIBlockProp;
    }
    if(is_array($arParams['FORM_FIELDS']) && count($arParams['FORM_FIELDS']) > 0){
        foreach ($arParams['FORM_FIELDS'] as $i => $propertyID) {
            if($arParams['FORM_PRODUCT_ADD'] == "Y" && $arParams['FORM_PRODUCT_ID'] > 0){
                if($arPropList[$propertyID]['PROPERTY_TYPE'] == 'E'){
                    $arFilter = array('IBLOCK_ID' => $arPropList[$propertyID]["LINK_BLOCK_ID"], 'ID' => $arParams['FORM_PRODUCT_ID'], 'ACTIVE' => 'Y');
                    $arSelect = array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "SORT", "DETAIL_PAGE_URL", "PROPERTY_*");
                    $rsElement = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
                    while ($ob = $rsElement->GetNextElement()){
                        $propertyTYPE = $arPropList[$propertyID]['PROPERTY_TYPE'];
                        $propertyCODE = $arPropList[$propertyID]['CODE'];
                        $arPropList[$propertyID] = $ob->GetFields();
                        $arPropList[$propertyID]['CODE'] = $propertyCODE;
                        $arPropList[$propertyID]['PROPERTY_TYPE'] = $propertyTYPE;
                        $arPropList[$propertyID]['PROPERTIES'] = $ob->GetProperties();
                        if($arPropList[$propertyID]['PREVIEW_PICTURE']){
                            $pictureID = $arPropList[$propertyID]['PREVIEW_PICTURE'];
                            $pictureURL = CFile::ResizeImageGet(
                                CFile::GetByID($pictureID)->Fetch(),
                                array(
                                    'width' => 96,
                                    'height' => 96
                                ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
                                true)['src'];
                            $arPropList[$propertyID]['PREVIEW_PICTURE'] = $pictureURL;
                        }
                    }
                }
            }
        }
        $arPropList['PRIVACY_POLICY'] = $arPolicyField;
        $arResult['FIELDS'] = $arPropList;
    }
}

if(isset($_REQUEST['ajax_send']) && $_REQUEST['ajax_send'] == "Y" && check_bitrix_sessid()) {
    $arFields = $_REQUEST['FIELDS'];

    if(!is_array($arFields))
        $arFields = Array();

    $strBodyMessage = 'Данные с формы обраной связи';
    $strBodyMessage .= "\n\n";
    $strBodyMessage .= '------------------------------------------'."\n\n";

    foreach ($arParams['FORM_REQUIRED_FIELDS'] as $i => $propertyID) {
        $propertyCODE = $arResult['FIELDS'][$propertyID]['CODE'];

        if(!isset($arFields[$propertyCODE]) || empty($arFields[$propertyCODE]) || $arFields[$propertyCODE] == null){
            if ($arResult['FIELDS'][$propertyID]['PROPERTY_TYPE'] == "S") {
                $arResponse['error'][$propertyCODE] = $arResult['FIELDS'][$propertyID]['HINT'] ? $arResult['FIELDS'][$propertyID]['HINT'] : '"' . $arResult['FIELDS'][$propertyID]['NAME'] . '"' . GetMessage('WEBSITE96_FORMS_COMPONENT_ERROR_EMPTY_FIELD');
            } elseif ($arResult['FIELDS'][$propertyID]['PROPERTY_TYPE'] == "L") {
                $arResponse['error'][$arResult['FIELDS'][$propertyID]['CODE']] = GetMessage('WEBSITE96_FORMS_COMPONENT_ERROR_AGREEMENT');
            }
        } else {
            if($arResult['FIELDS'][$propertyID]['PROPERTY_TYPE'] == "S") {
                $strBodyMessage .= $arResult['FIELDS'][$propertyID]['NAME'].': '.htmlspecialcharsback($arFields[$propertyCODE])."\n";
            } elseif($arResult['FIELDS'][$propertyID]['PROPERTY_TYPE'] == "E") {
                $strBodyMessage .= 'Выбранный элемент: '.$arResult['FIELDS'][$propertyID]['NAME']."\n";
            }
        }

    }
    $strBodyMessage .= '------------------------------------------';
    $strBodyMessage .= "\n\n";
    $strBodyMessage .= 'Письмо сгенерировано автоматически и не требует ответа';

    if(!is_array($arResponse['error'])){
        $el = new CIBlockElement;

        $arElementFields = array(
            'NAME' => date('d.m.Y H:m:s'),
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            'PROPERTY_VALUES' => $arFields
        );
        if($ID = $el->Add($arElementFields)) {
            $et = new CEventType;
            $arIBlockMessage = CIBlock::GetByID($arParams["IBLOCK_ID"])->GetNext();
            $eventID = $et->Add(array(
                "LID" => LANGUAGE_ID,
                "EVENT_NAME" => trim(htmlspecialcharsEx($arIBlockMessage['CODE'])),
                "NAME" => $arIBlockMessage['NAME'],
                "DESCRIPTION" => $arIBlockMessage['DESCRIPTION']
            ));
            $emess = new CEventMessage;
            $arMessage = Array(
                "ACTIVE" => "Y",
                "LID" => SITE_ID,
                "EVENT_NAME" => trim(htmlspecialcharsEx($arIBlockMessage['CODE'])),
                "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
                "EMAIL_TO" => "#DEFAULT_EMAIL_FROM#",
                "SUBJECT" => 'Заявка с формы "'.$arIBlockMessage['NAME'].'"',
                "BODY_TYPE" => "text",
                "MESSAGE" => '#MESSAGE#'
            );
            $arEventID = $emess->GetByID($eventID)->GetNext();
            if($arEventID['ID'] > 0){
                $res = $emess->Update($arEventID['ID'], $arMessage);
            } else {
                $arEventID['ID'] = $emess->Add($arMessage);
            }

            if(CEvent::Send($arIBlockMessage['CODE'], SITE_ID, array('MESSAGE' => $strBodyMessage),'N', $arEventID['ID'])){
                $arResponse['success'] = 'Заявка отправлена!';
            }
        } else {
            $arResponse['error']['ADD_MESSAGE'] = 'Ошибка: '.$el->LAST_ERROR;
        }
    }


    $APPLICATION->RestartBuffer();
    echo json_encode($arResponse);
    die();
} elseif(isset($_REQUEST['ajax_form']) && !empty($_REQUEST['ajax_form'])) {
    $APPLICATION->RestartBuffer();
    $this->IncludeComponentTemplate();
    die();
} else {
    $this->IncludeComponentTemplate();
}