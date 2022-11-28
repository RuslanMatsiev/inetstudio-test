<?php

    // Многомерный массив, элементы которого могут содержать одинаковые id
    $arr = [
        ['id' => 1, 'date' => '12.01.2020', 'name' => 'test1'],
        ['id' => 2, 'date' => '02.05.2020', 'name' => 'test2'],
        ['id' => 4, 'date' => '08.03.2020', 'name' => 'test4'],
        ['id' => 1, 'date' => '22.01.2020', 'name' => 'test1'],
        ['id' => 2, 'date' => '11.11.2020', 'name' => 'test4'],
        ['id' => 3, 'date' => '06.06.2020', 'name' => 'test3'],
    ];

    // Задача N1 - Выделить уникальные записи (убрать дубли) в отдельный массив. в конечном массиве не должно быть элементов с одинаковым id.
    function arrUniqueById($arr)
    {
        $ids = [];

        $arrUnique = array_filter($arr, function($item) use (&$ids) {
            if (in_array($item['id'], $ids)) {
                return false;
            }

            $ids[] = $item['id'];
            return true;
        });

        return $arrUnique;
    }

    arrUniqueById($arr);


    // Задача N2 - Отсортировать многомерный массив по ключу (любому)
    function arrSortByKey($arr, $key = 'name')
    {
        usort($arr, function($a, $b) use ($key) {
            return $a[$key] <=> $b[$key];
        });

        return $arr;
    }

    arrSortByKey($arr);


    // Задача N3 - Вернуть из массива только элементы, удовлетворяющие внешним условиям (например элементы с определенным id)
    function arrFilter($arr, $key = 'id', $val = '1')
    {
        $arrFilter = array_filter($arr, function($item) use ($key, $val) {
            if ($item[$key] == $val) {
                return true;
            }

            return false;
        });

        return $arrFilter;
    }

    arrFilter($arr);


    // Задача N4 - Изменить в массиве значения и ключи (использовать name => id в качестве пары ключ => значение)
    function arrCombine($arr, $column = 'id', $index = 'name')
    {
        return array_column($arr, $column, $index);
    }

    arrCombine($arr);


    // Задача N5 - В базе данных имеется таблица с товарами goods (id INTEGER, name TEXT), таблица с тегами tags (id INTEGER, name TEXT)
    // и таблица связи товаров и тегов goods_tags (tag_id INTEGER, goods_id INTEGER, UNIQUE(tag_id, goods_id)).
    // Выведите id и названия всех товаров, которые имеют все возможные теги в этой базе.

    $query = 'SELECT id, name 
              FROM goods 
              LEFT JOIN goods_tags ON (id = goods_id) 
              GROUP BY id 
              HAVING COUNT(goods_id) = (SELECT COUNT(id) COUNT tags)';

    // Задача N6 - Выбрать без join-ов и подзапросов все департаменты, в которых есть мужчины, и все они (каждый) поставили высокую оценку (строго выше 5).
    // create table evaluations
    // (
    //    respondent_id uuid primary key, -- ID респондента
    //    department_id uuid,             -- ID департамента
    //    gender        boolean,          -- true — мужчина, false — женщина
    //    value         integer	    -- Оценка
    // );

    $query = 'SELECT DISTINCT department_id 
              FROM evaluations 
              WHERE gender = true AND value > 5';