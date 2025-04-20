<?php 
    include_once('../connection.php');
    $con = connection();

    //get page number
    if(isset($_GET['page_no']) && $_GET['page_no'] !== ""){
        $page_no = $_GET['page_no'];
    }else{
        $page_no = 1;
    }

    
    //total rows or records to display
    $total_records_per_page = 8;
    //get the page offset for the LIMIT query
    $offset = ($page_no - 1) * $total_records_per_page;

    //get previous pages
    $previous_page = $page_no - 1;
    //get the next page
    $next_page = $page_no + 1;

    //get the total coun of record
    $result_count = mysqli_query($con, "SELECT COUNT(*) as total_records FROM student_info") or die(mysqli_error($con));
    //total records
    $record = mysqli_fetch_array($result_count);
    //store total_record to a varaible
    $total_records = $record['total_records'];
    //get total pages
    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    //query string
    $sql = "SELECT * FROM student_info LIMIT $offset , $total_records_per_page";
    // result
    $result = mysqli_query($con, $sql) or die(mysqli_query($con))
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
            <h1>All Students</h1>
            <div class="bg-dark">

            </div>
            
            <table class="table table-hover table-bordered table-striped text-black">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Grade</th>
                        <th>Section</th>
                        <th>Image</th>

                    </tr>
                </thead>
                <tbody class="text-wrap">
                    <?php while($row = mysqli_fetch_array($result)){ ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['first_name'] . " ". $row['last_name']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['age']; ?></td>
                            <td><?php echo $row['grade']; ?></td>
                            <td><?php echo $row['section']; ?></td>
                            <td><a href="students_details.php?ID=<?php echo $row['id']?>" class="btn btn-primary">View</a></td><td><form action="<?php echo $delete_func;?>" method="post">
                                    <button type="submit" name="deleting_section" class="btn btn-danger">Delete</button>
                                    <input type="hidden" name="ID" value="<?php echo $row['id'];?>">
                                </form></td>
                        </tr>
                    <?php }
                    mysqli_close($con)?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= ($page_no <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" <?= ($page_no > 1) ? 'href=?page_no=' . $previous_page : ''; ?>>Previous</a>
                    </li>

                    <?php for($counter = 1; $counter <= $total_no_of_pages; $counter++) { ?>
                        <?php if($page_no != $counter) { ?>
                            <li class="page-item">
                                <a class="page-link" href="?page_no=<?= $counter; ?>"><?= $counter; ?></a>
                            </li>
                        <?php } else { ?>
                            <li class="page-item active">
                                <a class="page-link" href="#"><?= $counter; ?></a>
                            </li>
                        <?php } ?>
                    <?php } ?>

                    <li class="page-item <?= ($page_no >= $total_no_of_pages) ? 'disabled' : ''; ?>">
                        <a class="page-link" 
                            <?= ($page_no < $total_no_of_pages) ? 'href=?page_no=' . $next_page : 'tabindex="-1" aria-disabled="true"'; ?>>
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="div p-10">
                <strong>Page <?= $page_no;?> of <?= $total_no_of_pages;?></strong>
            </div>
        </div>

    </div>
</div>

<?php include('../views/footer.php'); ?>
