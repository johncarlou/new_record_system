<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    include_once('teachers_controller.php');

    $id = $_GET['ID'];

    $teacher_byID = get_teacher_byID($con);    
    $update_func = update_teacher($con, $id);


?>

<?php include('../views/header.php'); ?>

<div class="container-fluid mt-5">
    <?php include('../views/burger_button.php'); ?>
    <div class="row justify-content-center">
        <?php include('../views/navbar.php'); ?>
        <div class="col-12 col-md-9 col-lg-8 p-3">
            <h1><?php echo $teacher_byID['first_name']?>'s Details</h1>
            <div class="bg-dark">
                <div class="d-flex flex-nowrap">
                    <div class="card-body ml-2 text-white">
                        <p class="card-text">Full Name: <?php echo $teacher_byID['first_name'] . " ". $teacher_byID['last_name']; ?></hp>
                        <p class="card-text">Age: <?php echo $teacher_byID['age']; ?></p>
                        <p class="card-text">Gender: <?php echo $teacher_byID['gender']; ?></p>
                        <p class="card-text">Address: <?php echo $teacher_byID['address']; ?></p>
                        <p class="card-text">Email: <?php echo $teacher_byID['email']; ?></p>
                        <p class="card-text">Access: <?php echo $teacher_byID['access']; ?></p>
                        <p class="card-text">Register date: <?php echo $teacher_byID['created_at']; ?></p>
                        
                    </div>
                    <div class="mt-2 mb-2 mr-2">
                        <img src="../assets/uploads/<?php echo $teacher_byID['teacher_image']; ?>" class="img-fluid rounded-start" alt="No image" style="height: 300px; width: 300px; border:5px solid black;">
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <a href="teachers_index.php" class="btn btn-primary text-white text-decoration-none">Back</a>
                <?php if(isset($_SESSION['Access']) && $_SESSION['Access'] == "admin" || isset($_SESSION['Access']) && $_SESSION['UserLogin'] == $teacher_byID['email']){?>
                    <button class="btn btn-success my-1" data-toggle="modal" data-target="#exampleModal">Update</button>
                <?php }?>

            </div>
            <form action="<?php echo $update_func;?>" method="POST" enctype="multipart/form-data">
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
                            <label for="gender">Gender: </label>
                            <select name="gender" id="gender">
                                <option value="Male" <?php echo ($teacher_byID['gender'] == "Male")? 'selected' : '';?>>Male</option>
                                <option value="Female" <?php echo ($teacher_byID['gender'] == "Female")? 'selected' : '';?>>Female</option>
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
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $teacher_byID['password']?>">
                        </div>
                        <?php if(isset($_SESSION['Access']) && $_SESSION['Access'] == "admin"){?>
                            <div class="form-group">
                                <label for="access">Access: </label>
                                <select name="access" id="access">
                                    <option value="admin" <?php echo ($teacher_byID['access'] == "admin")? 'selected' : '';?>>admin</option>
                                    <option value="teacher" <?php echo ($teacher_byID['access'] == "etacher")? 'selected' : '';?>>teacher</option>
                                </select>
                            </div>
                        <?php }?>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <br>
                            <?php if(!empty($teacher_byID['teacher_image'])): ?>
                                <img src="../assets/uploads/<?php echo $teacher_byID['teacher_image']; ?>" style="width: 100px; height: 100px;">
                                <br>
                            <?php endif; ?>
                            <input type="file" name="image" />
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