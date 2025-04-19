
<?php include_once('views/header.php'); ?>
<div class="d-md-none bg-light px-2 py-2">
    <button class="btn btn-outline-dark" type="button" data-toggle="collapse" data-target="#sidebarMenu">
        ☰ Menu
    </button>
</div>
<div class="container-fluid" style="margin-top:150px;">
    <div class="row justify-content-center">
        <div class="collapse d-md-block col-12 col-md-2 col-lg-2 text-white sidebar" id="sidebarMenu">
            <div class="bg-dark p-3">
                <ul class="nav flex-column align-items-center">
                <li class="nav-item"><a href="login.php" class="nav-link text-white">Login</a></li>
                <li class="nav-item"><a href="" class="nav-link text-white">Register</a></li>

                </ul>
            </div>
        </div>
        <div class="col-12 col-md-9 col-lg-8 bg-dark d-flex justify-content-center align-items-center flex-column" style="height:50vh;">
            <h1 class="text-center">Welcome to Record system</h1>
        </div>
    </div>
</div>
<?php include_once('views/footer.php'); ?>