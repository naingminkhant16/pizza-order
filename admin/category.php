<?php require "header.php" ?>
<div class="container">
    <a href="category-add.php" class="btn btn-outline-primary mb-3">Create Category</a>
    <div class="row">
        <div class="col">
            <div class="card">
                <h5 class="card-header">
                    Categories
                </h5>
                <div class="card-body">


                    <table class="table table-primary table-striped">
                        <thead class="">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db = new DB();
                            $query = "SELECT * FROM category";
                            $cats = $db->make($query, null, 'getAll');
                            foreach ($cats as $cat) :
                            ?>
                                <tr>
                                    <th scope="row"><?= $cat->id ?></th>
                                    <td><?= $cat->name ?></td>
                                    <td><?= $cat->created_at ?></td>
                                    <td><?= $cat->updated_at ?></td>
                                    <td>
                                        <a href="category-edit.php?id=<?= $cat->id ?>" class="btn btn-outline-success">Edit</a>
                                        <a href="_actions/delete.php?id=<?= $cat->id ?>&tableName=category" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
<?php require "footer.php" ?>