<?php
/**
 * Created by Mihail Lukmanov <lukmanof92@gmail.com>
 * Date: 15.11.2017
 * Time: 23:29
 */

global $USER;
if ($USER->IsAdmin()) {
    CJSCore::Init(['jquery2']);
} else {
    \Bitrix\Main\Page\Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("public/js/jquery-2.2.3.min.js"));
}



\Bitrix\Main\Page\Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("public/libs/jquery-ui/jquery-ui.min.js"));
\Bitrix\Main\Page\Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("public/libs/input-mask/inputmask.js"));
\Bitrix\Main\Page\Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("public/libs/input-mask/jquery.inputmask.js"));
\Bitrix\Main\Page\Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("public/libs/fancybox/jquery.fancybox.pack.js"));
\Bitrix\Main\Page\Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("public/libs/arcticmodal/jquery.arcticmodal-0.3.min.js"));
\Bitrix\Main\Page\Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("public/libs/slick/slick.js"));
\Bitrix\Main\Page\Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("public/js/app.js"));
\Bitrix\Main\Page\Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("public/js/system.js"));
\Bitrix\Main\Page\Asset::getInstance()->addJs($APPLICATION->GetTemplatePath("public/js/cart.js"));

?>