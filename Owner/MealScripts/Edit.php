<?php
    if(!isset($_GET['id'])){
        // redirect to show page
        die('id not provided');
    }
    require_once('../../dbCon.php');
    $id =  $_GET['id'];
    $sql = "SELECT * FROM `tbmenu` where ID = $id";
    $result = $con->query($sql);
    if($result->num_rows != 1){
        // redirect to show page
        die('id is not in db');
    }
    $data = $result->fetch_assoc();
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <div class="jumbotron">
        <h1 class="text-center">
            Edit Meal Details
        </h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-12">
                <form action="Modify.php?id=<?= $id ?>" method="POST">
                <h3>Edit Form</h3>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="pname" value="<?= $data['Name']?>">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="Desc" value="<?= $data['Description']?>">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" name="Price" value="<?= $data['Price']?>"></input>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" class="form-control" name="Category"  value="<?= $data['Category']?>" readonly></input>
                    <br><input type="submit" name="editForm" value="submit" class="btn btn-primary btn-block">
                </form>
            </div>
        </div>
    </div>
</body>
