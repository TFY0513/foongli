<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="bs/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<title>Add Products</title>
<style>
    .errorHeader {
        color: #FF0000;
        margin-left: 40%;
    }

    .image {
        margin-top: 5px;
    }

    .button {
        margin-left: 40%;
    }
</style>

<?php
//Initialize values
$invalidID = $invalidPrice = $invalidCat = $invalidImage = $invalidDesc = $msg = "";
$id = $cat = $desc = "";
$price = 0.0;
$empty = 0;
$invalid = 0;

if (isset($_POST['submit'])) {
    if (empty($_POST['id'])) {
        $empty = 1;
        $invalidID = "This field is required !";
    } else {
        $id = $_POST['id'];
        if (!(preg_match('~^[B][Z]\d*$~', $id)) && !(preg_match('~^[D][S]\d*$~', $id))) {   //Product ID Must only start from BZ as Baozi or DS as DimSum
            $invalidID = "Invalid ID!";
            $invalid = 1;
        }
    }
    if (empty($_POST['price'])) {
        $empty = 1;
        $invalidPrice = "This field is required !";
    } else {
        $price = $_POST['price'];
        if (!preg_match('/(?<price>(\d+((\.|\,)\d+)+))/', $price)) {    //Digit only
            $invalidPrice = "Invalid Price !";
            $invalid = 1;
        }
    }

    if (empty($_POST['categoryID'])) {
        $empty = 1;
        $invalidCat = "This field is required !";
    } else {
        $cat = $_POST['categoryID'];
    }

    if (empty($_POST['name'])) {
        $empty = 1;
        $invalidDesc = "This field is required !";
    } else {
        $name = $_POST['name'];
    }

    if (empty($_FILES['image'])) {
        $empty = 1;
        $invalidImage = "This field is required !";
    } else {
        //$fileType = array('.jpg', '.png', '.jpeg');

        $maxFileSize = 5242880;
        $target_dir = "images/"; ///image directory
        $image = $_FILES['image']['name'];
        $target_file = $target_dir . $image;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //determine file extension      

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $invalidImage = "Image must be in the format of JPG, PNG, or JPEG only!";
            $invalid = 1;
        }
        //Size should be under  5242880 bytes / 5MB
        if (filesize($_FILES['image']['tmp_name']) > $maxFileSize) {
            $invalidImage = "Image too large !";
            $invalid = 1;
        }
        //Move picture to folder
        if ($invalid == 0) {
            $target_dir = "images/";
            $image = $_FILES['image']['name'];
            $target_file = $target_dir . $image;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $openFolder = "Succesfully upload into folder !";
            } else {
                $openFolder = "Failed to upload!";
            }
        }
    }

    if ($empty == 0 && $invalid == 0) {

        $connect = new mysqli('localhost', 'root', '', 'foongli');   //connect database
        if ($connect->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        $checking = "SELECT * FROM products_table WHERE productID='$id'";
        $checkResult = mysqli_query($connect, $checking);
        if (mysqli_num_rows($checkResult) != 0) { //check if productID clashed or already exist in the table
            $msg = "Product already exists !";
        } else {
            //Insert new product and values to the table
            $insert1 = "insert into products_table(productID, categoryID, price, image)Values('{$productID}', '{$name}','{$categoryID}',  '{$price}', '{$image}')";
            $check = $connect->query($insert1);
            if ($check) {
                echo "<script type='text/javascript'>alert('Add succesfully !')</script>";
            } else {// Validate, show msg if there's error, should be fine 
                $msg = "Error ! ";
            }
        }
        $connect->close();
    }
}
?>

<form class="form-horizontal" enctype="multipart/form-data" method="post" section="<?php echo $_SERVER['PHP_SELF'] ?>">
    <fieldset>

        <!-- Form Name -->
        <legend style="text-align:center; font-size: 40px; "><b>ADD PRODUCTS</b></legend>

        <!-- Text input-->
        <span class="error"><?php echo $msg; ?></span>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="id">PRODUCT ID</label>
            <div class="col-md-4">
                <input id="product_name" name="id" maxlength="" placeholder="BZ001 / DS002" class="form-control input-md" value="<?php echo $id ?>" type="text">
                <span class="error"><?php echo $invalidID; ?></span>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="price">PRODUCT CATEGORY</label>
            <div class="col-md-4">
                <select class="form-control input-md" name="cat">
                    <option value="DimSum" <?php if ($cat == "DimSum") {
                                                echo 'selected';
                                            } ?>>Dim Sum</option>
                    <option value="BaoZi" <?php if ($cat == "BaoZi") {
                                                echo 'selected';
                                            } ?>>Bao Zi</option>
                </select>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="quantity">PRODUCT PRICE (RM)</label>
            <div class="col-md-4">
                <input id="quantity" name="price" value="<?php echo $price ?>" min="0" max="1000" placeholder="20" class="form-control input-md" type="text">
                <span class="error"><?php echo $invalidPrice; ?></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="quantity">DESCRIPTION</label>
            <div class="col-md-4">
                <input id="quantity" name="desc" value="<?php echo $desc; ?>" placeholder="Description" class="form-control input-md" type="text">
                <span class="error"><?php echo $invalidDesc; ?></span>
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
                <input class="submit" type="submit" name="submit" value="Submit">
                <input class="reset" type="reset" name="reset" value="Reset">
            </div>
        </div>
        <div class="button">
            [<a href="productManage.php">Manage Product</a>]
        </div>

    </fieldset>
</form>