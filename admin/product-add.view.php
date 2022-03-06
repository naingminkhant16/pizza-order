<?php require "header.php" ?>
<?php
if ($_POST) {
    require "../config/DB.php";
    (!isEmpty($_POST)) ? $db = new DB() : $err = isEmpty($_POST);

    if (isset($db)) {
        if ($_FILES['img']["error"] == 4) {
            dd($_FILES['img']);
            $imgErr = "Image is required";
        } else {
            $file = "../images/" . $_FILES['img']['name'];
            $imageType = pathinfo($file, PATHINFO_EXTENSION);

            if ($imageType != 'jpg' && $imageType != 'jpeg' && $imageType != 'png') {
                echo "<script>alert('Invlaid image type');window.location.href='product-add.view.php'</script>";
                die();
            }
            $query = "INSERT INTO products(name,description,category_id,quantity,price,image) VALUES (:name,:description,:category_id,:quantity,:price,:image)";
            $data = [
                ":name" => $_POST['name'],
                ":description" => $_POST['desc'],
                ":category_id" => $_POST['category'],
                ":quantity" => $_POST['qty'],
                ":price" => $_POST['price'],
                ":image" => $_FILES['img']['name']
            ];
            $result = $db->make($query, $data, "insert");
            move_uploaded_file($_FILES['img']['tmp_name'], $file);
            if ($result) {
                echo "<script>alert('Successfully Created Product.');window.location.href='index.php'</script>";
            }
        }
    } elseif (isset($err)) {
        dd($err);
    }
}
?>
<div class="container bg-white" style="max-width:800px;padding:40px;border-radius:10px;">
    <h2 class="text-center" style="font-weight: bold;">Create Product</h2><br>
    <form action="" method="POST" style="max-width:480px;" class="container" enctype="multipart/form-data">
        <div class="md-5">
            <label class="form-label">Name:</label>
            <p style="color:red"><?= isset($nameError) ? '*' . $descError : '' ?></p>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="mt-3">
            <label type="text" class="form-label">Description</label>
            <p style="color:red"><?= isset($descError) ? '*' . $descError : '' ?></p>
            <textarea name="desc" class="form-control" rows="5"></textarea>
        </div>
        <div class="mt-3">
            <label class="form-label">Price:</label>
            <input type="number" name="price" class="form-control">
        </div>
        <div class="mt-3">
            <label class="form-label">Quantity:</label>
            <input type="number" name="qty" class="form-control">
        </div>
        <div class="mt-3">
            <label class="form-label">Category:</label>
            <p style="color:red"><?= isset($catError) ? '*' . $catError : '' ?></p>
            <select name="category" class="form-control">
                <option value="">Select Category</option>
                <?php
                ?>
                <option value="1">Some</option>
                <?php ?>
            </select>
        </div>
        <div class="mt-3">
            <label class="form-label">Image</label>
            <input type="file" name="img" class="form-control">
        </div>
        <div class="mt-3 d-flex">
            <button type="reset" class="btn btn-default mx-2">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form><br>
    <a href="index.php" class="text-dark"><i class='bx bx-arrow-back'></i>Back</a>
</div>

<?php require "footer.php" ?>