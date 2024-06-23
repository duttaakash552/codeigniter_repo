<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('greet_user'))
{
    function greet_user($name)
    {
        return "Hello, " . $name . "!";
    }
}
?>
