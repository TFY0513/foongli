<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="bs/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<title>Add Products</title>
<style>
    .error{
        color: red;
    }
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
session_start();
include 'checkLogin.php';
include 'inactivityDetect.php';
include 'database.php';

//Initialize values
$invalidName = $invalidPrice = $invalidCat = $invalidImage = $invalidDesc = $msg = "";
$id = $cat = $desc = "";
$price = 0.0;
$ext = "";
$empty = 0;
$invalid = false;

if (isset($_POST['submit'])) {

    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $catID = $_POST["cat"];

    if (!preg_match('/(?<price>(\d+((\.|\,)\d+)+))/', $_POST['price'])) {    //Digit only
        $invalidPrice = "Invalid Price !";
        $invalid = true;
    } else {
        $price = $_POST['price'];
    }


    $maxFileSize = 10 * 1024 * 1024; //10mb
    $image = $_FILES["image"];

    $info = getimagesize($image["tmp_name"]);
    if (!$info) {//not an image
        $invalidImage = "Invalid image !";
        $invalid = true;
    } else {
        //  echo $image["size"];
        if ($image["size"] > $maxFileSize) {//image size
            $invalidImage = "Image size too large !";
            $invalid = true;
        } else {
            $allowed = array('jpeg', 'png', 'jpg');

            $filename = $_FILES['image']['name'];

            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            if (!in_array($ext, $allowed)) {//image extennsion
                $invalidImage = "Invalid image type/extension !";
                $invalid = true;
            }
        }
    }


    if (!$invalid) {
        // $blob = addslashes(file_get_contents($_FILES['image']['tmp_name']));
//$blob = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
        $blob = base64_encode(file_get_contents(addslashes($_FILES['image']['tmp_name'])));

        $stmt = $database->prepare("insert into products_table(name, categoryID, price, image, extension)Values(?, ?, ?, ?, ?)");
        $stmt->bind_param("sidss", $name, $catID, $price, $blob, $ext);

        $stmt->execute();

        echo "<script type='text/javascript'>    alert('New products adde !')</script>";
        $stmt->close();
    }
    $database->close();
}
?>

<form class="form-horizontal" enctype="multipart/form-data" method="post" section="<?php echo $_SERVER['PHP_SELF'] ?>">
    <fieldset>

        <!-- Form Name -->
        <legend style="text-align:center; font-size: 40px; "><b>ADD PRODUCTS</b></legend>

        <!-- Text input-->
        <span class="error"><?php echo $msg; ?></span>

        <div class="form-group">
            <label class="col-md-4 control-label" for="quantity">PRODUCT NAME</label>
            <div class="col-md-4">
                <input id="quantity" name="name" value="" maxlength="60" placeholder="XXXX" required class="form-control input-md" type="text">
                <span class="error"><?php echo $invalidName; ?></span>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label">PRODUCT CATEGORY</label>
            <div class="col-md-4">

                <select class="form-control input-md" name="cat">
                    <?php
                    $stmt = "select * from category_table";
                    $result = $database->query($stmt);

                    if ($result) {

                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['categoryID']}'>{$row['categoryName']}</option>";
                        }
                    }
                    ?>

                </select>
            </div>
        </div>



        <div class="form-group">
            <label class="col-md-4 control-label" for="quantity">PRODUCT PRICE (RM)</label>
            <div class="col-md-4">
                <input id="quantity" name="price" value=""  placeholder="XX.XX"  required class="form-control input-md" type="text">
                <span class="error"><?php echo $invalidPrice; ?></span>
            </div>
        </div>



        <div class="form-group">
            <label class="col-md-4 control-label" for="image">UPLOAD IMAGE</label>
            <div class="col-md-4">
                <input class="image" type="file" id="image"   required name="image">
                <span><b>*only jpg, jpeg, png allowes<br/>*maximum size is 10 MB</b></span>
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

<?php
$database->close();
?>