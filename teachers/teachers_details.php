<?php 
    include_once('teachers_controller.php');

    $id = $_GET['ID'];

    $teacher_byID = get_teacher_byID($con);    
    $update_func = update_teacher($con, $id);


?>

<?php include('../views/header.php'); ?>
<div class="d-md-none bg-light px-2 py-2">
    <button class="btn btn-outline-dark" type="button" data-toggle="collapse" data-target="#sidebarMenu">
        ☰ Menu
    </button>
</div>
<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <?php include('../views/navbar.php'); ?>
        <div class="col-12 col-md-9 col-lg-8 p-3">
            <h1>Teacher Details</h1>
            <div class="bg-dark">
                <div class="d-flex flex-nowrap">
                    <div class="card-body ml-2 text-white">
                        <h4 class="card-title">Name: <?php echo $teacher_byID['first_name'] . " ". $teacher_byID['last_name']; ?></h4>
                        <p class="card-text">Age: <?php echo $teacher_byID['age']; ?></p>
                        <p class="card-text">Gender: <?php echo $teacher_byID['gender']; ?></p>
                        <p class="card-text">Address: <?php echo $teacher_byID['address']; ?></p>
                        <p class="card-text">Email: <?php echo $teacher_byID['email']; ?></p>
                        <p class="card-text">Access: <?php echo $teacher_byID['access']; ?></p>
                        <p class="card-text">Register date: <?php echo $teacher_byID['created_at']; ?></p>
                        
                    </div>
                    <div class="mt-2 mb-2 mr-2">
                        <img src="../assets/uploads/<?php echo $student_byID['student_image']; ?>" class="img-fluid rounded-start" alt="..." style="height: 300px; width: 300px; border:5px solid black;">
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <a href="teachers_index.php" class="btn btn-primary text-white text-decoration-none">Back</a>
                <button class="btn btn-success my-1" data-toggle="modal" data-target="#exampleModal">Update</button>

            </div>
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
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $teacher_byID['first_name']?>">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo $teacher_byID['last_name']?>">
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="text" name="age" class="form-control" value="<?php echo $teacher_byID['age']?>">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender">
                                <option value="Male" <?php echo ($student_byID['gender'] == "Male")? 'selected' : '';?>>Male</option>
                                <option value="Female" <?php echo ($student_byID['gender'] == "Female")? 'selected' : '';?>>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $teacher_byID['address']?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $teacher_byID['email']?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" name="updating_details" value="Update">
                    </div>
                    </div>
                </div>
                </div>
            </form>
    
        </div>
    </div>
</div>

<?php include('../views/footer.php'); ?>