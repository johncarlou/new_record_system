<?php 
    include_once('../connection.php');
    $con = connection();

    //total rows or records to display
    $total_records_per_page = 8;
    function get_all_total_rows($page_no, $total_records_per_page){
        //get the page offset for the LIMIT query
        $offset = ($page_no - 1) * $total_records_per_page;
        return $offset;
    }

    function get_total_no_of_page($con, $total_records_per_page){
        $result_count = mysqli_query($con, "SELECT COUNT(*) as total_records FROM student_info") or die(mysqli_error($con));
        $record = mysqli_fetch_array($result_count);
        $total_records = $record['total_records'];
        $total_no_of_pages = ceil($total_records / $total_records_per_page);

        return $total_no_of_pages;
    }

    function get_all_students($con, $page_no, $total_records_per_page, &$errorMessage){
        $offset = get_all_total_rows($page_no,$total_records_per_page);
        
        $query = "SELECT * FROM student_info LIMIT $offset , $total_records_per_page";
        $students = $con->query($query) or die($con->error);
    
        $rows = [];
        while ($row = $students->fetch_assoc()) {
            $rows[] = $row;
        }

        if (count($rows) > 0) {
            return $rows;
        } else {
            $errorMessage = "No data.";
            return [];
        }
    }

    function get_all_sections($con){
        $query = "SELECT section_name FROM section";
        $section = $con->query($query) or die($con->error);
    
        $rows = [];
        while ($row = $section->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    function get_all_grades($con){
        $query = "SELECT gradename FROM grade";
        $grade = $con->query($query) or die($con->error);
    
        $rows = [];
        while ($row = $grade->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    function get_students_byID($con){

        $id = $_GET['ID'];
        $query = "SELECT * FROM student_info WHERE id = '$id'";
        $section = $con->query($query) or die ($con->error);
        $row = $section->fetch_assoc();

        return $row;
    }


    function add_students($con){
        if(isset($_POST['adding_student'])){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $gender = $_POST['gender'];
            $age = $_POST['age'];
            $address = $_POST['address'];
            $grade = $_POST['grade'];
            $section = $_POST['section'];

            // Handle image upload
            $image_name = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_path = "../assets/uploads/" . basename($image_name);

            // Move uploaded image to your server folder
            move_uploaded_file($image_tmp, $image_path);

            $query = "INSERT INTO student_info (`first_name`, `last_name`, `gender`, `age`, `address`, `grade`, `section`,`student_image`) VALUES ('$first_name', '$last_name', '$gender', '$age', '$address', '$grade', '$section', '$image_name')";

            $con->query($query) or die ($con->error);
            header("Location: students_index.php");
            exit;
        }
    }


    function update_student($con, $id){
        if(isset($_POST['updating_student'])){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $gender = $_POST['gender'];
            $age = $_POST['age'];
            $address = $_POST['address'];
            $grade = $_POST['grade'];
            $section = $_POST['section'];


            // Check if a new image is uploaded
            if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
                $image_name = $_FILES['image']['name'];
                $image_tmp = $_FILES['image']['tmp_name'];
                $image_path = "../assets/uploads/" . basename($image_name);

                // Move uploaded image to your server folder
                move_uploaded_file($image_tmp, $image_path);
                
                $query = "UPDATE `student_info` SET `first_name`='$first_name',`last_name`='$last_name',`gender`='$gender',`age`='$age',`address`='$address',`grade`='$grade',`section`='$section', `student_image`='$image_name' WHERE id = '$id'";

            } else {
                // Update without image
                $query = "UPDATE `student_info` SET `first_name`='$first_name',`last_name`='$last_name',`gender`='$gender',`age`='$age',`address`='$address',`grade`='$grade',`section`='$section' WHERE id = '$id'";
            }

            $con->query($query) or die ($con->error);
            header("Location: students_details.php?ID=".$id);
            exit;
        }
    }


    function delete_student($con){

        if(isset($_POST['deleting_section'])){
            $id = $_POST['ID'];
            $sql = "DELETE FROM student_info WHERE id = $id";
            $con->query($sql) or die ($con->error);
    
            echo header("Location:students_index.php");
        }
    }


?>