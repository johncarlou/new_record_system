<?php 
<<<<<<< HEAD
    if(!isset($_SESSION)){
        session_start();
    }
    
=======
>>>>>>> c061a3bd2b0bfcf5c2403d15dc9cac373693f181
    include_once('section_controller.php');

    $id = $_GET['ID'];

    $section_byID = get_section_byID($con);    
    $update_func = update_section($con, $id);


?>

<?php include('../views/header.php'); ?>
<<<<<<< HEAD

<div class="container-fluid mt-5">
    <?php include('../views/burger_button.php'); ?>
    <div class="row justify-content-center">
=======
<div class="d-md-none bg-light px-2 py-2">
    <button class="btn btn-outline-dark" type="button" data-toggle="collapse" data-target="#sidebarMenu">
        ☰ Menu
    </button>
</div>
<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        
>>>>>>> c061a3bd2b0bfcf5c2403d15dc9cac373693f181
        <?php include('../views/navbar.php'); ?>
        <div class="col-12 col-md-9 col-lg-8 p-3">
            <table class="table table-bordered table-striped text-white">
                <thead>
                    <tr>
                        <th>Section Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $section_byID['section_name']; ?></td>
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
                            <label for="section_name">Update to?</label>
                            <input type="text" name="section_name" class="form-control" value="<?php echo $section_byID['section_name']?>">
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