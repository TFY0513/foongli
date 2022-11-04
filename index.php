<?php
session_start();
//Homepage/ Start of everything
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Jekyll v4.0.1">
	<title>Homepage</title>

	<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">

	<link href="bs/bootstrap.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Home</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale =1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
	<?php
	include 'topnav.php';
	?>
	<div class="header">
		<h2 class="title">Home Page</h2>
	</div>
	<div class="container">
		<img src=Bun/home3.jfif alt="" style="max-height: 480px;width: 100%;">
		<div class="content">
			<p>The FOONG LI BAO DIAN is a Chinese traditional baozi making allocated at Kedah.</p>
			<p>The product served by FOONG LI BAO DIAN include various of Chinese traditional baozi, dim sum as well to. Normally FOONG LI BAO DIAN is a local baozi supplier for the street stall, restaurant and also religion activity as well, but regular customer purchase is also welcome at FOONG LI BAO DIAN. </p>
		</div>
	</div>
	<hr class="divider">
	<div class="row">
		<div class="col-md-6"><img src="Bun/home1.jpg" style="max-height: 360px;width: 100%"> </div>
		<div class="content col-md-6">
			<p>The FOONG LI BAO DIAN is the one who intent to provide high quality baozi for every customer. The brand of FOONG LI will keep following 3 rules : delious food, high quality material and sanitation of the business place to ensure that every customer can have the wellness product on their hand. </p>
		</div>
	</div>
	<hr class="divider">
	<h2 class="text-md-center">Product category</h2>
	<div class="row">

		<div class="content col-md-6"> <img src="Bun/home6.jpg" style="max-height: 360px;width: 100%">
			<p class="text-center"> Preview our handmade traditional baozi</p>
			<a class="btn-lg btn-primary text-center" href="productCat.php?Cat=BaoZi">Baozi</a>
		</div>
		<div class="content col-md-6"> <img src="Bun/home1.png" style="max-height: 360px;width: 100%">
			<p class="text-center"> Preview our handmade dimSum</p>
			<a class="btn-lg btn-primary text-center" href="productCat.php?Cat=DimSum">Dimsum</a>
		</div>
	</div>
</body>
<?php
include 'footer.php';
?>
</html>