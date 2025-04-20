<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    include_once('teachers_controller.php');
    $delete_func = delete_teacher($con);

    //search part
    $search = $_GET['search'];

    //list saka lang imodify kpag may search orig select SELECT * from student_list ORDER BY id DESC
    $sql = "SELECT * from teacher WHERE first_name LIKE '%$search%' || last_name LIKE '%$search%' ORDER BY id DESC";
    $students = $con->query($sql) or die ($con->error);
    $row = $students->fetch_assoc();
    $all_search_teacher = $row;

    if ($all_search_teacher > 0) {
        $all_search_teacher;
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
            <h1>All Teachers</h1>
            <div class="m-2">            
                <a class="btn btn-danger float-right ml-1" href="teachers_index.php">Clear</a>
                <form action="teacher_result.php"method="get" class="float-right">
                     <input type="text" name="search" id="search" style="border:3px solid white;" value="<?php echo $search?>">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
            <table class="table table-bordered table-striped text-white">
            <?php if (!empty($all_search_teacher)) { ?>
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $all_search_teacher['id']; ?></td>
                        <td><?php echo $all_search_teacher['first_name'] . " ". $all_search_teacher['last_name']; ?></td>
                        <td><?php echo $all_search_teacher['email']; ?></td>
                        <td style="width: 160px; white-space: nowrap;">
                            <div class="d-flex justify-content-center" style=" gap: 5px;">
                                <a href="teachers_details.php?ID=<?php echo $all_search_teacher['id']?>" class="btn btn-primary btn-sm">View</a>
                                <form action="<?php echo $delete_func;?>" method="post" style="margin: 0;">
                                    <input type="hidden" name="ID" value="<?php echo $all_search_teacher['id'];?>">
                                    <button type="submit" name="deleting_teacher" class="btn btn-danger btn-sm">Delete</button>
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
        </div>
    </div>
</div>

<?php include('../views/footer.php'); ?>
