<?php 
    include_once('../connection.php');
    $con = connection();

    function get_all_grade($con, &$errorMessage){
        $query = "SELECT * FROM grade ORDER by gradename ASC";
        $grades = $con->query($query) or die($con->error);
    
        $rows = [];
        while ($row = $grades->fetch_assoc()) {
            $rows[] = $row;
        }

        if (count($rows) > 0) {
            return $rows;
        } else {
            $errorMessage = "No data.";
            return [];
        }
    }

    function get_grade_byID($con){

        $id = $_GET['ID'];
        $query = "SELECT * FROM grade WHERE id = '$id'";
        $grade = $con->query($query) or die ($con->error);
        $row = $grade->fetch_assoc();

        return $row;
    }

    function add_grade($con){
        if(isset($_POST['adding_grade'])){
            $grade = $_POST['gradename'];

            $query = "INSERT INTO grade (gradename) VALUES ('$grade')";
            $con->query($query) or die ($con->error);
            header("Location: grade_index.php");
            exit;
        }

    }
    
    function update_grade($con, $id){

        if(isset($_POST['update_details'])){
            $grade_name = $_POST['gradename'];
            $query = "UPDATE grade SET gradename = '$grade_name' WHERE id = '$id'";

            $con->query($query) or die ($con->error);
            header("Location:grade_details.php?ID=".$id);
            exit;
        }
    }

    function delete_grade($con){

        if(isset($_POST['deleting_grade'])){
            $id = $_POST['ID'];
            $sql = "DELETE FROM grade WHERE id = $id";
            $con->query($sql) or die ($con->error);
    
            echo header("Location:grade_index.php");
        }
    }

    
?>