<?php
session_start();
if(!isset($_SESSION['username'])){
	header('Location: login.php');
}
$profilepfp = $_SESSION['pfp'];
?>
<?php

$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "property_manage";

$conn = new mysqli($hostname, $username, $password, $database);
$errors = array();

if($conn->connect_error){
	die("Failed to connect to database" . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$bookid = htmlspecialchars($_POST["bookingid"]);

	$sql = "SELECT * FROM bookings WHERE booking_id = '$bookid'";
	$result = $conn->query($sql);
	
	$row = $result->fetch_array();

	$sql2 = "UPDATE bookings SET checkout_check='Yes' WHERE booking_id='$bookid'";
	$result2 = $conn->query($sql2);
	$_checkoutcheck = "Yes";
	echo'<script>alert("Customer Checked Out Successfully!")</script>';
	//header("Location: viewbooking.php");
	/*
	$sql2 = "SELECT * FROM bookings WHERE booking_id='$bookid'";
	$result2 = $conn->query($sql2);
	$row2 = $result2->fetch_assoc();
	$_checkoutcheck = $row2["checkout_check"]; 
	*/
}

else{
	if(isset($_GET['booking_id'])){
		$bookingid = htmlspecialchars($_GET['booking_id']);
	}
	
	$sql = "SELECT * FROM bookings WHERE booking_id = '$bookingid'";
	$result = $conn->query($sql);
	
	$_sql = "SELECT checkout_check FROM bookings WHERE booking_id='$bookingid'";
	$_result = $conn->query($_sql);
	$_row = $_result->fetch_assoc();
	$_checkoutcheck = $_row["checkout_check"];
	
	if($result->num_rows>0){
		$row = $result->fetch_array();
	}
	else{
		array_push($errors, "No record found");
		$row = [
			"property_book_id"=>"",
			'book_name'=>"",
			'book_phone'=>"",
			'book_valid'=>"",
			'booking_type'=>"",
			'check_in_date'=>"",
			'check_out_date'=>"",
			'pay_total'=>"",
			'pay_deposit'=>"",
			'pay_remaining'=>"",
			'payment_type'=>"",
			'referral_name'=>"",
			'referral_number'=>"",
			'pay_advance'=>"" 
		];
	}
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Dashboard</title>
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
	<script>
		function confirmCheckout(){
			var checkout = confirm("Is the pending amount paid to checkout this person ?");
			if(checkout){
				document.getElementById("checkoutform").submit();
			}
		}

		window.onload = function(){
			checkCheckoutStatus();
		}

		function checkCheckoutStatus(){
			var status = document.getElementById("checkoutstatus");
			var checkoutBtn = document.getElementById("checkoutbtn");

			if(status.value == "Yes"){
				checkoutBtn.disabled = true;
			}
			else{
				checkoutBtn.disabled = false;
			}
		}
	</script>
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
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-home">&nbsp;</em> Property <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="addproperty.php">
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
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					Dashboard
				</a></li>
				<li><a href="viewbooking.php">
					View Booking
				</a></li>
				<li class="active">Checkout Personnel</li>
			</ol>
		</div><!--/.row-->
	<!--		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Booking Form</h1>
			</div>
		</div>
	-->

    <form class="form-format-1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="checkoutform">
		<div class="outer-sub-1">
			<h3> Prepare for checkout </h3>
			<div class="sub-section-1">
				<div class="form-group  prop-type form-format-1">
					<label for="bookingid">Booking ID:</label><br>
					<input class="form-control" class="form-control" type="text" id="bookingid" name="bookingid" value="<?php echo $row["booking_id"];?>"readonly><br>
				</div>
				<div class="form-group prop-type">
    				<label for="propertyid">Property ID:</label><br>
    				<input class="form-control" type="text" id="propid" name="propid" value="<?php echo $row['property_book_id']; ?>"readonly><br>
				</div>
				<div class="form-group prop-type">
    				<label for="name">Name:</label><br>
    				<input class="form-control" type="text" id="name" name="name" value="<?php echo $row['book_name']; ?>" readonly><br>
				</div>
				<div class="form-group prop-type">
    				<label for="phone">Phone:</label><br>
    				<input class="form-control" type="text" id="phone" name="phone" value="<?php echo $row['book_phone']; ?>" readonly><br>
				</div>
				<div class="form-group prop-type">
					<label for="aadhar">Aadhar Card Number:</label><br>
					<input class="form-control" type="text" id="aadhar" name="aadhar" value="<?php echo $row['book_valid']; ?>" readonly><br>
				</div>
				<div class="form-group prop-type">
    				<label for="checkin">Check-in Date:</label><br>
    				<input class="form-control" type="text" id="checkin" name="checkin" value="<?php echo $row['check_in_date']; ?>" readonly><br>
				</div>
				<div class="form-group prop-type">
    				<label for="checkout">Check-out Date:</label><br>
    				<input class="form-control" type="text" id="checkout" name="checkout" value="<?php echo $row['check_out_date']; ?>" readonly><br>
				</div>
				<div class="form-group prop-type">
    				<label for="total">Total Amount:</label><br>
    				<input class="form-control" type="text" id="total" name="total" value="<?php echo $row['pay_total']; ?>" readonly><br>
				</div>
				<div class="form-group prop-type">
    				<label for="advance">Advance Pay:</label><br>
    				<input class="form-control" type="text" id="advance" name="advance" value="<?php echo $row['pay_advance']; ?>" readonly><br>
				</div>
				<div class="form-group prop-type">
    				<label for="deposit">Deposit Pay:</label><br>
    				<input class="form-control" type="text" id="deposit" name="deposit" value="<?php echo $row['pay_deposit']; ?>" readonly><br>
				</div>
				<div class="form-group prop-type">
    				<label for="pending">Pending Amount:</label><br>
    				<input class="form-control" type="text" id="pending" name="pending" value="<?php echo $row['pay_remaining']; ?>" readonly><br>
				</div>
				<div class="form-group prop-type">
    				<label for="roomtype">Book Room Type:</label><br>
    				<input class="form-control" type="text" id="roomtype" name="roomtype" value="<?php echo $row['booking_type']; ?>" readonly><br>
				</div>
				<div class="form-group prop-type">
    			<label for="paymenttype">Payment Type:</label><br>
    			<select class="form-control" id="paymenttype" name="paymenttype" value="<?php echo $row['payment_type']; ?>" readonly>
        			<option value="cash">Cash</option>
        			<option value="gateway">Gateway</option>
        			<option value="upi">UPI</option>
        			<option value="emi">EMI</option>
    			</select><br>
				</div>
				<div class="form-group prop-type">
    				<label for="referralname">Referral Name:</label><br>
    				<input class="form-control" type="text" id="referralname" name="referralname" value="<?php echo $row['referral_name']; ?>" readonly><br>
				</div>
				<div class="form-group prop-type">
    				<label for="referralnumber">Referral Number:</label><br>
    				<input class="form-control" type="text" id="referralnumber" name="referralnumber" value="<?php echo $row['referral_number']; ?>" readonly><br>
				</div>
				<div class="form-group prop-type">
					<label for="checkoutstatus">Checkout Status</label><br>
					<input class="form-control" type="text" id="checkoutstatus" name="checkoutstatus" value="<?php echo $_checkoutcheck;?>"readonly><br>
				</div>
				<div class="submit-btn-2">
    				<input class="input-btn-1" type="button" id="checkoutbtn" value="Checkout" onclick="confirmCheckout()">
					<input class="input-btn-1" type="button" value="Cancel" onclick="window.location.href = 'viewbooking.php'">
				</div>

    <p><?php echo implode($errors);?></p>
    </form>
        </div>
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
		
</body>
</html>