<?php
session_start();
if(!isset($_SESSION['username'])){
	header('Location: login.php');
}
$profilepfp = $_SESSION['pfp'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - View More Details</title>
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
									<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
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
				<img src="<?php echo $profilepfp; ?>" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo($_SESSION['username']);?></div>
				
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
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
			<li class="parent actice"><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Property <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li class="active"><a class="" href="addproperty.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Add Property
					</a></li>
					<li><a class="" href="viewproperty.php">
						<span class="fa fa-arrow-right">&nbsp;</span> View Property
					</a></li>
				</ul>
			</li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-navicon">&nbsp;</em> Bookings <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li><a class="" href="createbooking.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Create Booking
					</a></li>
					<li><a class="" href="viewbooking.php">
						<span class="fa fa-arrow-right">&nbsp;</span> View Bookings
					</a></li>
				</ul>
			</li>
			<li><a href="feedback_display.php"><em class="fa fa-comment">&nbsp;</em> Feedback</a></li>
			<a class="link-fix-2" href="logout.php"><button class="btn-fix-2">Logout</button></a>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					Dashboard
				</a></li>
				<li><a href="viewproperty.php">
					View Property
				</a></li>
				<li class="active">View More Details</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Property Details</h1>
			</div>
		</div><!--/.row-->

<?php
// Database connection
$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "property_manage";

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM property_data WHERE id = $id"; 
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
		echo "<form class='form-format-1' role='form'>";
		echo "<div class='outer-sub-1'>";
        echo "<h3>Property Details</h3>";
		echo "<div class='sub-section-1'>";

		echo "<div class='form-group  prop-type form-format-1'>";
        echo "<label for='property_type'>Property Type:</label><br>";
        echo "<input class='form-control' type='text' id='property_type' name='property_type' value='" . $row["property_type"] . "'readonly><br>";
		echo "</div>";

		echo "<div class='form-group prop-type'>";
        echo "<label for='property_name'>Property Name:</label><br>";
        echo "<input class='form-control' type='text' id='property_name' value='".$row["property_name"]."'readonly><br>";
		echo "</div>";

		echo "<div class='form-group prop-type'>";
        echo "<label for='location'>Location:</label><br>";
        echo "<input class='form-control' type='text' id='location' value='".$row["location"]."'readonly><br>";
		echo "</div>";

		echo "<div class='form-group prop-type'>";
        echo "<label for='room_type'>Room Type:</label><br>";
        echo "<input class='form-control' type='text' id='room_type' name='room_type' value='" . $row["room_type"] . "'readonly><br>";
		echo "</div>";

		echo "<div class='form-group prop-type'>";
        echo "<label for='location'>Property Address:</label><br>";
        echo "<input class='form-control' type='text' id='propertyaddr' name='propertyaddr' value='" . $row["propertyaddr"] . "'readonly><br>";
		echo "</div>";

		echo "<div class='form-group prop-type'>";
        echo "<label for='propertyaddr'>Property Owner Name:</label><br>";
        echo "<input class='form-control' type='text' id='owner' name='owner' value='" . $row["owner"] . "'readonly><br>";
		echo "</div>";

		echo "<div class='form-group prop-type'>";
        echo "<label for='rent_price'>Owner Phone:</label><br>";
        echo "<input class='form-control' type='text' id='owner_phone' name='owner_phone' value='" . $row["owner_phone"] . "'readonly><br>";
		echo "</div>";

		echo "<div class='form-group prop-type'>";
        echo "<label for='rent_price'>Owner Aadhar Number:</label><br>";
        echo "<input class='form-control' type='text' id='owner_valid' name='owner_valid' value='" . $row["owner_valid"] . "'readonly><br>";
		echo"</div>";

		echo "<div class='form-group prop-type'>";
        echo "<label for='rent_price'>Property Manager Name:</label><br>";
        echo "<input class='form-control' type='text' id='manager_name' name='manager_name' value='" . $row["manager_name"] . "'readonly><br>";
		echo "</div>";

		echo "<div class='form-group prop-type'>";
        echo "<label for='rent_price'>Property Manager Phone:</label><br>";
        echo "<input class='form-control' type='text' id='manage_phone' name='manage_phone' value='" . $row["manage_phone"] . "'readonly><br>";
		echo "</div>";

		echo "<div class='form-group prop-type'>";
        echo "<label for='rent_price'>Manager Aadhar Number:</label><br>";
        echo "<input class='form-control' type='text' id='manage_valid' name='manage_valid' value='" . $row["manage_valid"] . "'readonly><br>";
		echo "</div>";

		echo "<div class='form-group prop-type'>";
        echo "<label for='rent_price'>Property Rent Price:</label><br>";
        echo "<input class='form-control' type='text' id='rent_price' name='rent_price' value='" . $row["rent_price"] . "'readonly><br>";
		echo "</div>";

		echo "<div class='form-group prop-type'>";
        echo "<label for='rent_price'>Available Amenities</label><br>";
        echo "<input class='form-control' type='text' id='amenities' name='amenities' value='" . $row["amenities"] . "'readonly><br>";
		echo "</div>";

		echo "<div class='form-group prop-type'>";
        echo "<label for='rent_price'>Property Location URL</label><br>";
        echo "<input class='form-control' type='text' id='location_url' name='location_url' value='" . $row["location_url"] . "'readonly><br>";
		echo "</div>";

		echo "<div class='form-group prop-type'>";
		echo "<label>Property Photos</label><br>";
		echo "<div class='photo-big-1'>";
		if(!$row['photos_url']){
			echo"<p>No photos found</p>";
		}
		else{
			$prop_photos = explode(',', $row['photos_url']);
			foreach($prop_photos as $pp){
				echo"<img src=$pp><br>";
			}
		}
		echo "</div>";
		echo "</div>";

		echo "</div>";
		echo "</div>";
		echo "</form>";
		
    } else {
        echo "No property found with ID: $id";
    }
} else {
    echo "No property ID specified";
}

$conn->close();
?>

		
		</div><!--/.row-->
	</div>	<!--/.main-->
	<?php include "footer.php";?>
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
		
</body>
</html>

