<?php
require '_packer.php';

$Co = Connect($Conn, true);

print_r(Get($Co, "testable", array("name", "password"), array("`id` = 1"), 'Ec', 'Ez'));

function Ec($S)
{
    echo $S;
}

?>