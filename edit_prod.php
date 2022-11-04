<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<title>Edit Product Details</title>
<style>
    .prodID {
        margin-top: 5px;
    }

    a:hover {
        text-decoration: none;
    }

    .error {
        color: #FF0000;
    }

    .errorHeader {
        color: #FF0000;
        margin-left: 45%;
    }

    .image {
        margin-top: 5px;
    }

    .button {
        margin-left: 45%;
    }

    .back {
        margin-left: 44%;
    }
</style>

<?php


$connect = new mysqli('localhost', 'root', '', 'foongli');
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

//-------Get product info--------------------------------

$ID = $_REQUEST['productID'];
$sql = "select * from products_table where productID = '$ID'";
$run = $connect->query($sql);

if ($run) {
    while ($row = mysqli_fetch_array($run)) {
        if ($row['productID'] == $ID) {
            $ID = $row['productID'];
            $cat = $row['categoryID'];
            $name = $row['name'];
            $price = $row['price'];
            $img = $row['image'];
        }
    }
}
//---------------------------------------------------
$newDesc = $newImg = "";
$invalidPrice = $invalidDesc = $invalidImage = "";
$newPrice = 0;
$invalid = 0;

if (isset($_POST['submit'])) {  //Start Validate if submit the through the update button


    //Only update Description, Price and Image
    if (empty($_POST['name'])) { //Must have description
        $invalid = 1;
        $invalidDesc = "This field is required !";
    } else {
        $newDesc = $_POST['name'];
  }
   
    if (empty($_POST['price'])) { //Check if price is empty
        $invalid = 1;
        $invalidPrice = "This field is required !";
    } else {
        $newPrice = $_POST['price'];
        if (!preg_match('/(?<price>(\d+((\.|\,)\d+)+))/', $newPrice)) {
            $invalidPrice = "Invalid Price !";
            $invalid = 1;
        }
    }
    if (empty($_FILES['image'])) {  //Check if there's no image
        $invalid = 1;
        $invalidImage = "This field is required !";
    } else {
        $maxFileSize = 5242880;
        $target_dir = "images/";
        $image = $_FILES['image']['name'];
        $target_file = $target_dir . $image;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $invalidImage = "Image can only in format of JPG, PNG, or JEPG !";
            $invalid = 1;
        }
        //Image Must < 5MB
        if (filesize($_FILES['image']['tmp_name']) > $maxFileSize) {
            $invalidImage = "Image size too large !";
            $invalid = 1;
        }
        if ($invalid == 0) {
            $target_dir = "images/";
            $image = $_FILES['image']['name'];
            $target_file = $target_dir . $image;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $openFolder = "Failed to upload into folder !";
            }
        }
    }

    if ($invalid == 0) { //update if there's no invalid values
        $update = "update products set productPrice='{$newPrice}', name='{$name}',productImg='{$image}' where productID='$ID' ";

        $check = $connect->query($update);
        if ($check) {
            echo "<script type='text/javascript'>    alert('Update succesfully !') </script>";
        }
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
                <input id="product_id" name="ID" maxlength="40" placeholder="PRODUCT CATEGORY" disabled value="<?php echo $cat; ?>" class="form-control input-md" type="text">
            </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="quantity">DESCRIPTION</label>
            <div class="col-md-4">
                <input id="quantity" name="description" value="<?php if (empty($_POST['submit'])) {
                                                                    echo $name;
                                                                } else {
                                                                    echo $name;
                                                                } ?>" class="form-control input-md" type="text">
                <span class="error"><?php echo $invalidDesc; ?></span>
            </div>
        </div>


        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="description">PRODUCT PRICE (RM)</label>
            <div class="col-md-4">
                <input id="product_price" name="price" maxlength="10" placeholder="PRODUCT PRICE" value="<?php if (empty($_POST['submit'])) {
                                                                                                                echo $price;
                                                                                                            } else {
                                                                                                                echo $newPrice;
                                                                                                            } ?>" class="form-control input-md" type="text">
                <span class="error"><?php echo $invalidPrice; ?></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="image">UPLOAD IMAGE</label>
            <div class="col-md-4">
                <input class="image" type="file" id="image" name="image">
                <span class="error"><?php echo $invalidImage; ?></span>
            </div>
        </div>
        <div class="form-group">

            <div class="button">
                <input class="submit" type="submit" name="submit" value="Update">
                <input class="reset" type="reset" name="reset" value="Reset">
            </div>
        </div>
        <?php
        echo "<div class='back'>
   [<a  href='productManage.php' >Back to Manage Product</a>] 
</div>";
        ?>
    </fieldset>
</form>