<?php

namespace Sibintek\Tasks;

use Bitrix\Main\UI\PageNavigation;

class Main
{
    private static array $access_by_table =
        [
            'ID',
            'UF_TITLE',
            'UF_DESCRIPTION',
            'UF_DATE_CREATED',
            'UF_DATE_EXECUTION',
            'UF_STATUS',
            'USR'
        ];

    private static array $access_order_table =
        [
            'DESC',
            'ASC'
        ];

    public static $total_page = 5;

    public static function Start()
    {
        global $APPLICATION;

        $list_id = TaskTable::getTableName();
        $filter_list = self::getFilterList();

        $grid_options = new \Bitrix\Main\Grid\Options($list_id);
        $sort = $grid_options->GetSorting(['sort' => ['UF_DATE_CREATED' => 'ASC'], 'vars' => ['by' => 'by', 'order' => 'order']]);

        // Проверяем на валидность полей сортировки
        $nav_params = $grid_options->GetNavParams();
        self::ValidateTable($sort);

        $nav = new PageNavigation('task_list');
        $nav->allowAllRecords(true)
            //->setPageSize($nav_params['nPageSize']) //Метод устанавливает размер страницы для модуля grid
            ->setPageSize(self::$total_page)
            ->initFromUri();

        $request = \Bitrix\Main\Context::getCurrent()->getRequest();
        $postdata = $request->getValues();
        self::otputFilterHTML($filter_list, $postdata);
        $filter_arrays = self::getFilterData($list_id, $postdata);

        $table_args = [
            "select" => [
                "ID",
                "UF_TITLE",
                "UF_DESCRIPTION",
                "UF_DATE_CREATED",
                "UF_DATE_EXECUTION",
                "UF_STATUS",
                "UF_STATUS_L.UF_NAME",
                "USR.LAST_NAME",
                "USR.NAME",
                "USR.SECOND_NAME",
            ],
            'filter' => [

                "LOGIC" => "AND",
                $filter_arrays

            ],
            'order' => $sort["sort"],
            'offset' => ($offset = $nav->getOffset()),
            'limit' => (($limit = $nav->getLimit()) > 0 ? $limit : 0),
            'count_total' => true,
            'runtime' =>
                [
                    'USR' => [
                        'data_type' => \Bitrix\Main\UserTable::class,
                        'reference' => [
                            '=this.UF_USR' => 'ref.ID',
                        ]
                    ],
                ],
        ];
        $datas = TaskTable::getList($table_args);
        $data_array = $datas->fetchAll();
        $nav->setRecordCount($datas->getCount());
        $rows = [];
        foreach ($data_array as $key => $value) {
            $user_short_name = $value["SIBINTEK_TASKS_TASK_USR_LAST_NAME"];
            if (trim($value["SIBINTEK_TASKS_TASK_USR_NAME"])) $user_short_name .= ' ' . mb_strtoupper(mb_substr($value["SIBINTEK_TASKS_TASK_USR_NAME"], 0, 1,)) . '.';
            if (trim($value["SIBINTEK_TASKS_TASK_USR_SECOND_NAME"])) $user_short_name .= ' ' . mb_strtoupper(mb_substr($value["SIBINTEK_TASKS_TASK_USR_SECOND_NAME"], 0, 1)) . '.';
            $user_short_name = trim($user_short_name);
            $row = [
                'data' => [ //Данные ячеек
                    "ID" => $value["ID"],
                    "TITLE" => $value["UF_TITLE"],
                    "DESCRIPTION" => $value["UF_DESCRIPTION"],
                    "USR" => $user_short_name,
                    "DATE_CREATED" => $value["UF_DATE_CREATED"],
                    "DATE_EXECUTION" => $value["UF_DATE_EXECUTION"],
                    "STATUS" => $value["SIBINTEK_TASKS_TASK_UF_STATUS_L_UF_NAME"],
                ],
            ];
            $rows[] = $row;
        }

        $APPLICATION->IncludeComponent('bitrix:main.ui.grid', '', [
            'GRID_ID' => $list_id,
            'COLUMNS' => [
                ['id' => 'TITLE', 'name' => 'Заголовок', 'sort' => 'UF_TITLE', 'default' => true],
                ['id' => 'DESCRIPTION', 'name' => 'Описание', 'sort' => 'UF_DESCRIPTION', 'default' => true],
                ['id' => 'USR', 'name' => 'Пользователь', 'sort' => 'USR', 'default' => true],
                ['id' => 'DATE_CREATED', 'name' => 'Дата создания', 'sort' => 'UF_DATE_CREATED', 'default' => true],
                ['id' => 'DATE_EXECUTION', 'name' => 'Дата исполнения', 'sort' => 'UF_DATE_EXECUTION', 'default' => true],
                ['id' => 'STATUS', 'name' => 'Статус', 'sort' => 'UF_STATUS', 'default' => true],
            ],
            'ROWS' => $rows,
            'TOTAL_ROWS_COUNT' => $datas->getCount(),
            'NAV_OBJECT' => $nav,
//            '~NAV_PARAMS' => $nav,
            'NAV_PARAM_NAME' => 'page',
            'CURRENT_PAGE' => 0,//$nav->getOffset(),
            'AJAX_MODE' => 'Y',
            'AJAX_ID' => \CAjax::getComponentID('bitrix:main.ui.grid', '.default', ''),
            'PAGE_SIZES' => self::PaginatorCount(),
            'AJAX_OPTION_JUMP' => 'N',
            'SHOW_ROW_CHECKBOXES' => false,
            'SHOW_CHECK_ALL_CHECKBOXES' => false,
            'CURRENT_PAGE' => true,
            'SHOW_MORE_BUTTON' => false,
            'SHOW_ROW_ACTIONS_MENU' => false,
            'SHOW_GRID_SETTINGS_MENU' => false,
            'SHOW_NAVIGATION_PANEL' => false, // Разрешает отображение кнопки панели навигации. (Постраничка, размер страницы и т. д.)
            'SHOW_PAGINATION' => false, // Разрешает отображение постраничной навигации
            'SHOW_PAGESIZE' => false, // количество на странице
            'SHOW_SELECTED_COUNTER' => false, //Разрешает отображение счетчика выделенных строк
            'SHOW_TOTAL_COUNTER' => false,
            'SHOW_ACTION_PANEL' => false,
            'ALLOW_COLUMNS_SORT' => true,
            'ALLOW_COLUMNS_RESIZE' => true,
            'ALLOW_HORIZONTAL_SCROLL' => true,
            'ALLOW_SORT' => true,
            'ALLOW_PIN_HEADER' => true,
            'AJAX_OPTION_HISTORY' => 'N'
        ]);


        $APPLICATION->IncludeComponent(
            "bitrix:main.pagenavigation",
            "",
            array(
                "NAV_OBJECT" => $nav,
                "SEF_MODE" => "N",
                "SHOW_COUNT" => "N",
            ),
            false
        );
    }

