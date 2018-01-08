<?php
require '_packer.php';

$Co = Connect($Conn, true);

Del($Co, "testable", array("`id` = 2"), 'Ec');

function Ec()
{
    echo "Done!";
}

?>