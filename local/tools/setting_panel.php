<?php
$arSites['CATALOG'] = [
    0 => [
        'NAME' => 'Мебельная компания',
        'ID_CATALOG' => 17,
        'ID_STOCKS' => 18,
        'ID_SLIDER' => 19,
        'COLOR' => [
            'ACTION' => 'green',
            'MAIN' => 'black'
        ]
    ]
];

define('STOP_STATISTICS', true);
define('NO_KEEP_STATISTIC', 'Y');
define('NO_AGENT_STATISTIC', 'Y');
define('DisableEventsCheck', true);
define('BX_SECURITY_SHOW_MESSAGE', true);
define('XHR_REQUEST', true);

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_after.php");

if($_REQUEST['ajax_request'] == 'y'){
    $json = [];
    if(is_array($arSites[$_REQUEST['data']['value']]) && !empty($arSites[$_REQUEST['data']['value']])){
        foreach($arSites[$_REQUEST['data']['value']] as $k => $arSite){
            $json['sites'][$k] = $arSite['NAME'];
        }
    }

    echo json_encode($json);
} else {
    $APPLICATION->IncludeComponent(
        "website96:setting.panel",
        ".default",
        ['COMPONENT_TEMPLATE' => '.default'],
        $component,
        ['HIDE_ICONS' => 'Y']
    );
}


