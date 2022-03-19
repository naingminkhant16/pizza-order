<?php require "header.php" ?>
<?php
$db = new DB();
$result = $db->make("SELECT * FROM products", null, "getAll");
// dd($reult);
?>


<div class="container">
    <a href="product-add.view.php" class="btn btn-primary mb-3">Create Product</a>
    <div class="row">
        <?php foreach ($result as $item) : ?>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <?= $item->name ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Title</h5>
                        <img src="../images/<?= $item->image ?>" class="card-img-top">
                        <p class="card-text"><?= $item->description ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require "footer.php" ?>