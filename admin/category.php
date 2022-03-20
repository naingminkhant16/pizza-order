<?php require "header.php" ?>
<div class="container">
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
                                <th scope="col">name</th>
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
                                    <td><?= $cat->updated_at ?></td>
                                    <td>
                                        <a href="" class="btn btn-outline-success">Edit</a>
                                        <a href="" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
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