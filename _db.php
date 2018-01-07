<?php

function Connect($C, $L)
{    
    
    if(!isset($C->Host))
    {
       file_put_contents("log.txt", file_get_contents("log.txt") . '\n[' . Date() . '] >> Host Not Set For ' . $C . ';'); 
       exit();
    }

    if(!isset($C->User))
    {
       file_put_contents("log.txt", file_get_contents("log.txt") . '\n[' . Date() . '] >> User Not Set For ' . $C . ';'); 
       exit();
    }

    if(!isset($C->Pass))
    {
       file_put_contents("log.txt", file_get_contents("log.txt") . '\n[' . Date() . '] >> Pass Not Set For ' . $C . ';'); 
       exit();
    }

    if(!isset($C->DB))
    {
       file_put_contents("log.txt", file_get_contents("log.txt") . '\n[' . Date() . '] >> Database Not Set For ' . $C . ';'); 
       exit();
    }

    $Conn = new mysqli($C->Host, $C->User, $C->Pass, $C->DB);
    
    return $Conn;

    if($L)
    {
        // Check connection
        if ($Conn->connect_error) {
            die($ErrorPrefix . $Conn->connect_error);
        } 
    }
}



function Ins($Conn, $Table, $Columns = array(), $Data = array(), $Callback = null)
{
    $SQL = "INSERT INTO `$Table` (";

    foreach($Columns as $C)
    {
        if($C != end($Columns))
        {
            $SQL = $SQL . "`$C`,";
        }
        else
        {
            $SQL = $SQL . "`$C`";
        }
            
    }

    $SQL = $SQL . ") VALUES (";

    foreach($Data as $D)
    {
        if($D != end($Data))
        {
            $SQL = $SQL . "'$D',";
        }
        else
        {
            $SQL = $SQL . "'$D'";
        }
            
    }

    $SQL = $SQL . ")";

    if($Conn->query($SQL) === true)
    {
        if($Callback != null)
        {
            call_user_func($Callback);
        }        
    }

    echo $SQL;

}

function Get($Conn, $Table, $Columns = array(), $Where = array(), $CompCallback = null, $CompParam = null, $FailCallback = null, $FailParam = null)
{
    $SQL = "SELECT ";

    foreach($Columns as $C)
    {
        if($C != end($Columns))
        {
            $SQL = $SQL . "`$C`,";
        }
        else
        {
            $SQL = $SQL . "`$C`";
        }
            
    }

    $SQL = $SQL . " FROM `$Table` ";

    if(count($Where) > 0)
    {
        $SQL = $SQL . "WHERE ";

        foreach($Where as $W)
        {
            if($W != end($Where))
            {
                $SQL = $SQL . "$W AND";
            }
            else
            {
                $SQL = $SQL . "$W";
            }
                
        }
    }

    $SQL = $SQL . "";
    $result = $Conn->query($SQL);
    if($result->num_rows > 0)
    {
        $Data = array();
        $data = array();
        while($row = $result->fetch_assoc())
        {
            $data = $row;
            array_push($Data, $data);
        }
        return $Data;

        if($CompCallback != null)
        {
            call_user_func($CompCallback, $CompParam);
        }  
    } else
    {
        if($FailCallback != null)
        {
            call_user_func($FailCallback, $FailParam);
        }  
    }

    echo $SQL;

}





?>