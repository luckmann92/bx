<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Политика обработки персональных данных");
CModule::IncludeModule('fileman');
$params = array(
    "value" => "Обзор", // Текст на кнопке (по умолчанию "...")
    "mode" => "medialib", // Режим вызова отображения кнопки (есть ещё "select" и "file_dialog", но с ними не разбирался)
    "MedialibConfig" =>  array( // Параметры для создания объекта JS-класса BXMediaLib
        "arResultDest" => array(
            "FUNCTION_NAME" => "SetImagePage" // Функция, выполняемая при выборе файла
        ),
        "types" => array("image") // Типы файлов
    )
);
CMedialib::ShowBrowseButton($params);
?>Text here....<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>