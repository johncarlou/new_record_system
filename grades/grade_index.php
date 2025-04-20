<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    include_once('grade_controller.php');
    $all_grade = get_all_grade($con, $errorMessage);
    $add_func = add_grade($con);
    $delete_func = delete_grade($con);
?>

<?php include('../views/header.php'); ?>
<div class="container-fluid mt-5">
    <?php include('../views/burger_button.php'); ?>
    <div class="row justify-content-center">
        <?php include('../views/navbar.php'); ?>
        <div class="col-12 col-md-9 col-lg-8 p-3">
            <h1>All Grade Level</h1>
            <button class="btn btn-primary my-1" data-toggle="modal" data-target="#exampleModal">Add</button>
            <table class="table table-bordered table-striped text-white">
            <?php if (!empty($all_grade)) { ?>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Grade Name</th>
                        <th>Added date</th>
                        <th><div class="d-flex justify-content-center">Action</div></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($all_grade as $row): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['gradename']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td style="width: 160px; white-space: nowrap;">
                                <div class="d-flex justify-content-center" style=" gap: 5px;">
                                    <a href="grade_details.php?ID=<?php echo $row['id']?>" class="btn btn-primary btn-sm">View</a>
                                    <form action="<?php echo $delete_func;?>" method="post" style="margin: 0;">
                                        <input type="hidden" name="ID" value="<?php echo $row['id'];?>">
                                        <button type="submit" name="deleting_grade" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <?php } else { ?>
                    <div>
                        <p class="text-center text-danger"><?php echo $errorMessage; ?></p>
                    </div>
                <?php } ?>
            </table>
            <form action="<?php echo $add_func;?>" method="POST">
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
                            <label for="gradename">What grade level?</label>
                            <input type="text" name="gradename" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" name="adding_grade" value="ADD">
                    </div>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('../views/footer.php'); ?>
