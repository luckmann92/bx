<?php
use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\ModuleManager;
use \Bitrix\Main\Loader;
use \Redsign\LightBasket\Entity;

Loc::getMessage(__FILE__);

class website96_shop extends CModule
{
    public $MODULE_ID = 'website96.shop';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_CSS;
    public $MODULE_GROUP_RIGHTS = 'Y';

    const MODULE_DIR = '/local/modules/website96.shop';

    public function website96_shop() {
        $arModuleVersion = array();

        $path = str_replace('\\', '/', __FILE__);
        $path = substr($path, 0, strlen($path) - strlen('/index.php'));
        include $path.'/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
        $this->MODULE_NAME = Loc::getMessage('WS_SHOP_MODULE_INSTALL_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('WS_SHOP_MODULE_INSTALL_DESCRIPTION');
        $this->PARTNER_NAME = Loc::getMessage('WS_SHOP_MODULE_INSTALL_COMPANY_NAME');
        $this->PARTNER_URI = 'https://website96.ru/';
    }
}