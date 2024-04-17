<?php
session_start();
if(!isset($_SESSION['username'])){
	header('Location: login.php');
}
$profilepfp = $_SESSION['pfp'];
?>
<?php
function roomExtract($room) : string{
	preg_match('/\d+/', $room, $matches);
	if(isset($matches)){
		return $matches[0];
	}
	else{
		return 0;
	}
}
function adjustedTotalPay($propRoom, $bookRoom, $rent) : float{
	$propRoom = roomExtract($propRoom);
	$bookRoom = roomExtract($bookRoom);
	$adjustedVal = abs($propRoom - $bookRoom);
	if($adjustedVal == 0){
		return round($rent);
	}
	else{
		$baseRent = $rent / $propRoom;
		return round($rent - ($baseRent * $adjustedVal));
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

$setupcheck = true;
$errors = array();

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
    if(empty($_POST["name"])){
        array_push($errors, "Name not set<br>");
        $setupcheck = false;
    }
    if(empty($_POST["phone"])){
        array_push($errors, "Phone Number not set<br>");
        $setupcheck = false;
    }
	else if(!preg_match(("/^\d{10}$/"), htmlspecialchars($_POST["phone"]))){
		array_push($errors, "Please enter a valid phone number");
		$checkcreate = false;
	}
	else if(!preg_match(("/^\d{12}$/"), htmlspecialchars($_POST["aadhar"]))){
		array_push($errors, "Aadhar number invalid");
		$checkcreate = false;
	}
    if(empty($_POST["checkin"])){
        array_push($errors, "Check in date not set<br>");
        $setupcheck = false;
    }
    if(empty($_POST["checkout"])){
        array_push($errors, "Check out date not set<br>");
        $setupcheck = false;
    }
    if(empty($_POST["advance"])){
        array_push($errors, "Advance payment not set<br>");
        $setupcheck = false;
    }
    if(empty($_POST["roomtype"])){
        array_push($errors, "Room Type not set<br>");
        $setupcheck = false;
    }
	if(empty($_POST["paymenttype"])){
		array_push($errors, "Payment Type not set");
		$setupcheck = false;
	}
	if(empty($_POST["deposit"])){
		array_push($errors, "Deposit amount not set");
		$setupcheck = false;
	}
    
    if($setupcheck){
        $sqlpush = "INSERT INTO bookings (book_name, book_phone, 
			book_valid, property_book_id, booking_type, check_in_date, check_out_date, 
			pay_total, pay_advance, pay_deposit, pay_remaining, payment_type, referral_name, 
			referral_number, biller_id, actual_booked_rooms, checkout_check)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
		
		$name = htmlspecialchars($_POST['name']);
		$phone = htmlspecialchars($_POST['phone']);
		$aadhar = htmlspecialchars($_POST['aadhar']);
		$propid1 = htmlspecialchars($_POST["propid1"]);
		$roomtype1 = htmlspecialchars($_POST["roomtype1"]);
		$checkin1 = date("d-m-Y", strtotime(htmlspecialchars($_POST['checkin1'])));
		$checkout1 = date("d-m-Y", strtotime(htmlspecialchars($_POST['checkout1'])));
		$total1 = htmlspecialchars($_POST["totaltopay"]);
		$advance = htmlspecialchars($_POST["advance"]);
		$deposit = htmlspecialchars($_POST["deposit"]);
		$paymenttype = htmlspecialchars($_POST["paymenttype"]);
		$referralname = htmlspecialchars($_POST["referralname"]);
		$referralnumber = htmlspecialchars($_POST["referralnumber"]);
		$biller = $_SESSION["profileid"];
		$pendingpay = $total1 - $advance;
		$refname = empty($referralname) ? "None Provided" : $referralname;
		$refnum = empty($referralnumber)? "None Provided" :  $referralnumber;
		$actroombook = htmlspecialchars($_POST["actroomtype1"]);
		$checkoutcheck = 'No';

		$sqlpushprep = $conn->prepare($sqlpush);
		$sqlpushprep->bind_param(
			"sssissssssssssiss",
			$name,
			$phone,
			$aadhar, 
			$propid1,
			$roomtype1,
			$checkin1,
			$checkout1,
			$total1,
			$advance,
			$deposit,
			$pendingpay,
			$paymenttype,
			$refname,
			$refnum,
			$biller,
			$actroombook,
			$checkoutcheck
		);

		$sqlpushprep->execute();
		$sqlpushprep->close();
		$lastId = $conn->insert_id;
		echo"<script>alert('Booking Created Successfully');</script>";
		echo"<script>window.location.href = 'viewbookingbig.php?booking_id=$lastId';</script>";
		exit;
    }
	else{
		header("Location: makebooking.php?id=".$_POST["propid1"]);
	}
}
else{
	
	$propid = htmlspecialchars($_GET['id']);
	$checkindate1 = date(htmlspecialchars($_GET['check_in_date']));
	$rentpricefecthed = htmlspecialchars($_GET['rent_price']);
	$roomTypeBooked = htmlspecialchars($_GET["room_type"]);
	$checkoutdat1 = date(htmlspecialchars($_GET['check_out_date']));
	$actRoomTypeBooked = htmlspecialchars($_GET['actroomtype']);

$sql = "SELECT deposit_amt FROM property_data WHERE id='$propid'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$depositPay = $row["deposit_amt"];
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Fill Booking Details</title>
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
				<img src="<?php echo $profilepfp ?>" class="img-responsive" alt="">
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
				<li><a href="createbooking.php">
					Create Booking
				</a></li>
				<li class="active">Finalise Booking</li>
			</ol>
		</div><!--/.row-->
		
		
	<div class="error-section-1">
	<p><?php echo implode($errors);?></p>
	</div>
        <div>
    <form class="form-format-1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<div class="outer-sub-1">
			<h3> Booking Details </h3>
			<p>Enter Personnel details for the primary.</p>
		<div class="sub-section-1">
			<div class="form-group prop-type form-format-1">
    			<label for="propertyid">Property ID:</label><br>
    			<input class="form-control" type="text" id="propid" name="propid" value="<?php echo $propid; ?>"readonly><br>
				<input type="hidden" name="propid1" value="<?php echo $propid; ?>">
			</div>
			<div class="form-group prop-type">
    			<label for="name">Name:</label><br>
    			<input class="form-control" type="text" id="name" name="name" required><br>
			</div>
			<div class="form-group prop-type">
    			<label for="phone">Phone:</label><br>
    			<input class="form-control" type="tel" id="phone" name="phone" pattern="[6-9]{1}[0-9]{9}" title="Please enter valid phone number" required><br>
			</div>
			<div class="form-group prop-type">
    			<label for="aadhar">Aadhar Card Number:</label><br>
    			<input class="form-control" type="tel" id="aadhar" name="aadhar" pattern="[0-9]{12}" title="Enter 12 digit number only"><br>
			</div>
			<div class="form-group prop-type">
    			<label for="checkin">Check-in Date:</label><br>
    			<input class="form-control" type="date" id="checkin" name="checkin" value="<?php echo $checkindate1;?>"readonly><br>
				<input type="hidden" name="checkin1" value="<?php echo $checkindate1; ?>">
			</div>
			<div class="form-group prop-type">
    			<label for="checkout">Check-out Date:</label><br>
    			<input class="form-control" type="date" id="checkout" name="checkout" value="<?php echo $checkoutdat1;?>"readonly><br>
				<input type="hidden" name="checkout1" value="<?php echo $checkoutdat1; ?>">
			</div>
			<div class="form-group prop-type">
    			<label for="total">Base Amount To Pay:</label><br>
    			<input class="form-control" type="text" id="total" name="total" value="<?php echo adjustedTotalPay($roomTypeBooked, $actRoomTypeBooked, $rentpricefecthed); ?>"readonly><br>
				<input type="hidden" name="total1" value="<?php echo adjustedTotalPay($roomTypeBooked, $actRoomTypeBooked, $rentpricefecthed); ?>">
			</div>
			<div class="form-group prop-type">
    			<label for="advance">Advance Pay:</label><br>
    			<input class="form-control" type="number" min="<?php echo $depositPay;?>" max="<?php echo $rentpricefecthed + $depositPay;?>" id="advance" name="advance" required><br>
				<input type="hidden" name="advance1" value="<?php echo $rentpricefecthed + $depositPay; ?>">
			</div>	
			<div class="form-group prop-type">
    			<label for="deposit">Deposit Pay:</label><br>
    			<input class="form-control" type="text" id="deposit" name="deposit" value="<?php echo $depositPay; ?>" ><br>
			</div>
			<div class="form-group prop-type">
				<label for="totaltopay"> Total Amount To Be Paid</label><br>
				<input class="form-control" type="text" id="totaltopay" name="totaltopay" readonly><br>
			</div>
			<div class="form-group prop-type">
    			<label for="pending">Pending Amount:</label><br>
    			<input class="form-control" type="text" id="pending" name="pending" readonly><br>
			</div>
			<div class="form-group prop-type">
				<label for="roomtype">Book Room Type:</label><br>
    			<input class="form-control" type="text" id="roomtype" name="roomtype" value="<?php echo $roomTypeBooked;?>"readonly><br>
				<input type="hidden" name="roomtype1" value="<?php echo $roomTypeBooked; ?>">
			</div>
			<div class="form-group prop-type">
				<label for="actroomtype">Actual Room Type Booked</label><br>
				<input class="form-control" type="text" id="actroomtype" name="actroomtype" value="<?php echo $actRoomTypeBooked;?>"readonly><br>
				<input type="hidden" name="actroomtype1" value="<?php echo $actRoomTypeBooked;?>">
			</div>
			<div class="form-group prop-type">
    			<label for="paymenttype">Payment Type:</label><br>
    			<select id="paymenttype" name="paymenttype" class="form-control" required>
				<option></option>
        		<option value="cash">Cash</option>
        		<option value="gateway">Gateway</option>
        		<option value="upi">UPI</option>
        		<option value="emi">EMI</option>
    			</select><br>
			</div>
			<div class="form-group prop-type">
				<label for="referralname">Referral Name:</label><br>
    			<input class="form-control" type="text" id="referralname" name="referralname" placeholder="Optional"><br>
			</div>
			<div class="form-group prop-type">
    			<label for="referralnumber">Referral Number:</label><br>
    			<input class="form-control" type="tel" id="referralnumber" name="referralnumber" pattern="[6-9]{1}[0-9]{9}" title="Please enter valid phone number" placeholder="Optional"><br>
			</div>
			<div class="submit-btn-2">
   				<input class="input-btn-1" type="submit" value="Create Booking">
				<input class="input-btn-1" type="button" value="Cancel" onclick="window.location.href = 'createbooking.php'">
			</div>
		</div>
	</div>
    </form>
        </div>
		
	</div><!--/.row-->
	<div>
	<?php include "footer.php";?>
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
		const baseAmt = document.getElementById("total");
		const advancePay = document.getElementById("advance");
		const depositPay = document.getElementById("deposit");
		const totalToPay = document.getElementById("totaltopay");
		const pendingAmt = document.getElementById("pending");

		function setToPayValue(){
			const v2 = parseFloat(baseAmt.value);
			const v3 = parseFloat(depositPay.value) || 0;
			const v4 = v2 + v3;
			totalToPay.value = v4.toFixed(2);
		}

		function setPendingAmt(){
			const v1 = parseFloat(advancePay.value) || 0;
			const v2 = parseFloat(baseAmt.value);
			const v3 = parseFloat(depositPay.value) || 0;
			const v4 = v3 + v2 - v1;
			pendingAmt.value = v4.toFixed(2);
		}

		advancePay.addEventListener('input', function(){
			setToPayValue();
			setPendingAmt();
		});
		depositPay.addEventListener('input', function(){
			setToPayValue();
			setPendingAmt();
		});

	</script>
		
</body>
</html>