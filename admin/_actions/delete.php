<?php
session_start();
require "../../config/DB.php";
if (empty($_SESSION['user']) || $_SESSION['user']['user_role'] != '1') {
    header("../login.view.php");
}
if (!empty($_GET)) {
    $id = $_GET['id'];
    $tableName = $_GET['tableName'];
    $db = new DB();
    $deleteSuccess = $db->make("DELETE FROM $tableName WHERE id=$id", null, "query");
    if ($deleteSuccess) {
        if ($_GET['tableName'] == "products") header("Location: ../index.php");
        if ($_GET['tableName'] == "category") header("Location: ../category.php");
        
    }
} else {
    header("location: ../login.view.php");
}
