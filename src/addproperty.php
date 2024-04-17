<?php
session_start();
if(!isset($_SESSION['username'])){
	header('Location: login.php');
}
$profilepic = $_SESSION["pfp"];
?>
<?php
class propertyAdd{
    public $propertyType;
    public $propertyName;
    public $location;
    public $roomType;
    public $propertyAddr;
    public $propOwnName;
    public $propOwnPhone;
    public $propOwnValid;
    public $manageName;
    public $managephone;
    public $manageValid;
    public $rentPrice;
    public $ameni;
    public $localeurl;
	public $depositamt;

    private function sanitize($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function __construct($type, $pName, $loca, $rt, $propaddr, $pon, $pop, $pov, $mn, $mp, $mv, $rp, $ame, $lu, $dp)
    {
        $this->propertyType = $this->sanitize($type);
        $this->propertyName = $this->sanitize($pName);
        $this->location = $this->sanitize($loca);
        $this->roomType = $this->sanitize($rt);
        $this->propertyAddr = $this->sanitize($propaddr);
        $this->propOwnName = $this->sanitize($pon);
        $this->propOwnPhone = $this->sanitize($pop);
        $this->propOwnValid = $this->sanitize($pov);
        $this->manageName = $this->sanitize($mn);
        $this->managephone = $this->sanitize($mp);
        $this->manageValid = $this->sanitize($mv);
        $this->rentPrice = $this->sanitize($rp);
        $this->ameni = $ame;
        $this->localeurl = $this->sanitize($lu);
		$this->depositamt = $this->sanitize($dp);
    }
}

function propPhotoSet($content, $propidpass) : bool{
	global $errors, $photosurl;
	if(mkdir("$propidpass")){
		$target_dir = "$propidpass/";
		$uploadcheck = true;

		for($i = 0; $i < sizeof($content['name']); $i++){
			if(empty($content['tmp_name'][$i])){
				break;
			}
			$target_file = $target_dir . basename($content['name'][$i]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$check = getimagesize($content["tmp_name"][$i]);

			if($check !== false) {
				$uploadcheck = true;
			  } else {
				echo "<script>alert('File is not an image.');</script>";
				$uploadcheck = false;
			  }
			if (file_exists($target_file)) {
				echo "<script>alert('Sorry, file already exists.');</script>";
				$uploadcheck = false;
			  }
			  if ($content["size"][$i] > 50000000) {
				echo "<script>alert('Sorry, your file is too large.')</script>";
				$uploadcheck = false;
			  }
			  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
  				echo "<script>alert('Sorry, only JPG, JPEG and PNG images are allowed.');</script>";
  				$uploadcheck = false;
			  }

			  if(!$uploadcheck){
				echo"<script>alert('Please upload files again');</script>";
				return false;
			  }
			  else{
				if (move_uploaded_file($content["tmp_name"][$i], $target_file)) {
					echo "<script>alert('The file ". htmlspecialchars( basename( $content["name"][$i])). " has been uploaded.')</script>";
					array_push($photosurl, $target_file);
				  } else {
					echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
					return false;
				  }
			  }
		}
		return true;
	}
	else{
		array_push($errors, "Failed to create folder");
		return false;
	}
}

$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "property_manage";

$conn = new mysqli($hostname, $username, $password, $database);
if($conn->connect_error){
	die("Failed to connect to database" . $conn->connect_error);
}

$checkamenities = [];
$checkcreate = true;
$errors = array();
$photosurl = array();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["amenities"])){
        $checkamenities = $_POST["amenities"];
		$checkamenities = implode("," ,$checkamenities);
    }
    else{
        $checkamenities = "";
    }
    if(empty($_POST["propertytype"])){
        array_push($errors, "Property Type not set");
		$checkcreate = false;
    }
    if(empty($_POST["propertyname"])){
        array_push($errors, "Property Name not set");
		$checkcreate = false;
    }
    if(empty($_POST["location"])){
        array_push($errors, "Property Location not set");
		$checkcreate = false;
    }
    if(empty($_POST["roomtype"])){
        array_push($errors, "Property Room Type not set");
		$checkcreate = false;
    }
    if(empty($_POST["propertyaddr"])){
        array_push($errors, "Property Address not set");
		$checkcreate = false;
    }
    if(empty($_POST["owner"])){
        array_push($errors, "Owner Name not set");
		$checkcreate = false;
    }
    if(empty($_POST["ownerphone"])){
        array_push($errors, "Owner Phone not set");
		$checkcreate = false;
    }
	else if(!preg_match(("/^\d{10}$/"), htmlspecialchars($_POST["ownerphone"])) && empty($_POST["ownerphone"])){
		array_push($errors, "Please enter a valid phone number");
		$checkcreate = false;
	}
    if(empty($_POST["managename"])){
        array_push($errors, "Manage Name not set");
		$checkcreate = false;
    }
    if(empty($_POST["managephone"])){
        array_push($errors, "Manage Phone not set");
		$checkcreate = false;
    }
	else if(!preg_match(("/^\d{10}$/"), htmlspecialchars($_POST["managephone"])) && empty($_POST["ownerphone"])){
		array_push($errors, "Please enter a valid phone number");
		$checkcreate = false;
	}

    if(empty($_POST["rentprice"])){
        array_push($errors, "Rent Price not set");
		$checkcreate = false;
    }
	if(empty($_POST["depositprice"])){
		array_push($errors, "Deposit Price not set");
		$checkcreate = false;
	}
    if(empty($_POST["localeurl"])){
        array_push($errors, "Location URL not set");
		$checkcreate = false;
    }
    if($checkamenities == ""){
        array_push($errors, "Amenities not set");
		$checkcreate = false;
    }
	
	if(!empty($_POST["ownervalid"])){
		if(!preg_match(("/^\d{12}$/"), htmlspecialchars($_POST["ownervalid"]))){
			array_push($errors, "Aadhar number invalid");
			$checkcreate = false;
		}
	}
	if(!empty($_POST["managevalid"])){
		if(!preg_match(("/^\d{12}$/"), htmlspecialchars($_POST["managevalid"]))){
			array_push($errors, "Aadhar number invalid");
			$checkcreate = false;
		}
	}
	if(!isset($_FILES["propertyphotos"])){
		array_push($errors, "Submit atleast one photo of the property");
		$checkcreate = false;
	}

	if($checkcreate){
		$addPropObj = new propertyAdd(
			$_POST["propertytype"], 
			$_POST["propertyname"],
			$_POST["location"],
			$_POST["roomtype"],
			$_POST["propertyaddr"],
			$_POST["owner"],
			$_POST["ownerphone"],
			$_POST["ownervalid"],
			$_POST["managename"],
			$_POST["managephone"],
			$_POST["managevalid"],
			$_POST["rentprice"],
			$checkamenities,
			$_POST["localeurl"],
			$_POST["depositprice"]
		);

		$sql = "INSERT INTO property_data (property_type, property_name, 
			location, room_type, propertyaddr, owner, owner_phone, owner_valid, manager_name, manage_phone,
			manage_valid, rent_price, amenities, location_url, deposit_amt, photos_url)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

		$tmp_photo = "";
		$sqlprep = $conn->prepare($sql);
		$sqlprep->bind_param("ssssssissisissis", 
			$addPropObj->propertyType,
			$addPropObj->propertyName,
			$addPropObj->location,
			$addPropObj->roomType,
			$addPropObj->propertyAddr,
			$addPropObj->propOwnName,
			$addPropObj->propOwnPhone,
			$addPropObj->propOwnValid,
			$addPropObj->manageName,
			$addPropObj->managephone,
			$addPropObj->manageValid,
			$addPropObj->rentPrice,
			$addPropObj->ameni,
			$addPropObj->localeurl,
			$addPropObj->depositamt,
			$tmp_photo
		);
		$sqlprep->execute();
		$sqlprep->close();
		echo"<script>alert('Property Added Successfully');</script>";

		$last_insert = $conn->insert_id;
		if(propPhotoSet($_FILES['propertyphotos'], $last_insert)){

			$photosurl = implode(",", $photosurl);
			$sqladd = "UPDATE property_data SET photos_url = '$photosurl' WHERE id = '$last_insert';";
			$conn->query($sqladd);
			$conn->close();
			echo "<script>window.location = 'viewpropertybig.php?id=" . $last_insert . "'</script>";
		}
		else{
			$sqldel = "DELETE FROM property_data WHERE id = (SELECT id FROM ( SELECT id FROM property_data WHERE id = (SELECT MAX(id) FROM property_data))AS temp);";
			$resultdel = $conn->query($sqldel);
		}
	}
	else{
		echo"<script>alert('Errors Occured. Resolve errors and try again');</script>";
	}
	
	$conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Add Property</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="custom.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Lumino</span>Admin</a>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-envelope"></em><span class="label label-danger">15</span>
					</a>
						<ul class="dropdown-menu dropdown-messages">
							<li>
								<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
									<img alt="image" class="img-circle" src="">
									</a>
									<div class="message-body"><small class="pull-right">3 mins ago</small>
										<a href="#"><strong>John Doe</strong> commented on <strong>your photo</strong>.</a>
									<br /><small class="text-muted">1:24 pm - 25/03/2015</small></div>
								</div>
							</li>
							<li class="divider"></li>
							<li>
								<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
									<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
									</a>
									<div class="message-body"><small class="pull-right">1 hour ago</small>
										<a href="#">New message from <strong>Jane Doe</strong>.</a>
									<br /><small class="text-muted">12:27 pm - 25/03/2015</small></div>
								</div>
							</li>
							<li class="divider"></li>
							<li>
								<div class="all-button"><a href="#">
									<em class="fa fa-inbox"></em> <strong>All Messages</strong>
								</a></div>
							</li>
						</ul>
					</li>
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-bell"></em><span class="label label-info">5</span>
					</a>
						<ul class="dropdown-menu dropdown-alerts">
							<li><a href="#">
								<div><em class="fa fa-envelope"></em> 1 New Message
									<span class="pull-right text-muted small">3 mins ago</span></div>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-heart"></em> 12 New Likes
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-user"></em> 5 New Followers
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="<?php echo $profilepic;?>" class="img-responsive" alt="">
			</div>
			
			<div class="divider"></div>
			<div class="clear"></div>
		</div>

		

		
		<!--
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		-->
		<ul class="nav menu">
			<li><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<!--
			<li><a href="widgets.html"><em class="fa fa-calendar">&nbsp;</em> Widgets</a></li>
			<li><a href="charts.html"><em class="fa fa-bar-chart">&nbsp;</em> Charts</a></li>
			<li><a href="elements.html"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>
			<li><a href="panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>
			-->
			<li class="parent actice"><a data-toggle="collapse" href="#sub-item-1" aria-expanded="true">
				<em class="fa fa-home fa-minus">&nbsp;</em> Property <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus fa-minus"></em></span>
				</a>
				<ul class="children collapse in" id="sub-item-1" aria-expanded="true">
					<li class="active"><a class="active" href="addproperty.php">
						<span class="fa fa-address-book">&nbsp;</span> Add Property
					</a></li>
					<li><a class="" href="viewproperty.php">
						<span class="fa fa-street-view">&nbsp;</span> View Property
					</a></li>
				</ul>
			</li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-bookmark">&nbsp;</em> Bookings <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li><a class="" href="createbooking.php">
						<span class="fa fa-thumb-tack">&nbsp;</span> Create Booking
					</a></li>
					<li><a class="" href="viewbooking.php">
						<span class="fa fa-address-card">&nbsp;</span> View Bookings
					</a></li>
				</ul>
			</li>
			<li><a href="feedback_display.php"><em class="fa fa-comment">&nbsp;</em> Feedback</a></li>
			<a class="link-fix-2" href="logout.php"><button class="btn-fix-2">Logout</button></a>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					Dashboard
				</a></li>
				<li class="active">Add Property</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header head-fix-1">Add New Property</h1>
			</div>
		</div><!--/.row-->
		<div class="error-section-1">
			<p><?php echo(implode("<br>", $errors));?></p>
		</div>
		<!-- form area -->
    <form class="form-format-1" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		<div class="outer-sub-1">
			<h3> Property Details </h3>
			<p>Enter Property address with landmark.</p>
			<div class="sub-section-1">
            <div class="form-group  prop-type form-format-1">
			    <label>What is the property like?</label>
			    <select class="form-control" name="propertytype">
					<option></option>
				    <option>Villa / Bungalow</option>
				    <option>Flat / Apartment</option>
				    <option>Hotel</option>
			    </select>
		    </div>
            <div class="form-group prop-type">
				<label>Name of the property</label>
				<input class="form-control" placeholder="Enter the property name" type="text" name="propertyname">
			</div>
            <div class="form-group  prop-type">
			    <label>General property location</label>
			    <select class="form-control" name="location">
				    <option></option>
				    <option>Lonavala</option>
				    <option>Panshet</option>
                    <option>Mavali</option>
                    <option>Karjat</option>
                    <option>Pauna</option>
                    <option>Mahabaleshwar</option>
                    <option>Goa</option>
                    <option>Alibag</option>
			    </select>
		    </div>
            <div class="form-group  prop-type">
			    <label>How big is the property</label>
			    <select class="form-control" name="roomtype">
				    <option></option>
				    <option>1RK</option>
				    <option>1BHK</option>
                    <option>2BHK</option>
                    <option>3BHK</option>
                    <option>4BHK</option>
                    <option>5BHK</option>
                    <option>6BHK</option>
                    <option>7BHK</option>
                    <option>8BHK</option>
                    <option>9BHK</option>
                    <option>10BHK</option>
			    </select>
		    </div>
			<div class="form-group prop-type">
				<label>Property address (include pin-code)</label>
				<input class="form-control" placeholder="Property Address" type="text" name="propertyaddr" required>
			</div>
            <div class="form-group prop-type">
				<label>Property owner name</label>
				<input class="form-control" placeholder="Owner Name" type="text" name="owner" required>
			</div>
            <div class="form-group prop-type">
				<label>Property owner phone number</label>
				<input class="form-control" placeholder="Owner Phone Number" type="tel" name="ownerphone" 
					pattern="[6-9]{1}[0-9]{9}" title="Please enter valid phone number" required="">
			</div>
            <div class="form-group prop-type">
				<label>Property owner Aadhar or Pan card number</label>
				<input class="form-control" placeholder="Valid Number" type="text" name="ownervalid">
			</div>
			<div class="form-group prop-type">
				<label>Estimated property rent amount</label>
				<input class="form-control" placeholder="Price in Rupees" type="text" name="rentprice">
			</div>
			<div class="form-group prop-type">
				<label>Estimated deposit amount</label>
				<input class="form-control" placeholder="Price in Rupees" type="text" name="depositprice">
			</div>
			<div class="form-group prop-type">
				<label>Amenities at the property</label>
				<div class="ame-box-1">
					<div class="checkbox">
						<label class="checkbox-good">
							<input type="checkbox" value="Swimming Pool" name="amenities[]">Swimming Pool
						</label>
					</div>
					<div class="checkbox">
						<label class="checkbox-good">
							<input type="checkbox" value="Mini Garden" name="amenities[]">Mini Garden
						</label>
					</div>
			        <div class="checkbox">
						<label class="checkbox-good">
							<input type="checkbox" value="Kitchen Equipments" name="amenities[]">Kitchen Equipments
						</label>
					</div>
					<div class="checkbox">
						<label class="checkbox-good">
							<input type="checkbox" value="WiFi" name="amenities[]">WiFi
					    </label>
					</div>
					<div class="checkbox">
						<label class="checkbox-good">
							<input type="checkbox" value="Air Conditioning" name="amenities[]">Air Conditioning
					    </label>
					</div>
				</div>
			</div>
				<div class="form-group prop-type">
					<label>Location URL</label>
					<input class="form-control" placeholder="Enter google maps location url of the property" type="url" name="localeurl"><br>
				</div>
				<div>
						<div>
							<label for="propertyphotos">Add property photos</label>
							<p> Add atleast one photo of the property (maximum 5 photos) </p>
						</div>

						<div class="outer-box-1">
							<div class="inner-box-1">
								<label for="propertyphoto1" class="fancy-file-upload">
									Upload first photo
								</label>
								<br>
								<input type="file" name="propertyphotos[]" id="propertyphoto1" accept="image/png, image/jpeg, image/jpg" required>
								<img id="propphoto1" src="#" alt="First photo preview" class="capped-preview">
							</div>

							<div class="inner-box-1">
								<label for="propertyphoto2" class="fancy-file-upload">
									Upload second photo
								</label>
								<br>
								<input type="file" name="propertyphotos[]" id="propertyphoto2" accept="image/png, image/jpeg, image/jpg">
								<img id="propphoto2" src="#" alt="Second photo preview" class="capped-preview">
							</div>

							<div class="inner-box-1">
								<label for="propertyphoto3" class="fancy-file-upload">
									Upload third photo
								</label>
								<br>
								<input type="file" name="propertyphotos[]" id="propertyphoto3" accept="image/png, image/jpeg, image/jpg">
								<img id="propphoto3" src="#" alt="Third photo preview" class="capped-preview">
							</div>
						</div>
						<div class="outer-box-1">
							<div class="inner-box-1">
								<label for="propertyphoto4" class="fancy-file-upload">
									Upload fourth photo
								</label>
								<br>
								<input type="file" name="propertyphotos[]" id="propertyphoto4" accept="image/png, image/jpeg, image/jpg">
								<img id="propphoto4" src="#" alt="Fourth photo preview" class="capped-preview">
							</div>
							<div class="inner-box-1">
								<label for="propertyphoto5" class="fancy-file-upload">
									Upload fifth photo
								</label>
								<br>
								<input type="file" name="propertyphotos[]" id="propertyphoto5" accept="image/png, image/jpeg, image/jpg">
								<img id="propphoto5" src="#" alt="Fifth photo preview" class="capped-preview">
							</div>
							<br>
						</div>
				</div>
			</div>	
		<h3> Property Manager Details </h3>
			<div class="sub-section-1">
            	<div class="form-group prop-type">
					<label>Property manager name</label>
					<input class="form-control" placeholder="Name" type="text" name="managename">
				</div>
            	<div class="form-group prop-type">
					<label>Property manager phone number</label>
					<input class="form-control" placeholder="Address" type="tel" name="managephone" 
					pattern="[6-9]{1}[0-9]{9}" title="Please enter valid phone number" required="">
				</div>
            	<div class="form-group prop-type">
					<label>Property manager Aadhar or Pan card number</label>
					<input class="form-control" placeholder="Number" type="text" name="managevalid">
				</div>
			</div>
			<div class="submit-btn-2">
				<input class="input-btn-1" type="submit" value="Add Property">
				<input class="input-btn-1" type="button" value="Cancel" onclick="window.location.reload()">
			</div>
		</div>
	</div>
</form>
        <!-- end -->	
			<?php include "footer.php";?>
		</div><!--/.row-->
	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		function readURL(input) {
    		if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#propphoto1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    	}
		}
		$("#propertyphoto1").change(function(){
    		readURL(this);
		});

    	function readURL2(input) {
    		if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#propphoto2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    	}
		}
		$("#propertyphoto2").change(function(){
    		readURL2(this);
		});

		function readURL2(input) {
    		if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#propphoto3').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    	}
		}
		$("#propertyphoto3").change(function(){
    		readURL2(this);
		});

		function readURL2(input) {
    		if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#propphoto4').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    	}
		}
		$("#propertyphoto4").change(function(){
    		readURL2(this);
		});

		function readURL2(input) {
    		if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#propphoto5').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    	}
		}
		$("#propertyphoto5").change(function(){
    		readURL2(this);
		});
	</script>
		
</body>
</html>

