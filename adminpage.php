<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Admin Dashboard</title>
    </head>

    <body>
        <?php
        include('adminnav.php');
        ?>
        <style>
            table {

                margin-top: 20px;
            }

            table,
            th,
            td {

                border: 3px solid black;
                border-collapse: collapse;
            }

            th {
                background-color: white;
            }

            tr {
                text-align: center;
                vertical-align: middle;
                background-color: #ffffff;
            }

            th,
            td {
                padding: 10px;
            }
        </style>

        <!-- Default page after login as admin, will show total Sales till the current date(Getting the date from the local time) -->
    <body>
        <div class="form-head">
            <center>
                <?php echo"<h1>Total Business Sales until the date of " . date("Y-m-d") . "<br>"; ?>

            </center>
        </div>
        <table style="width:100%">
            <tr>
                <th>Total Items Sold </th>
                <th>Total Sales<br>
            </tr>
            <?php
            //--detect inactiivity--//
            include_once 'inactivityDetect.php';
            ////////////////////////
           // echo "time is " . $_SESSION['time'];
            
            
            $db = new mysqli('localhost', 'root', '', 'foongli');    //connect database and sums up the total items sold


            $result = mysqli_query($db, "SELECT SUM(Quantity) AS Quantity FROM shopcart WHERE confirmOrder ='Yes'");
            $row = mysqli_fetch_array($result);
            $count = $row['Quantity'];

            $db2 = new mysqli('localhost', 'root', '', 'foongli');   //connect database and display total sales

            $price = mysqli_query($db2, "SELECT SUM(totalPrice) AS totalAmount FROM shopcart WHERE confirmOrder ='Yes'");
            $ay = mysqli_fetch_array($price);
            $totalAmount = $ay['totalAmount'];

            echo "<tr><td>$count</td><td>RM $totalAmount</td></tr>";
            ?>
        </table>
    </body>

</html>