    public static function PaginatorCount()
    {
        return [
            ['NAME' => "5", 'VALUE' => '5'],
            ['NAME' => '10', 'VALUE' => '10'],
            ['NAME' => '20', 'VALUE' => '20'],
            ['NAME' => '50', 'VALUE' => '50'],
            ['NAME' => '100', 'VALUE' => '100'],
        ];
    }

    private static function ValidateTable(&$sort)
    {
        $sorting = $sort["sort"];
        if ($sort_key = array_keys($sorting)) {
            if (!in_array(mb_strtoupper($sort_key[0]), self::$access_by_table)) {
                $sorting = ['UF_DATE_CREATED' => 'DESC'];
            }
            if ($sort_key[0] == "USR") {
                $sorting = [
                    'USR.LAST_NAME' => $sorting[$sort_key[0]],
                    'USR.NAME' => $sorting[$sort_key[0]],
                    'USR.SECOND_NAME' => $sorting[$sort_key[0]],
                ];
            }
        }
        if ($sort_values = array_values($sorting)) {
            if (!in_array(mb_strtoupper($sort_values[0]), self::$access_order_table)) {
                $sorting = ['UF_DATE_CREATED' => 'DESC'];
            }
        }
        $sort["sort"] = $sorting;
    }

    private static function getOptionsStatusMyFilter()
    {
        $status_datas = StatusTable::getList([
            'select' => ['ID', 'UF_NAME'],
            'order' => ['UF_NAME' => 'ASC']
        ])->fetchAll();
        $options = [];
        foreach ($status_datas as $key => $value) {
            $options[] = ['name' => $value['ID'], 'value' => $value['UF_NAME']];
        }
        return $options;
    }

    private static function getFilterList()
    {
        return [
            ['id' => 'FIND', 'name' => 'Поиск', 'type' => 'text', 'label' => 'Поиск', 'placeholder' => 'Поиск', 'default' => true],
            ['id' => 'DATE_FROM', 'name' => 'c', 'type' => 'date', 'label' => 'с', 'default' => true],
            ['id' => 'DATE_TO', 'name' => 'по', 'type' => 'date', 'label' => 'по', 'default' => true],
            ['id' => "STATUS", 'name' => 'Статус', 'label' => 'Статус', 'type' => 'list',
                "items" => [
                    ['name' => '0', 'value' => 'ВСЕ'],
                    ...self::getOptionsStatusMyFilter()
                ], 'default' => true
            ]
        ];
    }

