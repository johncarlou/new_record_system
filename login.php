<?php
    include_once("connection.php");
    $con = connection();

    if(!isset($_SESSION)){
        session_start();
    }
    //login part
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM teacher WHERE email = '$email' AND password = '$password'";

        $user = $con->query($sql) or die ($con->query);
        $row = $user->fetch_assoc();
        $total = $user->num_rows;

        if($total > 0){
            $_SESSION['UserLogin'] = $row['email'];
            $_SESSION['UserFirstName'] = $row['first_name'];
            $_SESSION['Access'] = $row['access'];

            echo header("Location:students/students_index.php");
        } else {
            $errorMessage = "No user found.";
        }

    }

?>
<?php include('views/header.php'); ?>
<div class="login-container">
    <h1 class="p-5 text-center">Login Page</h1>
    <div class="container py-5 text-white login-inner-container">
        <div class="text-center ">
            <h5>Welcome to</h5>
            <h1>JC's private elementary school</h1>
            <h3>Student Record System</h3>
        </div>

        <div class="container p-5 w-50 text-center">
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" >
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <button type="submit" name="login" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
    <?php if (!empty($errorMessage)) { ?>
        <p class="text-center text-danger"><?php echo $errorMessage; ?></p>
    <?php } ?>
</div>

<?php include('views/footer.php'); ?>
