<?php
//配置文件
return [
    'dispatch_success_tmpl'  => $_SERVER['DOCUMENT_ROOT'].'/static/redirect/dispatch_jump.tpl',
    'dispatch_error_tmpl'    => $_SERVER['DOCUMENT_ROOT'].'/static/redirect/dispatch_jump.tpl',
    
    'view_replace_str' => [
        '__ADMIN__' => '/admin',
        '__STATIC__' => '/static',
    ],    
];