<?php
require '_packer.php';

$Co = Connect($Conn, true);

Del($Co, "testabsle", array("`name` = 'Daryn'"), 'Comp', 'Done Deleting Entries!', 'Fail', 'Unable to complete Task');

function Comp($var)
{
    echo $var;
}

function Fail($var)
{
    echo $var;
}

?>