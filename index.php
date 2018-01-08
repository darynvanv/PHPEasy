<?php
require '_packer.php';

$Co = Connect($Conn, true);

echo read('log.txt', true);

function Comp($var)
{
    echo $var;
}

function Fail($var)
{
    echo $var;
}

?>