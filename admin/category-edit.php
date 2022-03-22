<?php require "header.php" ?>
<?php
$id = $_GET['id'];
if ($_POST) {
    //check inputs are empty or not
    (!isEmpty($_POST)) ? $db = new DB() : $err = isEmpty($_POST);
    if (isset($db) && empty($err)) {
        $query = "UPDATE category SET name=:name,updated_at=:updated_at WHERE id=:id";
        $data = [
            ":name" => $_POST['name'],
            ":updated_at" => $_POST['updated_at'],
            ":id" => $id
        ];
        $result = $db->make($query, $data, "query");
        if ($result) {
            echo "<script>alert('Successfully Updated Category.');window.location.href='category.php'</script>";
        } else {
            echo "<script>alert('Failed to update category!');window.location.href='category.php'</script>";
        }
    } elseif (isset($err)) {
        $findErrArr = ['name', "updated_at"];
        $err = explode(',', $err);
        $uiErr = [];
        foreach ($findErrArr as $findErr) {
            if (in_array($findErr, $err)) {
                $uiErr[$findErr] = $findErr . " is required!";
            }
        }
    }
}
$cat = new DB();
$cat_item = $cat->make("SELECT * FROM category WHERE id=:id", [':id' => $id], "get");
// dd($cat_item);
?>
<div class="container bg-white" style="max-width:800px;padding:40px;border-radius:10px;">
    <h2 class="text-center" style="font-weight: bold;">Edit Category</h2><br>
    <form action="" method="post" style="max-width:480px;" class="container" enctype="multipart/form-data">
        <div class="mb-2">
            <label class="form-label">Name:</label>
            <p style="color:red"><?= isset($uiErr['name']) ? '*' . $uiErr['name'] : '' ?></p>
            <input type="text" name="name" class="form-control" value="<?= $cat_item->name ?>">
        </div>
        <div class="mb-2">
            <label class="form-label">Updated At:</label>
            <p style="color:red"><?= isset($uiErr['updated_at']) ? '*' . $uiErr['updated_at'] : '' ?></p>
            <input type="date" name="updated_at" class="form-control">
        </div>

        <div class="mt-3 d-flex">
            <button type="reset" class="btn btn-default mx-2">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form><br>
    <a href="category.php" class="text-dark"><i class='bx bx-arrow-back'></i>Back</a>
</div>

<?php require "footer.php" ?>