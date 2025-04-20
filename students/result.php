<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    include_once('students_controller.php');

    $all_sections= get_all_sections($con);
    $all_grades= get_all_grades($con);
    $add_func = add_students($con);
    $delete_func = delete_student($con);

    // for count of students and teachers
    function getCount($con, $query) {
        $result = $con->query($query) or die($con->error);
        $row = $result->fetch_assoc();
        return $row;
    }
    
    $total_students = getCount($con, "SELECT COUNT(*) as total_students FROM student_info");
    $total_users = getCount($con, "SELECT COUNT(*) as total_users FROM teacher");

    //search part
    $search = $_GET['search'];

    //list saka lang imodify kpag may search orig select SELECT * from student_list ORDER BY id DESC
    $sql = "SELECT * from student_info WHERE first_name LIKE '%$search%' || last_name LIKE '%$search%' ORDER BY id DESC";
    $students = $con->query($sql) or die ($con->error);
    $row = $students->fetch_assoc();
    $all_search_student = $row;

    if ($all_search_student > 0) {
        $all_search_student;
    } else {
        $errorMessage = "No data.";
    }

?>

<?php include('../views/header.php'); ?>
<div class="container-fluid mt-5">
    <?php include('../views/burger_button.php'); ?>
    <div class="row justify-content-center">
        <?php include('../views/navbar.php'); ?>
        <div class="col-12 col-md-9 col-lg-8 p-3">
            <h1>All Students</h1>
            <div class="d-flex justify-content-center align-items-center">
                <div class="bg-success m-1 d-flex justify-content-center align-items-center" style="height: 100px; width: 350px;">
                    <i class="fas fa-children text-center" style="font-size: 40px; color: white;"> <?php echo $total_students['total_students']; ?></i>
                </div>
                <div class="bg-warning m-1 d-flex justify-content-center align-items-center" style="height: 100px; width: 350px;">
                    <i class="fa-solid fa-users text-center" style="font-size: 40px; color: white;"> <?php echo $total_users['total_users']; ?></i>
                </div>
            </div>
            <div class="m-2">            
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add</button>

                <a class="btn btn-danger float-right ml-1" href="students_index.php">Clear</a>
                <form action="result.php"method="get" class="float-right">
                     <input type="text" name="search" id="search" style="border:3px solid white;" value="<?php echo $search?>">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
            <table class="table table-bordered table-striped text-white">
            <?php if (!empty($all_search_student)) { ?>
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $all_search_student['id']; ?></td>
                        <td><?php echo $all_search_student['first_name'] . " ". $all_search_student['last_name']; ?></td>
                        <td><?php echo $all_search_student['gender']; ?></td>
                        <td><?php echo $all_search_student['age']; ?></td>
                        <td><?php echo $all_search_student['grade']; ?></td>
                        <td style="width: 160px; white-space: nowrap;">
                            <div class="d-flex justify-content-center" style=" gap: 5px;">
                                <a href="students_details.php?ID=<?php echo $all_search_student['id']?>" class="btn btn-primary btn-sm">View</a>
                                <form action="<?php echo $delete_func;?>" method="post" style="margin: 0;">
                                    <input type="hidden" name="ID" value="<?php echo $all_search_student['id'];?>">
                                    <button type="submit" name="deleting_section" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <?php } else { ?>
                    <div>
                        <p class="text-center text-danger"><?php echo $errorMessage; ?></p>
                    </div>
                <?php } ?>
            </table>
            <form action="<?php echo $add_func;?>" method="POST" enctype="multipart/form-data">
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
                                <input type="text" name="first_name" class="form-control" placeholder="Enter your First Name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Enter your Last Name">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender">
                                    <option value="Boy" <?php echo ($row['gender'] == "Male")? 'selected' : '';?>>Male</option>
                                    <option value="Female" <?php echo ($row['gender'] == "Female")? 'selected' : '';?>>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="text" name="age" class="form-control" placeholder="Enter your Age">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter your Address">
                            </div>
                            <div class="form-group">
                                <label for="grade">Grade</label>
                                <select name="grade" id="grade">
                                    <?php foreach($all_grades as $row): ?>
                                        <option value="<?= $row['gradename'] ?>"><?= $row['gradename'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="section">Section</label>
                                <select name="section" id="section">
                                    <?php foreach($all_sections as $row): ?>
                                        <option value="<?= $row['section_name'] ?>"><?= $row['section_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <input type="file" name="image" id="image">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-success" name="adding_student" value="Add">
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<?php include('../views/footer.php'); ?>
