<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>ToDo App</title>
</head>

<body>
<br>
    <?php require_once 'process.php';
    ?>

    <?php if (isset($_SESSION['message'])) : ?>
        <div class="row justify-content-center">
            <div class="alert alert-<?= $_SESSION['msg_type'] ?>">

                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="container">
        <?php
        $mysqli = new mysqli('localhost', 'root', $_SESSION['pass'],'work') or die(mysqli_error($mysqli));
        $result = $mysqli->query('SELECT * FROM todo_list') or die($mysqli->error);
        ?>

        <div class="row justify-content-center">
            <table class="table">
                <caption>List of pending Tasks : <?php echo mysqli_num_rows($result); ?></caption>
                <thead>
                    <tr>
                        <th scope="col">To Do</th>
                        <th scope="col">Date</th>
                        <th colspan='2' scope="col">Action</th>
                    </tr>
                </thead>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td> <?php echo $row['ToDo']; ?> </td>
                        <td> <?php echo $row['date']; ?> </td>
                        <td>
                            <a href="new.php?edit=<?php echo $row['_id']; ?>" class="btn btn-info">Edit</a>

                            <a href="process.php?delete=<?php echo $row['_id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <?php
        function pre_r($array)
        {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
        ?>
        <div class="row justify-content-center">
            <form action="process.php" method="POST">
                <input type="hidden" name="_id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label>To Do</label>
                    <input type="text" name="ToDo" class="form-control" value="<?php echo $todo; ?>" placeholder="Enter something TO DO">
                </div>
                <div class="form-group">
                    <?php if ($update) : ?>
                        <button type="submit" name="update" class="btn btn-info">Update</button>
                    <?php else : ?>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    <br><br><br>
                        <br>
    <div class="text-center main">
        <a href="logout.php" class="btn btn-primary btn-rounded" style="border-radius:4em/5em;background-color:darkblue" data-toggle="modal" onclick="" aria-pressed="true">Word Finder</a>
    </div>
</body>

</html>

<?php
?>