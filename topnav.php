    <?php
ob_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Fixed top navbar example · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/navbar-fixed/">
   
    <!-- Bootstrap core CSS -->
    <link href="bs/bootstrap.css" rel="stylesheet" type="text/css"/>

<style>
.logo{
 margin-left:-10px;
}
.dropDown:hover .dropdown-content{
 display: block;           
}
    
.dropDown .dropdown-content a:hover {
 text-decoration: none;
 background-color: #cccccc;
 color: black;
 }

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px; 
  display: block;
  text-align: left;
}

.dropdown-subCat1{
  margin-top:-26%;
  margin-left:185px;
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}   
.dropdown-subCat2{
  margin-top:-26%;
  margin-left:185px;
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}   
.dropdown-subCat3{
  margin-top:-26%;
  margin-left:185px;
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}   
.dropdown-subCat4{
  margin-top:-26%;
  margin-left:185px;
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}   

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
    
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
 <?php 
 session_start();
$search="";
if(isset($_POST['submit'])){ // sends keyword
    $search=$_POST['search'];      
    header("Location:searchResult.php?search=$search");         
}
?> 
<link href="navbartop.css" rel="stylesheet" type="text/css"/>

  </head>
  <body>
   
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  
      <a class="navbar-brand" href="index.php">Foong Li</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
   
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="AboutUs.php">About Us</a>
        </li>
        
        <div class="dropDown">
         <li class="nav-item">
         <a href="allProd.php" class="nav-link dropdown-toggle">Product</a>
             <div class="dropdown-content">
                     <div>
                     <a href="productCat.php?Cat=BaoZi">Bao Zi</a>
                     </div>
                     <div>
                     <a href="productCat.php?Cat=DimSum">Dim Sum</a>
                     </div>                 
            </div>
        </li>
        </div>
    
         <li class="nav-item">
             <a class="nav-link" href="shopcart.php">Shopping Cart</a>
        </li>
        
     <div class="dropDown">
            <li class="nav-link dropdown-toggle">Profile</li>
             <div class="dropdown-content">
                  <a href='userLogOut.php'>Edit Profile </a>
                 <a href='userLogOut.php'>Log Out</a>
                
            </div> 
        </div>
     
      </ul>
<!--        <form class="form-inline mt-2 mt-md-0" method="post" section='<?php echo $_SERVER['PHP_SELF']?>'>
            
        <?php
            echo "     <a class='nav-link disabled'   tabindex='-1'   >{$_SESSION["clientUsername"]}</a>";
        ?>
        <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" name="submit" type="submit">Search</button>
      </form>-->
    </div>
  </nav>




  </body>
</html>
