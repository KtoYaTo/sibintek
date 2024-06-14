<?php
namespace Sibintek\Tasks;

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\ORM\Data\DataManager,
    Bitrix\Main\ORM\Fields\IntegerField,
    Bitrix\Main\ORM\Fields\TextField;

Loc::loadMessages(__FILE__);

/**
 * Class StatusTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> UF_NAME text optional
 * </ul>
 *
 * @package Bitrix\Status
 **/

class StatusTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'sibintek_status';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            (new IntegerField('ID',
                []
            ))->configureTitle(Loc::getMessage('STATUS_ENTITY_ID_FIELD'))
                ->configurePrimary(true)
                ->configureAutocomplete(true),
            (new TextField('UF_NAME',
                []
            ))->configureTitle(Loc::getMessage('STATUS_ENTITY_UF_NAME_FIELD')),
        ];
    }
}
