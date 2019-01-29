<?php
/**
 * @author Danil Syromolotov <ds@itex.ru>
 */
$arTemplateParameters = array(
    'VALUE' => array(
        'PARENT' => 'LINK_PARAMETERS',
        'TYPE' => 'STRING',
        'NAME' => 'Текст',
    ),
    'VALUE_IMG' => array(
        'PARENT' => 'LINK_PARAMETERS',
        'TYPE' => 'FILE',
        'NAME' => 'Изображение',
        "FD_TARGET" => "F",
        "FD_EXT" => "jpg,jpeg,png,gif",
        "FD_UPLOAD" => true,
        "FD_USE_MEDIALIB" => true,
        "FD_MEDIALIB_TYPES" => Array("image"),
    ),
    "URL" => array(
        "PARENT" => "LINK_PARAMETERS",
        "TYPE" => "STRING",
        "NAME" => "Ссылка",
    ),
    "CSS_CLASS" => array(
        "PARENT" => "LINK_PARAMETERS",
        "TYPE" => "STRING",
        "NAME" => "CSS классы",
    ),
);