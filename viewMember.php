<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>View Member</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">

    <!-- Bootstrap core CSS -->
    <link href="bs/bootstrap.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>View member</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale =1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include 'adminnav.php'
    ?>
    <br>
    <table class="table table-dark table-striped table-bordered">
        <!-- table formatting -->
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th>Contact number</th>
			<th>gender</th>
			<th>address</th>
			<th>name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <tbody>
            <?php
            $userdb = new mysqli('localhost', 'root', '', 'foongli');    //connect database
            if ($userdb->connect_error) {
                die("Connection failed: " . $userdb->connect_error);
            }
            $sql = "select * from member where deleteAcc='No'"; //run query to display all members
            $run = $userdb->query($sql);
            if ($run) {
                while ($row = mysqli_fetch_array($run)) {   //Display all members by list and into table
                    echo "<tr>
					<td>{$row['userID']}</td>
					<td>{$row['username']}</td>
					<td>{$row['password']}</td>
					<td>{$row['email']}</td>
					<td>{$row['contactNum']}</td>
					<td>{$row['gender']}</td>
					<td>{$row['address']}</td>
					<td>{$row['name']}</td>
					<td><a href='editMember.php?userID={$row['userID']}&username={$row['username']}&password={$row['password']}&email={$row['email']}&contactNum={$row['contactNum']}&gender={$row['gender']}&address={$row['address']}&name={$row['name']}'>Edit</a></td>
					
					<td><a href='deleteMember.php?userID={$row['userID']}&username={$row['username']}&password={$row['password']}&email={$row['email']}&contactNum={$row['contactNum']}&gender={$row['gender']}&address={$row['address']}&name={$row['name']}'>Delete</a></td></tr>";
                }
            } else {
                echo 'Empty';
            }
            $userdb->close();
            ?>
        </tbody>
    </table>
    </script>
</body>

</html>