<?php require_once "header.php" ?>
<?php
$id = $_GET['id'];

if ($_POST) {

    //check inputs are empty or not
    (!isEmpty($_POST)) ? $edit = new DB() : $err = isEmpty($_POST);
    if (isset($edit) && empty($err)) {
        //check image file error
        if ($_FILES['img']["error"] == 4) {
            $query = "UPDATE products SET name=:name,description=:description,category_id=:category_id,quantity=:quantity,price=:price WHERE id=:id";
            $data = [
                ":name" => $_POST['name'],
                ":description" => $_POST["description"],
                ":category_id" => $_POST['category'],
                ":quantity" => $_POST['quantity'],
                ":price" => $_POST['price'],
                ":id" => $id
            ];
            $result = $edit->make($query, $data, "query");
            if ($result) {
                echo "<script>alert('Successfully Edited Product.');window.location.href='index.php'</script>";
            } else {
                echo "<script>alert('Failed to edit product!');window.location.href='product-edit.view.php'</script>";
            }
        } else {
            //backend validation success but check img type
            $file = "../images/" . $_FILES['img']['name'];
            $imageType = pathinfo($file, PATHINFO_EXTENSION);

            if ($imageType != 'jpg' && $imageType != 'jpeg' && $imageType != 'png') {
                echo "<script>alert('Invlaid image type');window.location.href='product-edit.view.php'</script>";
                die();
            }
            //img type check success and start do query ~~~ name=$_POST['name']
            $query = "UPDATE products SET name=:name,description=:description,category_id=:category_id,quantity=:quantity,price=:price,image=:image WHERE id=:id";
            $data = [
                ":name" => $_POST['name'],
                ":description" => $_POST["description"],
                ":category_id" => $_POST['category'],
                ":quantity" => $_POST['quantity'],
                ":price" => $_POST['price'],
                ":image" => $_FILES['img']['name'],
                ":id" => $id
            ];
            $result = $edit->make($query, $data, "query");
            move_uploaded_file($_FILES['img']['tmp_name'], $file);
            if ($result) {
                echo "<script>alert('Successfully edited Product.');window.location.href='index.php'</script>";
            } else {
                echo "<script>alert('Failed to edit product!');window.location.href='product-edit.view.php'</script>";
            }
        }
    } elseif (isset($err)) {
        $findErrArr = ['name', "description", 'price', 'quantity', 'category'];
        $err = explode(',', $err);
        $uiErr = [];
        foreach ($findErrArr as $findErr) {
            if (in_array($findErr, $err)) {
                $uiErr[$findErr] = $findErr . " is required!";
            }
        }
    }
}


$db = new DB();
$query = "SELECT * FROM products WHERE id=:id";
$data = [":id" => $id];
$product = $db->make($query, $data, "get");

?>
<div class="container bg-white" style="max-width:800px;padding:40px;border-radius:10px;">
    <h2 class="text-center" style="font-weight: bold;">Edit Product</h2><br>
    <form action="" method="post" style="max-width:480px;" class="container" enctype="multipart/form-data">
        <div class="md-5">
            <label class="form-label">Name:</label>
            <p style="color:red"><?= isset($uiErr['name']) ? '*' . $uiErr['name'] : '' ?></p>
            <input type="text" name="name" class="form-control" value="<?= $product->name ?>">
        </div>
        <div class="mt-3">
            <label type="text" class="form-label">Description</label>
            <p style="color:red"><?= isset($uiErr["description"]) ? '*' . $uiErr["description"] : '' ?></p>
            <textarea name="description" class="form-control" rows="5"><?= $product->description ?></textarea>
        </div>
        <div class="mt-3">
            <label class="form-label">Price:$</label>
            <p style="color:red"><?= isset($uiErr['price']) ? '*' . $uiErr['price'] : '' ?></p>
            <input type="number" name="price" class="form-control" value="<?= $product->price ?>">
        </div>
        <div class="mt-3">
            <label class="form-label">Quantity:</label>
            <p style="color:red"><?= isset($uiErr['quantity']) ? '*' . $uiErr['quantity'] : '' ?></p>
            <input type="number" name="quantity" class="form-control" value="<?= $product->quantity ?>">
        </div>
        <div class="mt-3">
            <label class="form-label">Category:</label>
            <p style="color:red"><?= isset($uiErr['category']) ? '*' . $uiErr['category'] : '' ?></p>
            <select name="category" class="form-control">
                <option value="">Select Category</option>
                <?php
                ?>
                <option value="1">Some</option>
                <?php ?>
            </select>
        </div>
        <div class="mt-3">
            <label class="form-label">Image</label><br>
            <img src="../images/<?= $product->image ?>" width="300" class="img-fluid">
            <p style="color:red"><?= isset($imgErr) ? '*' . $imgErr : '' ?></p>
            <input type="file" name="img" class="form-control">
        </div>
        <div class="mt-3 d-flex">
            <button type="reset" class="btn btn-default mx-2">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form><br>
    <a href="index.php" class="text-dark"><i class='bx bx-arrow-back'></i>Back</a>
</div>


<?php require_once "footer.php" ?>