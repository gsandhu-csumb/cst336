<?php
function isRequestOf($type){
    return $_SERVER['REQUEST_METHOD'] === $type;
}

function hasAllParams($arr, $params){
    foreach($params as $param){
        if(!isset($arr[$param]))
            return false;
    }
    return true;
}