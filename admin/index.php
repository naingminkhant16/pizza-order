<?php
session_start();
if (empty($_SESSION['user']) || $_SESSION['user']['user_role'] != 1) {
    header("location: _actions/login.php");
}
?>
<?php require "header.php" ?>

<div class="card my-5">
    <div class="card-header">
        Login as <?= $_SESSION['user']['user_name'] ?>
    </div>
    <div class="card-body">
        <h5 class="card-title">Title</h5>
        <p class="card-text">Content</p>
    </div>
</div>

<?php require "footer.php" ?>