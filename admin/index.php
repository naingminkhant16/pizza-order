<?php require "header.php" ?>
<?php
$db = new DB();
$result = $db->make("SELECT * FROM products", null, "getAll");
// dd($reult);
?>


<div class="container">
    <a href="product-add.php" class="btn btn-outline-primary mb-3">Create Product</a>
    <div class="row g-2">
        <?php foreach ($result as $item) : ?>
            <div class="col-lg-3 mb-2">
                <div class="card">
                    <div class="card-body">
                        <img src="../images/<?= $item->image ?>" class="card-img-top mb-2">
                        <p class="badge bg-secondary p-2"><?php
                                                            $cat = new DB();
                                                            $cat_name = $cat->make("SELECT * FROM category WHERE id=:id", [':id' => $item->category_id], 'get');
                                                            echo $cat_name->name;
                                                            ?></p>
                        <h5 class="card-title fw-bold">
                            <?= $item->name ?>
                        </h5>
                        <p class="card-text"><?= $item->description ?></p>
                        <p class="card-text"><span style="font-weight: bold;">Item left</span> - <?= $item->quantity ?></p>
                        <p class="card-text"><span style="font-weight: bold;">Price</span> -$<?= $item->price ?></p>

                        <a href="product-edit.php?id=<?= $item->id ?>" class="btn btn-outline-success">Edit</a>
                        <a href="_actions/delete.php?id=<?= $item->id ?>&tableName=products" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require "footer.php" ?>