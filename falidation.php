<?php

if ((preg_match("/^[а-яА-ЯёЁa-zA-Z0-9_.]{1,255}$/", $login, $arr))&((preg_match("/^[а-яА-ЯёЁa-zA-Z0-9_.]{1,255}$/", $login, $arr))>0))
{
      $login = $arr[0];
    if ((preg_match("/^[^а-яА-ЯёЁ]{1,30}@[^а-яА-ЯёЁ]{1,19}$/", $email, $arr))&((preg_match("/^[^а-яА-ЯёЁ]+@[^а-яА-ЯёЁ]+$/", $email, $arr))>0))
    {
        $email = $arr[0];
        if ((preg_match("/[^\s]{1,512}/", $message, $arr5)) & ((preg_match("/[^\s]{1,512}/", $message, $arr5))>0))

        {
            if ((preg_match("/^(.|\s){1,512}$/", $message, $arr))& ((preg_match("/^(.|\s){1,512}$/", $message, $arr))>0))
            {
                $message = $arr[0];
                $error=4;
            }
            else
            {
                $error=3;
            }
        }
        else
        {
            $error=3;
        }
    }
    else
    {
        $error=2;
    }
}
else
{
    $error=1;
}

?>