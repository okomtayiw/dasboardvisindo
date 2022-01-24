<?php 
if(!function_exists('getCurrentDate'))
{
    function getCurrentDate($format = 'd-m-Y', $originalDate)
    {
        return date($format, strtotime($originalDate));
    }
}
?>