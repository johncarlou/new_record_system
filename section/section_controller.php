<?php 
    include_once('../connection.php');
    $con = connection();

    function get_all_section($con, &$errorMessage){
        $query = "SELECT * FROM section";
        $sections = $con->query($query) or die($con->error);
    
        $rows = [];
        while ($row = $sections->fetch_assoc()) {
            $rows[] = $row;
        }
    
        if (count($rows) > 0) {
            return $rows;
        } else {
            $errorMessage = "No data.";
            return [];
        }
    }

    function get_section_byID($con){

        $id = $_GET['ID'];
        $query = "SELECT * FROM section WHERE id = '$id'";
        $section = $con->query($query) or die ($con->error);
        $row = $section->fetch_assoc();

        return $row;
    }

    function add_section($con){
        if(isset($_POST['adding_section'])){
            $section = $_POST['section_name'];

            $query = "INSERT INTO section (section_name) VALUES ('$section')";
            $con->query($query) or die ($con->error);
            header("Location: section_index.php");
            exit;
        }

    }
    
    function update_section($con, $id){

        if(isset($_POST['update_details'])){
            $section_name = $_POST['section_name'];
            $query = "UPDATE section SET section_name = '$section_name' WHERE id = '$id'";

            $con->query($query) or die ($con->error);
            header("Location:section_details.php?ID=".$id);
            exit;
        }
    }

    function delete_section($con){

        if(isset($_POST['deleting_section'])){
            $id = $_POST['ID'];
            $sql = "DELETE FROM section WHERE id = $id";
            $con->query($sql) or die ($con->error);
    
            echo header("Location:section_index.php");
        }
    }

    
?>