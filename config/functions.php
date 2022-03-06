<?php
function dd($str)
{
    echo "<pre>";
    return die(var_dump($str));
}
function isEmpty($formData)
{
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
