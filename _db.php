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

function Close($C, $L, $CompCallback = null, $CompParam = null, $FailCallback = null, $FailParam = null)
{    
    
    if(!isset($C))
    {
       file_put_contents("log.txt", file_get_contents("log.txt") . '\n[' . Date() . '] >> Host Not Set For ' . $C . ';'); 
       exit();
    }

    if(mysql_close($C))
    {
        call_user_func($CompCallback, $CompParam);
    }
    else
    {
        call_user_func($FailCallback, $FailParam);
    }
}



function Ins($Conn, $Table, $Columns = array(), $Data = array(), $CompCallback = null, $CompParam = "", $FailCallback = null, $FailParam = null, $VerboseSQL = false)
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
        if(empty($D))
        {
            $SQL = $SQL . "'',";
        }
        else
        {
            $SQL = $SQL . "'$D',";
        }

        
    }
    $SQL = substr($SQL, 0, -1);

    $SQL = $SQL . ")";


    if($VerboseSQL)
    {
        echo $SQL;
    }

    if($Conn->query($SQL) === true)
    {
        if($CompCallback != null)
        {
            call_user_func($CompCallback, $CompParam);
        }   
    }
    else
    {
        if($FailCallback != null)
        {
            call_user_func($FailCallback, $FailParam);
        }
    }

    

}

function Get($Conn, $Table, $Columns = array(), $Where = array(), $CompCallback = null, $CompParam = null, $FailCallback = null, $FailParam = null, $Verbose = false)
{
    $SQL = "SELECT ";

    foreach($Columns as $C)
    {
        if($C == "*")
        {
            $SQL = $SQL . "*";
        } else if($C != end($Columns))
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
                $SQL = $SQL . "$W AND ";
            }
            else
            {
                $SQL = $SQL . "$W";
            }
                
        }
    }

    $SQL = $SQL . "";

    if($Verbose)
    {
        echo $SQL;
    }

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

    

}


function Upd($Conn, $Table, $Columns = array(), $Data = array(), $Where = array(), $CompCallback = null, $CompParam = null, $FailCallback = null, $FailParam = null)
{
    $SQL = "UPDATE `$Table` SET ";

    for ($i = 0; $i <= count($Columns) - 1; $i++) {
        
        if($i != count($Columns) - 1)
        {
            $SQL = $SQL . "`$Columns[$i]`" . " = '$Data[$i]',";
        }
        else
        {
            $SQL = $SQL . "`$Columns[$i]`" . " = '$Data[$i]'";
        }

        

    }

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

    if($Conn->query($SQL) === true)
    {
        if($CompCallback != null)
        {
            call_user_func($CompCallback, $CompParam);
        }        
    }
    else
    {
        if($FailCallback != null)
        {
            call_user_func($FailCallback, $FailParam);
        }  
    }

    

}


function Del($Conn, $Table, $Where = array(), $CompCallback = null, $CompParam = null, $FailCallback = null, $FailParam = null)
{
    $SQL = "DELETE FROM `$Table` ";

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

    if($Conn->query($SQL) === true)
    {
        if($CompCallback != null)
        {
            call_user_func($CompCallback, $CompParam);
        }        
    }
    else
    {
        if($FailCallback != null)
        {
            call_user_func($FailCallback, $FailParam);
        }  
    }

    

}




?>