    private static function otputFilterHTML(...$args)
    {
        ?>
        <form method="get" id="sibintek_filter">
            <div class="filter" action="action=setFilters">
                <? foreach ($args[0] as $key => $arg) {
                    if ($arg['type'] == 'text') {
                        ?>
                        <div>
                            <input type="<?= $arg['type']; ?>" name="<?= $arg['id']; ?>" value="<?= $args[1][$arg['id']]; ?>"
                                   placeholder="<?= $arg['placeholder']; ?>">
                            <?php if ($arg['id'] == "FIND") { ?>
                                <div span="btn"><input type="submit" value="<?= $arg['label']; ?>"
                                                       class="<?= strtolower($arg['id']); ?>"/></div>
                            <? } ?>
                        </div> <?
                    } elseif ($arg['type'] == 'date') {
                        ?>
                        <div>
                            <label><?= $arg['label']; ?></label>
                            <input type="<?= $arg['type']; ?>" name="<?= $arg['id']; ?>" value="<?= $args[1][$arg['id']]; ?>"
                                   class="<?= strtolower($arg['id']); ?>">
                        </div> <?
                    } elseif ($arg['type'] == 'list') { ?>
                        <div>
                            <label><?= $arg['label']; ?></label>
                            <select name="<?= $arg['id']; ?>" class="<?= strtolower($arg['id']); ?>">
                                <?php foreach ($arg['items'] as $ky => $vl) { ?>
                                    <option value="<?= $vl['name']; ?>" <? if ($vl['name'] == $args[1][$arg['id']]){ ?> selected<? } ?>><?= $vl['value']; ?></option><? } ?>
                            </select>
                        </div>
                    <? } ?>
                <? } ?>
            </div>
            <input type="hidden" name="GRID_ID" value="sibintek_tasks">
            <input type="hidden" name="FILTER_ID" value="sibintek_tasks">
            <input type="hidden" name="action" value="setFilters">
        </form>
        <script>
            const form_sibintek_filter = document.getElementById('sibintek_filter');
            var select_sibintek_filter = document.querySelector('#sibintek_filter .status'),
                input_sibintek_filter_date_from = document.querySelector('#sibintek_filter .date_from'),
                input_sibintek_filter_date_to = document.querySelector('#sibintek_filter .date_to');
            select_sibintek_filter.addEventListener('change', function () {
                form_sibintek_filter.submit();
            });
            input_sibintek_filter_date_to.addEventListener('change', function () {
                form_sibintek_filter.submit();
            });
            input_sibintek_filter_date_from.addEventListener('change', function () {
                form_sibintek_filter.submit();
            });
        </script>
        <?php
    }
    private static function getFilterData($list_id, $postdata, $filter_arrays = []){
        if (($postdata['GRID_ID'] == $list_id) && ($postdata['FILTER_ID'] == $list_id) && ($postdata['action'] == "setFilters")) {
            if (isset($postdata['FIND']) && $postdata['FIND']) $filter_arrays[] =
                [
                    "LOGIC" => "OR",
                    '%UF_TITLE' => $postdata['FIND'],
                    '%UF_DESCRIPTION' => $postdata['FIND'],
                    '%USR.LAST_NAME' => $postdata['FIND'],
                    '%USR.NAME' => $postdata['FIND'],
                    '%USR.SECOND_NAME' => $postdata['FIND'],
                ];
            if (isset($postdata['DATE_FROM']) && $postdata['DATE_FROM']) $filter_arrays[] =
                [
                    "LOGIC" => "OR",
                    [
                        "LOGIC" => "AND",
                        ">=UF_DATE_CREATED" => date('d.m.Y', strtotime($postdata['DATE_FROM'])),
                        "!UF_DATE_CREATED" => NULL,
                    ],
                    [
                        "LOGIC" => "AND",
                        ">=UF_DATE_EXECUTION" => date('d.m.Y', strtotime($postdata['DATE_FROM'])),
                        "!UF_DATE_EXECUTION" => NULL,
                    ]
                ];
            if (isset($postdata['DATE_TO']) && $postdata['DATE_TO']) $filter_arrays[] =
                [
                    "LOGIC" => "OR",
                    "<=UF_DATE_CREATED" => date('d.m.Y', strtotime($postdata['DATE_TO'])),
                    "<=UF_DATE_EXECUTION" => date('d.m.Y', strtotime($postdata['DATE_TO'])),
                ];
            if (isset($postdata['STATUS']) && $postdata['STATUS']) $filter_arrays[] =
                [
                    '=UF_STATUS' => $postdata['STATUS'],
                ];
            return $filter_arrays;
        }
    }
}
