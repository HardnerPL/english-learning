<?php

function sessionStart() 
{
    session_start();
}

function sessionDestroy() 
{
    session_destroy();
}

function sessionGet($name) 
{
    if (isset($_SESSION[$name])) {
        return $_SESSION[$name];
    } else return NULL;
}

function sessionSet($name, $value)
{
    $_SESSION[$name] = $value;
}

function sessionUnset($name)
{
    unset($_SESSION[$name]);
}


