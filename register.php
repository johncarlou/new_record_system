
<?php
    include_once('connection.php');
    $con = connection();
    $register_func = register_teacher($con);

    function register_teacher($con){
        if(isset($_POST['adding_teacher'])){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $query = "INSERT INTO teacher (`first_name`, `last_name`, `email`, `password`,`access`) VALUES ('$first_name', '$last_name', '$email', '$password', 'teacher')";

            $con->query($query) or die ($con->error);
            header("Location: login.php");
            exit;
        }
    }
?>
<?php include_once('views/header.php'); ?>
<div class="container-fluid" style="margin-top:150px;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-8 text-white d-flex justify-content-center align-items-center" style="height:50vh;">
            <div clas="d-flex justify-content-center bg-success align-items-center flex-column" style="width:400px; background-color: rgba(0, 0, 0, 0.2); padding:20px; border: 3px solid white;">
                <div class="text-center text-white">
                    <h3>Register</h3>
                </div>
                <form action="<?php echo $register_func?>" method="post" class="mt-4">
                    <div class="form-group">
                        <label for="first_name"  class="text-info">First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" >
                    </div>
                    <div class="form-group">
                        <label for="last_name"  class="text-info">Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" >
                    </div>
                    <div class="form-group">
                        <label for="email"  class="text-info">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" >
                    </div>
                    <div class="form-group ">
                        <label for="password"  class="text-info">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="adding_teacher" class="btn btn-primary float-center">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php include_once('views/footer.php'); ?>