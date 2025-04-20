<?php
    if(!isset($_SESSION)){
        session_start();
    }
    include_once("connection.php");
    $con = connection();



    //login part
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM teacher WHERE email = '$email' AND password = '$password'";

        $user = $con->query($sql) or die ($con->query);
        $row = $user->fetch_assoc();
        $total = $user->num_rows;

        if($total > 0){
            $_SESSION['UserID'] = $row['id'];
            $_SESSION['UserLogin'] = $row['email'];
            $_SESSION['UserFirstName'] = $row['first_name'];
            $_SESSION['Access'] = $row['access'];

            echo header("Location:students/students_index.php");
        } else {
            $errorMessage = "No user found.";
        }

    }

?>

<?php include_once('views/header.php'); ?>
<div class="container-fluid" style="margin-top:150px;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-8 text-white d-flex justify-content-center align-items-center" style="height:50vh;">
            <div clas="d-flex justify-content-center align-items-center flex-column" style="width:400px; background-color: rgba(0, 0, 0, 0.2); padding:20px; border: 3px solid white;">
                <div class="text-center text-white">
                    <h3>Login</h3>
                </div>
                <form method="post" class="mt-4">
                    <div class="form-group">
                        <label for="email" class="text-info">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email" >
                    </div>
                    <div class="form-group ">
                        <label for="password"  class="text-info">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <p class="mt-2">New here? <a href="register.php"  class="text-info">Create an account.</a></p>
                    </div>
                    <div class="form-group">
                        <?php if (!empty($errorMessage)) { ?>
                        <p class="text-center text-danger"><?php echo $errorMessage; ?></p>
                        <?php } ?>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="login" class="btn btn-primary float-center">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php include_once('views/footer.php'); ?>
