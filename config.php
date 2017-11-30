<?php

error_reporting(0);


$Prfx = "<br/><strong>[ PHPEasy ] </strong> :: &nbsp;&nbsp;&nbsp;&nbsp;";

class Connection
{
	public $Host = "";
	public $User = "";
	public $Password = "";
	public $DB = "";
}

function DBTestConnect(Connection $C)
{

	global $Prfx;

	$Conn = new mysqli($C->Host, $C->User, $C->Password, $C->DB);

	if(!$Conn->connect_errno)
	{
		
		echo $Prfx . "Successful Connect to <b>" . $C->Host . "</b> and DB <b>" . $C->DB . "</b>";		
	}
	else
	{
		echo $Prfx . "<font color=red>Error</font>&nbsp;&nbsp;&nbsp;&nbsp; :- &nbsp;&nbsp;" . mysqli_connect_error();
	}	
}

function DBFetchTables(Connection $C)
{

}

?>