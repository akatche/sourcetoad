<?php

require ('UserData.php');

function sortDataStructure(&$data, $keys): void
{
    usort($data, function ($a, $b) use ($keys) {
        foreach ($keys as $key) {
            $valueA = getValueByKey($a, $key);
            $valueB = getValueByKey($b, $key);

            if ($valueA < $valueB) {
                return -1;
            } elseif ($valueA > $valueB) {
                return 1;
            }
        }

        return 0;
    });

    foreach ($data as &$item) {
        foreach ($item as $key => &$value) {
            if (is_array($value)) {
                sortDataStructure($value, $keys);
            }
        }
    }
}

function getValueByKey($data, $key) {
    $keys = explode('.', $key);

    foreach ($keys as $key) {
        if (!isset($data[$key])) {
            return null;
        }

        $data = $data[$key];
    }

    return $data;
}

$data = UserData::getUserData();
$keysToSortBy = ['last_name','account_id'];
sortDataStructure($data, $keysToSortBy);

print_r($data);

