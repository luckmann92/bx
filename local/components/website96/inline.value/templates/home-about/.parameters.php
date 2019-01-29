<?php
/**
 * @author Danil Syromolotov <ds@itex.ru>
 */
$arTemplateParameters = array(
    'BLOCK_TITLE' => array(
        'PARENT' => 'BLOCK_PARAMETERS',
        'TYPE' => 'STRING',
        'NAME' => 'Заголовок блока',
    ),
    'BLOCK_IMG' => array(
        'PARENT' => 'BLOCK_PARAMETERS',
        'TYPE' => 'FILE',
        'NAME' => 'Изображение в блоке',
        "FD_TARGET" => "F",
        "FD_EXT" => "jpg,jpeg,png,gif",
        "FD_UPLOAD" => true,
        "FD_USE_MEDIALIB" => true,
        "FD_MEDIALIB_TYPES" => Array("image"),
    ),
    'BLOCK_DESCRIPTION' => array(
        'PARENT' => 'BLOCK_PARAMETERS',
        'TYPE' => 'CHECKBOX',
        'NAME' => 'Выводить описанние блока',
    ),
    'BLOCK_URL' => array(
        'PARENT' => 'BLOCK_PARAMETERS',
        'TYPE' => 'STRING',
        'NAME' => 'Ссылка "Подробнее"',
    )
);