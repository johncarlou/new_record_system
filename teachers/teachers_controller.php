<?php 
    if(!isset($_SESSION)){
        session_start();
    }
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
        $result_count = mysqli_query($con, "SELECT COUNT(*) as total_records FROM teacher") or die(mysqli_error($con));
        $record = mysqli_fetch_array($result_count);
        $total_records = $record['total_records'];
        $total_no_of_pages = ceil($total_records / $total_records_per_page);

        return $total_no_of_pages;
    }


    function get_all_teacher($con, $page_no, $total_records_per_page, &$errorMessage){
        $offset = get_all_total_rows($page_no,$total_records_per_page);

        $query = "SELECT * FROM teacher LIMIT $offset , $total_records_per_page";
        $teachers = $con->query($query) or die($con->error);
    
        $rows = [];
        while ($row = $teachers->fetch_assoc()) {
            $rows[] = $row;
        }
        
        if (count($rows) > 0) {
            return $rows;
        } else {
            $errorMessage = "No data.";
            return [];
        }
    }

    function get_teacher_byID($con){

        $id = $_GET['ID'];
        $query = "SELECT * FROM teacher WHERE id = '$id'";
        $teacher = $con->query($query) or die ($con->error);
        $row = $teacher->fetch_assoc();

        return $row;
    }

    function update_teacher($con, $id){
        if(isset($_POST['updating_details'])){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $access_clause = "";
            if(isset($_SESSION['Access']) && $_SESSION['Access'] == "admin"){
                $access = $_POST['access'];
                $access_clause = ", `access`='$access'";
            }
    
            if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
                $image_name = $_FILES['image']['name'];
                $image_tmp = $_FILES['image']['tmp_name'];
                $image_path = "../assets/uploads/" . basename($image_name);
                move_uploaded_file($image_tmp, $image_path);
    
                $query = "UPDATE `teacher` SET `first_name`='$first_name',`last_name`='$last_name', `age`='$age',`gender`='$gender',`address`='$address',`email`='$email',
                `password`='$password',`teacher_image`='$image_name'$access_clause WHERE id = '$id'";
            } else {
                $query = "UPDATE `teacher` SET `first_name`='$first_name',`last_name`='$last_name', `age`='$age',`gender`='$gender',`address`='$address',`email`='$email',
                `password`='$password' $access_clause WHERE id = '$id'";
            }
    
            $con->query($query) or die ($con->error);
            header("Location:teachers_details.php?ID=".$id);
            exit;
        }
    }


    function delete_teacher($con){

        if(isset($_POST['deleting_teacher'])){
            $id = $_POST['ID'];
            $sql = "DELETE FROM teacher WHERE id = $id";
            $con->query($sql) or die ($con->error);
    
            echo header("Location:teachers_index.php");
        }
    }


?>