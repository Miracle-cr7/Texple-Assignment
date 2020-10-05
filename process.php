<?php session_start(); ?>
<?php
define("REDIRECT1","Location:new.php");

$mysqli = new mysqli('localhost','root','') or die(mysqli_error($mysqli));
$mysqli->query('CREATE DATABASE IF NOT EXISTS work') or die($mysqli->error);
$mysqli->select_db('work');
$mysqli->query("CREATE TABLE IF NOT EXISTS todo_List( _id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, ToDo VARCHAR(500) NOT NULL, date DATE NOT NULL)") or die($mysqli->error);

$update = false;
$id = 0;
$todo = '';


if (isset($_POST['save'])){
    $todo = $_POST['ToDo'];
    $mysqli->query("INSERT INTO todo_list (ToDo,date) VALUES ('$todo', CURRENT_DATE() )") or die($mysqli->error);

    $_SESSION['message']= "Record has been saved !!";
    $_SESSION['msg_type']= "success";

    header(REDIRECT1);
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM todo_list WHERE _id=$id") or die ($mysqli->error);

    $_SESSION['message']= "Record has been deleted !!";
    $_SESSION['msg_type']= "danger";

    header(REDIRECT1);
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM todo_list WHERE _id= '$id'") or die($mysqli->error);
    if (count($result) == 1){
        $row = $result->fetch_array();
        $todo = $row['ToDo'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['_id'];
    $todo  = $_POST['ToDo'];

    $mysqli->query("UPDATE todo_list SET ToDo='$todo' WHERE _id=$id") or die($mysqli->error);

    $_SESSION['message']= "Record has been updated !!";
    $_SESSION['msg_type']= "warning";

    header(REDIRECT1);
}
?>