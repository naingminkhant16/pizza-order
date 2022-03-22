<?php require "header.php" ?>
<?php
if ($_POST) {

    //check inputs are empty or not
    (!isEmpty($_POST)) ? $db = new DB() : $err = isEmpty($_POST);
    if (isset($db) && empty($err)) {
        //check image file error
        if ($_FILES['img']["error"] == 4) {
            $imgErr = "Image is required";
        } else {
            //backend validation success but check img type
            $file = "../images/" . $_FILES['img']['name'];
            $imageType = pathinfo($file, PATHINFO_EXTENSION);

            if ($imageType != 'jpg' && $imageType != 'jpeg' && $imageType != 'png') {
                echo "<script>alert('Invlaid image type');window.location.href='product-add.view.php'</script>";
                die();
            }
            //img type check success and start do query
            $query = "INSERT INTO products(name,description,category_id,quantity,price,image) VALUES (:name,:description,:category_id,:quantity,:price,:image)";
            $data = [
                ":name" => $_POST['name'],
                ":description" => $_POST["description"],
                ":category_id" => $_POST['category'],
                ":quantity" => $_POST['quantity'],
                ":price" => $_POST['price'],
                ":image" => $_FILES['img']['name']
            ];
            $result = $db->make($query, $data, "query");
            move_uploaded_file($_FILES['img']['tmp_name'], $file);
            if ($result) {
                echo "<script>alert('Successfully Created Product.');window.location.href='index.php'</script>";
            } else {
                echo "<script>alert('Failed to create product!');window.location.href='product-add.php'</script>";
            }
        }
    } elseif (isset($err)) {
        echo "<script>console.log('error')</script>";
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
?>
<div class="container bg-white" style="max-width:800px;padding:40px;border-radius:10px;">
    <h2 class="text-center" style="font-weight: bold;">Create Product</h2><br>
    <form action="product-add.php" method="post" style="max-width:480px;" class="container" enctype="multipart/form-data">
        <div class="md-5">
            <label class="form-label">Name:</label>
            <p style="color:red"><?= isset($uiErr['name']) ? '*' . $uiErr['name'] : '' ?></p>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="mt-3">
            <label type="text" class="form-label">Description</label>
            <p style="color:red"><?= isset($uiErr["description"]) ? '*' . $uiErr["description"] : '' ?></p>
            <textarea name="description" class="form-control" rows="5"></textarea>
        </div>
        <div class="mt-3">
            <label class="form-label">Price:</label>
            <p style="color:red"><?= isset($uiErr['price']) ? '*' . $uiErr['price'] : '' ?></p>
            <input type="number" name="price" class="form-control">
        </div>
        <div class="mt-3">
            <label class="form-label">Quantity:</label>
            <p style="color:red"><?= isset($uiErr['quantity']) ? '*' . $uiErr['quantity'] : '' ?></p>
            <input type="number" name="quantity" class="form-control">
        </div>
        <div class="mt-3">
            <label class="form-label">Category:</label>
            <p style="color:red"><?= isset($uiErr['category']) ? '*' . $uiErr['category'] : '' ?></p>
            <select name="category" class="form-select">
                <option value="" selected>Select Category</option>
                <?php
                $cat = new DB();
                $cat_items = $cat->make("SELECT * FROM category", null, "getAll");
                foreach ($cat_items as $cat_item) :
                ?>
                    <option value="<?= $cat_item->id ?>"><?= $cat_item->name ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="mt-3">
            <label class="form-label">Image</label>
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

<?php require "footer.php" ?>