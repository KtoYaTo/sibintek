<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("ТАБЛИЦА");

if (\Bitrix\Main\Loader::includeModule('sibintek.tasks')) {
    \Sibintek\Tasks\Main::Start();
}
