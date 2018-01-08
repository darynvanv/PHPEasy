<?php

function read($File, $ConvertLines = false, $Encoding = 'UTF-8', $CompCallback = null, $CompParams = null, $FailCallback = null, $FailParams = null)
{
    if(file_exists($File))
    {
        if($CompCallback != null)
        {
            call_user_func($CompCallback, $CompParams);
        }

        if($ConvertLines)
        {
            $F = file_get_contents($File);
            $F = htmlentities($F, ENT_QUOTES, $Encoding);
            return nl2br($F);
        }
        else
        {
            return file_get_contents($File);
        }
        
    }
    else
    {
        if($FailCallback != null)
        {
            call_user_func($FailCallback, $FailParams);
        }
    }
}
    

?>