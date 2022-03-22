<?php require "header.php" ?>
<?php
if ($_POST) {
    //check inputs are empty or not
    (!isEmpty($_POST)) ? $db = new DB() : $err = isEmpty($_POST);
    if (isset($db) && empty($err)) {
        $query = "INSERT INTO category(name,created_at) VALUES (:name,:created_at)";
        $data = [
            ":name" => $_POST['name'],
            ":created_at" => $_POST['created_at']
        ];
        $result = $db->make($query, $data, "query");

        if ($result) {
            echo "<script>alert('Successfully Created Category.');window.location.href='category.php'</script>";
        } else {
            echo "<script>alert('Failed to create category!');window.location.href='category-add.php'</script>";
        }
    } elseif (isset($err)) {
        $findErrArr = ['name', "created_at"];
        $err = explode(',', $err);
        $uiErr = [];
        foreach ($findErrArr as $findErr) {
            if (in_array($findErr, $err)) {
                $uiErr[$findErr] = $findErr . " is required!";
            }
        }
    }
}
?>
<div class="container bg-white" style="max-width:800px;padding:40px;border-radius:10px;">
    <h2 class="text-center" style="font-weight: bold;">Create Product</h2><br>
    <form action="" method="post" style="max-width:480px;" class="container" enctype="multipart/form-data">
        <div class="mb-2">
            <label class="form-label">Name:</label>
            <p style="color:red"><?= isset($uiErr['name']) ? '*' . $uiErr['name'] : '' ?></p>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="mb-2">
            <label class="form-label">Created At:</label>
            <p style="color:red"><?= isset($uiErr['created_at']) ? '*' . $uiErr['created_at'] : '' ?></p>
            <input type="date" name="created_at" class="form-control">
        </div>

        <div class="mt-3 d-flex">
            <button type="reset" class="btn btn-default mx-2">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form><br>
    <a href="category.php" class="text-dark"><i class='bx bx-arrow-back'></i>Back</a>
</div>

<?php require "footer.php" ?>