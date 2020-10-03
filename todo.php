<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/css/compiled-4.17.0.min.css?ver=4.17.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="mir.css">
  <title>ToDo List</title>
</head>
<body>
<?php
         $dbhost = 'localhost';
         $dbuser = 'root';
         $dbpass = $_POST['pass'];
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
         
         if(! $conn ) {
            die('Could not connect: '. $conn -> mysqli_connect_error);
         }

         $db = 'CREATE DATABASE IF NOT EXISTS work';

         $table = "CREATE TABLE IF NOT EXISTS todo_List( 
            _id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
            ToDo VARCHAR(500) NOT NULL, 
            date DATE NOT NULL
            );";

            $dbc = mysqli_query( $conn, $db );
            if(! $dbc ) {
               die('Could not create database: ' . mysqli_error($conn));
            }
            $conn->select_db('work');

            $res = mysqli_query( $conn,$table);

            if(!$res ) {
               die('Could not create table: ' . mysqli_error($conn));
            }
         ?>

            <div class="container" style="margin-bottom: 30px">
            <form method="POST" action="todo.php" class='pads'>
            <div class="row">
              <div class="col-sm-8 col-md-6 input-group" style="padding: 40px 0;">
                <input type="text" name="text" class="form-control" id="search" style="border-radius: 20px 0 0 20px; border-left: none;" placeholder="Try another word"/>
                <button class="xt" type="submit">
                <b><i class="material-icons">add</i></b>
                </button>
              </div>
            </div>
          </form>
          </div>
          <?php
          if ($_POST['text']) {
            $text = $_POST['text'];
            $row = "INSERT INTO todo_List (ToDo,date) values ($text , CURRENT_DATE())";
            $ins = mysqli_query($conn,$row);
            if(!$ins){
               die('Insertion Error: '.mysqli_error($conn));
            }

          }
          $data = 'SELECT * FROM todo_List';
          $query = mysqli_query($conn,$data);

          echo '<ul>';
          foreach($query as $rowx){
            echo '<li>'.$rowx.'</li>';
          }
          echo '</ul>';
            ?>

            <?php
            mysqli_close($conn);
            ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      </body>
</html>