<?php

namespace Sprint\Migration;


class Version20240614123022 extends Version
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
  'NAME' => 'SibintekStatus',
  'TABLE_NAME' => 'sibintek_status',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'Сибинтек: статусы',
    ),
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
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
