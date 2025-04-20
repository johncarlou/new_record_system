<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    include_once('grade_controller.php');

    $id = $_GET['ID'];

    $grade_byID = get_grade_byID($con);    
    $update_func = update_grade($con, $id);


?>

<?php include('../views/header.php'); ?>
<div class="container-fluid mt-5">
    <?php include('../views/burger_button.php'); ?>
    <div class="row justify-content-center">
        <?php include('../views/navbar.php'); ?>
        <div class="col-12 col-md-9 col-lg-8 p-3">
            <table class="table table-bordered table-striped text-white">
                <thead>
                    <tr>
                        <th>Grade Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $grade_byID['gradename']; ?></td>
                        <td><button class="btn btn-primary my-1" data-toggle="modal" data-target="#exampleModal">Update</button></td>
                    </tr>
                </tbody>
            </table>

            <form action="<?php echo $update_func;?>" method="POST">
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="grade_name">Update to?</label>
                            <input type="text" name="gradename" class="form-control" value="<?php echo $grade_byID['gradename']?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" name="update_details" value="Update">
                    </div>
                    </div>
                </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?php include('../views/footer.php'); ?>