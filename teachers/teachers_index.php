<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    include_once('teachers_controller.php');

    if(isset($_GET['page_no']) && $_GET['page_no'] !== ""){
        $page_no = $_GET['page_no'];
    }else{
        $page_no = 1;
    }
    $previous_page = $page_no - 1; //get previous pages
    $next_page = $page_no + 1; //get the next page

    $all_teacher = get_all_teacher($con, $page_no, $total_records_per_page, $errorMessage);
    $total_no_of_pages = get_total_no_of_page($con, $total_records_per_page);
    $delete_func = delete_teacher($con);
?>

<?php include('../views/header.php'); ?>
<div class="container-fluid mt-5">
    <?php include('../views/burger_button.php'); ?>
    <div class="row justify-content-center">
        <?php include('../views/navbar.php'); ?>
        <div class="col-12 col-md-9 col-lg-8 p-3">
            <h1>All Teachers</h1>
            <div class="m-2">            
                <form action="teacher_result.php"method="get" class="float-right">
                    <input type="text" name="search" id="search" style="border:3px solid white;">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
            <table class="table table-bordered table-striped text-white">
            <?php if (!empty($all_teacher)) { ?>
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($all_teacher as $row): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['first_name'] . " ". $row['last_name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td style="width: 160px; white-space: nowrap;">
                                <div class="d-flex justify-content-center" style=" gap: 5px;">
                                    <a href="teachers_details.php?ID=<?php echo $row['id']?>" class="btn btn-primary btn-sm">View</a>
                                    <?php if(isset($_SESSION['Access']) && $_SESSION['Access'] == "admin"){?>
                                    <form action="<?php echo $delete_func;?>" method="post" style="margin: 0;">
                                        <input type="hidden" name="ID" value="<?php echo $row['id'];?>">
                                        <button type="submit" name="deleting_teacher" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <?php }?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <?php } else { ?>
                    <div>
                        <p class="text-center text-danger"><?php echo $errorMessage; ?></p>
                    </div>
                <?php } ?>
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
            <div class="div p-10 text-white">
                <strong>Page <?= $page_no;?> of <?= $total_no_of_pages;?></strong>
            </div>
        </div>
    </div>
</div>

<?php include('../views/footer.php'); ?>
