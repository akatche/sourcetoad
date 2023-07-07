<?php

require ('UserData.php');

function printNestedArrayValues($data, $depth = 0) {
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            echo str_repeat('  ', $depth) . "$key:\n";
            printNestedArrayValues($value, $depth + 1);
        } else {
            echo str_repeat('  ', $depth) . "$key: $value\n";
        }
    }
}

printNestedArrayValues(UserData::getUserData());
