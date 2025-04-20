
<div class="collapse d-md-block col-12 col-md-1 col-lg-2 mb-5 text-white sidebar" id="sidebarMenu">
  <div class="p-3" style=" background-color: rgba(0, 0, 0, 0.2); border: 1px solid white;">
    <?php if(isset($_SESSION['UserLogin'])){?>
    <div class="d-flex justify-content-center mb-4 text-white">
      <h6 class="text-info">Welcome <?php echo $_SESSION['UserFirstName']?>!</h6>
    </div>
    <ul class="nav flex-column align-items-center">
      <li class="nav-item"><a href="../students/students_index.php" class="nav-link text-white">Students</a></li>
      <li class="nav-item"><a href="../teachers/teachers_index.php" class="nav-link text-white">Teachers</a></li>
      <?php if(isset($_SESSION['Access']) && $_SESSION['Access'] == "admin"){?>
        <li class="nav-item"><a href="../grades/grade_index.php" class="nav-link text-white">Grade</a></li>
        <li class="nav-item"><a href="../section/section_index.php" class="nav-link text-white">Section</a></li>
      <?php }?>
    </ul>
    <div class="d-flex justify-content-center align-items-center flex-column mt-5">
      <div>
        <a href="../teachers/teachers_details.php?ID=<?php echo $_SESSION['UserID']?>" class="text-decoration-none text-white">
          <span class="fs-4 nav-link">My profile</span>
        </a>
      </div>
      <div>
        <a href="../index.php" class="text-decoration-none text-white">
          <span class="fs-4 nav-link">Logout</span>
        </a>
      </div>
    </div>
    <?php } else { ?>
    <div class="d-flex justify-content-center align-items-center flex-column">
      <div>
        <h5 class="text-info">Welcome Guest!</h5>
      </div>
      <div>
        <a href="../login.php" class="text-decoration-none text-white">
          <span class="fs-4 nav-link">Login</span>
        </a>
      </div>
      <div>
        <a href="../register.php" class="text-decoration-none text-white">
          <span class="fs-4 nav-link">Register</span>
        </a>
      </div>
    </div>
    <?php } ?>
  </div>
</div>