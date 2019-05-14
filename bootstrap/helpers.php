<?php

if (!function_exists('array2object')) {
    function array2object($x)
    {
        if (!is_array($x)) {
            return $x;
        } elseif (is_numeric(key($x))) {
            return array_map(__FUNCTION__, $x);
        } else {
            return (object)array_map(__FUNCTION__, $x);
        }
    }
}
