<?
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class Sibintek_Tasks extends CModule
{
    const  MODULE_ID = "sibintek.tasks";
    public  $MODULE_ID = "sibintek.tasks";
    public  $MODULE_VERSION;
    public  $MODULE_VERSION_DATE;
    public  $MODULE_NAME;
    public  $MODULE_DESCRIPTION;
    public  $PARTNER_NAME;
    public  $PARTNER_URI;
//    public  $SHOW_SUPER_ADMIN_GROUP_RIGHTS;
    public  $MODULE_GROUP_RIGHTS;
    public  $errors;

    function __construct()
    {
        $arModuleVersion = array();
        include_once(__DIR__ . '/version.php');
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME = "Sibintek D7 Задачи";
        $this->MODULE_DESCRIPTION = "Тестовое задание: разработка модуля для Битрикс";
        $this->PARTNER_NAME = "Василий Гаврилов";
        $this->PARTNER_URI = "https://88001000766.ru";
//        $this->SHOW_SUPER_ADMIN_GROUP_RIGHTS = 'Y';
        $this->MODULE_GROUP_RIGHTS = 'Y';
    }

    function DoInstall()
    {
        global $APPLICATION;
        $this->InstallDB();
        $this->InstallEvents();
        $this->InstallFiles();
        return true;
    }

    function InstallDB()
    {
        ModuleManager::RegisterModule(self::MODULE_ID);
        return true;
    }

    function DoUninstall()
    {
        global $APPLICATION;
        $this->UnInstallFiles();
        $this->UnInstallEvents();
        $this->UnInstallDB();
        return true;
    }

    function UnInstallDB()
    {
        ModuleManager::UnRegisterModule(self::MODULE_ID);
        return true;
    }

    function InstallEvents()
    {
        return true;
    }

    function UnInstallEvents()
    {
        return true;
    }

    function InstallFiles()
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"].'/local/modules/'.self::MODULE_ID.'/install/public/', $_SERVER["DOCUMENT_ROOT"].'/',true,true);
        return true;
    }

    function UnInstallFiles()
    {
        DeleteDirFiles($_SERVER["DOCUMENT_ROOT"].'/local/modules/'.self::MODULE_ID.'/install/public', $_SERVER["DOCUMENT_ROOT"]);
        return true;
    }

}
