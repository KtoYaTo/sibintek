<?php
namespace Sibintek\Tasks;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations;
use Bitrix\Main\ORM\Fields\TextField;


/**
 * Class TaskTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> UF_TITLE text optional
 * <li> UF_DESCRIPTION text optional
 * <li> UF_USR int optional
 * <li> UF_DATE_CREATED date optional
 * <li> UF_DATE_EXECUTION date optional
 * <li> UF_STATUS int optional
 * <li> UF_STATUS_L join left table
 * </ul>
 *
 * @package Sibintek\Tasks
 **/

class TaskTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'sibintek_tasks';
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
            ))->configureTitle(Loc::getMessage('TASK_ENTITY_ID_FIELD'))
                ->configurePrimary(true)
                ->configureAutocomplete(true)
            ,
            (new TextField('UF_TITLE',
                []
            ))->configureTitle(Loc::getMessage('TASK_ENTITY_UF_TITLE_FIELD'))
            ,
            (new TextField('UF_DESCRIPTION',
                []
            ))->configureTitle(Loc::getMessage('TASK_ENTITY_UF_DESCRIPTION_FIELD'))
            ,
            (new DateField('UF_DATE_CREATED',
                []
            ))->configureTitle(Loc::getMessage('TASK_ENTITY_UF_DATE_CREATED_FIELD'))
            ,
            (new DateField('UF_DATE_EXECUTION',
                []
            ))->configureTitle(Loc::getMessage('TASK_ENTITY_UF_DATE_EXECUTION_FIELD'))
            ,
            (new IntegerField('UF_STATUS',
                []
            ))
            ,
            new Relations\Reference(
                'UF_STATUS_L',
                'Sibintek\Tasks\StatusTable',
                ['=this.UF_STATUS' => 'ref.ID'],
                ['join_type' => 'LEFT'],
            ),
            (new IntegerField('UF_USR',
                []
            ))
            ,
//            new Relations\Reference(
//                'UF_USR',
//                '\Bitrix\Main\UserTable',
//                ['=this.ID' => 'ref.ID'],
//                ['join_type' => 'LEFT'],
//            ),
        ];
    }
}
