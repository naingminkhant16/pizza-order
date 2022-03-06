<?php require "header.php" ?>

<div class="card">
    <div class="card-header">
        Login as <?= $_SESSION['user']['user_name'] ?> Products
    </div>
    <div class="card-body">
        <h5 class="card-title">Title</h5>
        <p class="card-text">Content</p>
        <a href="product-add.view.php" class="btn btn-primary">Create Product</a>
    </div>
</div>

<?php require "footer.php" ?>