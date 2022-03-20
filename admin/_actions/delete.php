<?php
require "../../config/DB.php";
if (!empty($_GET)) {
    $id = $_GET['id'];
    $db = new DB();
    $deleteSuccess = $db->make("DELETE FROM products WHERE id=$id", null, "query");
    if ($deleteSuccess) {
        header("Location: ../index.php");
    }
} else {
    header("location: ../index.php");
}
