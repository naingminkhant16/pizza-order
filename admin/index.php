<?php require "header.php" ?>
<?php
$db = new DB();
$result=$db->make("SELECT * FROM products", null, "getAll");
// dd($reult);
?>

<?php foreach($result as $item): ?>
<div class="card">
    <div class="card-header">
        <?=$item->name?>
    </div>
    <div class="card-body">
        <h5 class="card-title">Title</h5>
        <img src="../images/<?=$item->image?>" class="card-img-top">
        <p class="card-text"><?=$item->description?></p>
        <a href="product-add.view.php" class="btn btn-primary">Create Product</a>
    </div>   
</div>
<?php endforeach;?>

<?php require "footer.php" ?>