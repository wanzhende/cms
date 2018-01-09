<?php

function node_merge($node, $pid = 0, $access = null)
{
    $arr = [];
    foreach($node as $v) {
        if(is_array($access)) {
            $v['access'] = in_array($v['id'], $access) ? 1 : 0;
        }
        if($v['pid'] == $pid) {
            $v['child'] = node_merge($node, $v['id'], $access);
            $arr[] = $v;
        }
    }
    return $arr;
}

function table($name = '')
{
    return '__'.strtoupper($name).'__';
}