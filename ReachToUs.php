<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title></title>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Jekyll v4.0.1">
        <title>Carousel Template · Bootstrap</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">

        <!-- Bootstrap core CSS -->
        <link href="bs/bootstrap.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Reach to us</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width = device-width, initial-scale =1">
    </head>

<body>
    <?php
    include 'adminnav.php';
    ?>
    <table class="table table-dark table-striped table-bordered">
        <tr>

            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <tbody>
            <?php
            $userdb = new mysqli('localhost', 'root', '', 'assignment');
            if ($userdb->connect_error) {
                die("Connection failed: " . $userdb->connect_error);
            }

            $sql = "select * from message";     //show by row and loops
            $run = $userdb->query($sql);
            if ($run) {
                while ($row = mysqli_fetch_array($run)) {
                    echo "<tr><td>{$row['mname']}</td><td>{$row['email']}</td><td>{$row['message']}</td><td>{$row['status']}</td><td><a href='editMsg.php?message_id={$row['message_id']}&mname={$row['mname']}&message={$row['message']}&email={$row['email']}&status={$row['status']}'>Edit</a></td><td><a href='deleteMsg.php?message_id={$row['message_id']}&mname={$row['mname']}&message={$row['message']}&email={$row['email']}&status={$row['status']}'>Delete</a></td></tr>";
                }
            }
            $userdb->close();
            ?>
        </tbody>
    </table>
</body>

</html>