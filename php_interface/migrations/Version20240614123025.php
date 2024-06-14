<?php

namespace Sprint\Migration;


class Version20240614123025 extends Version
{
    protected $author = "admin";

    protected $description = "";

    protected $moduleVersion = "4.9.4";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
    $hlblockId = $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'SibintekTask',
  'TABLE_NAME' => 'sibintek_tasks',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'Сибинтек: задачи',
    ),
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_TITLE',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'Y',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Название',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Название',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Название',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => 'Название',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => 'Название',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '200',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'Y',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => 'Описание',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => 'Описание',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_USR',
  'USER_TYPE_ID' => 'top10usertypeuser',
  'XML_ID' => '',
  'SORT' => '300',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Пользователь',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Пользователь',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Пользователь',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => 'Пользователь',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => 'Пользователь',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_DATE_CREATED',
  'USER_TYPE_ID' => 'date',
  'XML_ID' => '',
  'SORT' => '400',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 
    array (
      'TYPE' => 'NONE',
      'VALUE' => '',
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Дата создания',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Дата создания',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Дата создания',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => 'Дата создания',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => 'Дата создания',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_DATE_EXECUTION',
  'USER_TYPE_ID' => 'date',
  'XML_ID' => '',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 
    array (
      'TYPE' => 'NONE',
      'VALUE' => '',
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Дата исполнения',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Дата исполнения',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Дата исполнения',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => 'Дата исполнения',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => 'Дата исполнения',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_STATUS',
  'USER_TYPE_ID' => 'hlblock',
  'XML_ID' => '',
  'SORT' => '600',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DISPLAY' => 'LIST',
    'LIST_HEIGHT' => 1,
    'HLBLOCK_ID' => 'SibintekStatus',
    'HLFIELD_ID' => 'UF_NAME',
    'DEFAULT_VALUE' => 1,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Статус',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Статус',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Статус',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => 'Статус',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => 'Статус',
  ),
));
        }
}
