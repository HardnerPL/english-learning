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
    return $_SESSION[$name];
}

function sessionSet($name, $value)
{
    $_SESSION[$name] = $value;
}

function sessionUnset($name)
{
    unset($_SESSION[$name]);
}


