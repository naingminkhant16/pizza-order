<?php
function dd($str)
{
    echo "<pre>";
    die(var_dump($str));
}
function isEmpty($formData)
{
    //check inputs are empty or not
    $err = null;
    foreach ($formData as $key => $value) {
        empty(trim($value)) ? $err .= $key . "," : "";
    }
    if (empty($err)) {
        return false;
    } else {
        return $err;
    }
}
