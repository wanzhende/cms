<?php

function node_merge($node, $pid = 0)
{
    $arr = [];
    foreach($node as $v) {
        if($v['pid'] == $pid) {
            $v['child'] = node_merge($node, $v['id']);
            $arr[] = $v;
        }
    }
    return $arr;
}

function table($name = '')
{
    return '__'.strtoupper($name).'__';
}