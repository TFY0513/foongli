<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<title>Delete Product</title>
<style>
  .submit {
    margin-left: 50%;
  }

  .deleteTable {
    width: 45%;
    margin-left: auto;
    margin-right: auto;
  }

  .deleteTable,
  th,
  td {
    border: 3px solid black;
    border-collapse: collapse;
  }

  tr,
  th {
    padding: 10px;
    text-align: center;
    vertical-align: middle;
  }

  .back {
    margin-left: 44%;
  }
</style>

<?php
$connect = new mysqli('localhost', 'root', '', 'foongli'); //Connect database
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}
//Get product ID and show the other values, productID as key value

$ID = $_REQUEST['productID'];
$sql = "select * from products where productID = '$ID'";
$run = $connect->query($sql);

if ($run) {
  while ($row = mysqli_fetch_array($run)) {
    if ($row['productID'] == $ID) {
      $ID = $row['productID'];
      $cat = $row['categoryID'];
      $desc = $row['name'];
      $price = $row['price'];
      $img = $row['image'];
    }
  }
}
// Delete order by query where productID= ?
if (isset($_POST['submit'])) {
  $connect = new mysqli('localhost', 'root', '', 'foongli');

  if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
  }

  $delete = "delete from products where productID = '$ID'";
  $run = $connect->query($delete);
  if ($run) {
    echo "<script type='text/javascript'>alert('Delete succesfully !')</script>";
  }
  $connect->close();
}
?>

<form class="form-horizontal" enctype="multipart/form-data" method="post" section="<?php echo $_SERVER['PHP_SELF'] ?>">
  <fieldset>

    <!-- Form Name -->
    <legend style="text-align:center; font-size: 40px; "><b>UPDATE PRODUCT</b></legend>



    <div class="form-group">

      <label class="col-md-4 control-label " for="name">PRODUCT ID</label>
      <div class="col-md-4">
        <input id="product_id" name="ID" maxlength="40" placeholder="PRODUCT ID" disabled value="<?php echo $ID; ?>" class="form-control input-md" type="text">

      </div>

    </div>

    </br>
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="price">PRODUCT CATEGORY</label>
      <div class="col-md-4">
        <select class="form-control input-md" disabled name="cat">
          <option value="Dim Sum" <?php if ($cat == "DimSum") {
                                    echo 'selected';
                                  } ?>>Dim Sum</option>
          <option value="Bao Zi" <?php if ($cat == "BaoZi") {
                                    echo 'selected';
                                  } ?>>Bao Zi</option>
        </select>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="quantity">DESCRIPTION</label>
      <div class="col-md-4">
        <input id="quantity" name="description" disabled value="<?php if (empty($_POST['submit'])) {
                                                                  echo $desc;
                                                                } else ?>" class="form-control input-md" type="text">

      </div>
    </div>


    <!-- Textarea -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="description">PRODUCT PRICE (RM)</label>
      <div class="col-md-4">
        <input id="product_price" name="price" disabled maxlength="10" placeholder="PRODUCT PRICE" value="<?php if (empty($_POST['submit'])) {
                                                                                                            echo $price;
                                                                                                          }; ?>" class="form-control input-md" type="text">

      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="image">IMAGE</label>
      <div class="col-md-4">
        <?php
        echo "<img width='100px' height='100px' src='images/" . $img . "'><br>";
        ?>
      </div>
    </div>
    <div class="form-group">
      <div class="button">
        <input class="submit" type="submit" name="submit" onclick="return checkDelete()" value="Delete">
      </div>
    </div>
    <script>
      function checkDelete() {
        return confirm('Are you sure to delete this ? ');
      }
    </script>
    <?php
    echo "<div class='back'>
    
   [<a  href='productManage.php' >Back to Manage Product</a>] 
</div>";

    ?>

  </fieldset>
</form>