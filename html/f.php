<?php
class ttt
{
    public function update()
    {
        echo 'Method [update] not is static'.'<br>';
    }
    public static function __call($method, $params)
    {
        echo 'Call the magic method :'.$method;
    }
    public static function __callStatic($method, $params)
    {
        echo 'The method ['.$method.'] is static'.'<br>';
    }
}
ttt::hehe();
ttt::update();
$a = new ttt();
$a->upate();