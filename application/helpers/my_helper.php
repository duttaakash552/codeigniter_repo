<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('greet_user'))
{
    function greet_user($name)
    {
        return "Hello, " . $name . "!";
    }
}

if ( ! function_exists('sum'))
{
    function sum($a, $b)
    {
        $sum = $a+$b;
        return $sum;
    }
}
?>
