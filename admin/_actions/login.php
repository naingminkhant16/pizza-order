<?php
require "../../config/DB.php";
session_start();
$db = new DB();
$query = "SELECT * FROM customers WHERE email=:email";
$data = [
    ":email" => $_POST['email']
];
$result = $db->make($query, $data, "get");

if ($result) {
    if ($result->password == $_POST['password'] && $result->role == 1) {
        $_SESSION['user']['user_name'] = $result->name;
        $_SESSION['user']['user_role'] = $result->role;
        header("location: ../index.php");
    } else {
        header("location: ../login.view.php?error=2");
    }
} else {
    header("location: ../login.view.php?error=1");
}

echo "<pre>";
print_r($result);
