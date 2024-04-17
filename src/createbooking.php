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
	<title>Lumino - Create Bookings</title>
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
	<style>
    table {
    		border-collapse: collapse;
    		width: 100%;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
			background-color: white;
    	}
		table tr:nth-child(even) td{
			background-color: rgba(128, 128, 128, 0.2);
		}
    th, td {
        border: none;
        text-align: left;
        padding: 12px;
    }
	td {
		height: 70px;
	}
    th {
        background-color: rgb(204, 221, 255);
		color: rgb(0, 51, 153);
		height: 70px;
		cursor: pointer;
    }
    button {
        padding: 5px 10px;
        cursor: pointer;
    }
</style>
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
		<ul class="nav menu">
			<li><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
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
				<em class="fa fa-bookmark fa-minus">&nbsp;</em> Bookings <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus fa-minus"></em></span>
				</a>
				<ul class="children collapse in" id="sub-item-2" aria-expanded="true">
					<li class='active'><a class="active" href="createbooking.php">
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
<!--
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					Dashboard
				</a></li>
			</ol>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Create New Booking</h1>
			</div>
		</div>

        <div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Select Date For Available Bookings
						</div>
					<div class="panel-body">
						<div id="calendar"></div>
					</div>
				</div>
        </div>
</div>
--><div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					Dashboard
				</a></li>
				<li class="active">Create Bookings</li>
			</ol>
		</div><!--/.row-->

		<div>
        <form id="dateform" class="form-format-1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<!-- check in date calendar -->
			<div class="outer-sub-1">
			<h3> Select check-in and check-out date </h3>
			<div class="sub-section-1">
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								Check In Date
							</div>
						<div class="panel-body">
							<div id="calendar"></div>
							</div>
						</div>
					</div>
		<!-- check out date calendar -->
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								Check Out Date
							</div>
						<div class="panel-body">
							<div id="calendar1"></div>
						</div>
						</div>
					</div>
				</div>
				<div style="display: flex;">
				<div class="form-group  prop-type form-format-1 form-format-2">
            		<label for="checkin">Check In Date</label><br>
					<?php selectedDateParse(isset($_POST['checkdatein']));?>
				</div>
				<div class="form-group  prop-type form-format-1 form-format-2">
					<label for="checkout">Check Out Date</label><br>
					<?php selectedDateParse2(isset($_POST["checkdateout"]));?>
				</div>
				</div>
				<div class="form-group  prop-type form-format-1 get-to-center">
					<label for="roomtype">Select Room Type</label><br>
					<?php selectedRoomType(isset($_POST["roomtype"])); ?>
				</div>
				<div class="get-to-center" style="display: flex;">
            		<input class="input-btn-1 get-to-center" type="button" value="Check" id="sbtbtn">
				</div>
			</div>
			</div>
            </form>
        </div>
		<div>
                    <?php

						function checkAnyOverlap($start, $end, $startc, $endc){
							return ($start <= $endc) && ($startc <= $end);
						}

						function buildBookTable($propId){
							global $conn;
							$sql5 = "SELECT id, property_type, location, room_type, rent_price 
								FROM property_data WHERE id = '$propId'";
							$result5 = $conn->query($sql5);
							if($result5->num_rows > 0){
								$row5 = $result5->fetch_assoc();
								echo "<tr>";
        						echo "<td>" . $row5["property_type"] . "</td>";
        						echo "<td>" . $row5["location"] . "</td>";
        						echo "<td>" . $row5["room_type"] . "</td>";
        						echo "<td>" . $row5["rent_price"] . "</td>";
        						echo "<td><a href='viewpropertybig.php?id=" . $row5["id"] . "' target='_blank'>View Property</a></td>";
								echo "<td><a href='makebooking.php?id=" . $row5["id"] . "&check_in_date=" 
									.htmlspecialchars($_POST["checkdatein"]) .
									"&check_out_date=".htmlspecialchars($_POST["checkdateout"])."&rent_price=".$row5["rent_price"].
									"&room_type=".$row5["room_type"]."&actroomtype=".$_POST["roomtype"]."'>Book</a></td>";
        						echo "</tr>";
							}
						}

						function bookedRangeTable($propId){
							global $conn;
							$sql5 = "SELECT check_in_date, check_out_date, booking_type 
								FROM bookings WHERE property_book_id = '$propId'";
							$sql6 = "SELECT id, property_type, location, room_type, rent_price
								FROM property_data WHERE id='$propId'";
							$result5 = $conn->query($sql5);
							$result6 = $conn->query($sql6);

							if($result6->num_rows > 0){
								$row6 = $result6->fetch_assoc();
								$row5 =  $result5->fetch_assoc();
								echo "<tr>";
        						echo "<td>" . $row6["property_type"] . "</td>";
        						echo "<td>" . $row6["location"] . "</td>";
        						echo "<td>" . $row6["room_type"] . "</td>";
        						echo "<td>" . $row6["rent_price"] . "</td>";
								echo "<td>" . $row5["check_in_date"] . "</td>";
								echo "<td>" . $row5["check_out_date"] . "</td>";
        						echo "<td><a href='viewpropertybig.php?id=" . $row6["id"] . "' target='_blank'>View Property</a></td>";
								echo "<td><a href='makebooking.php?id=" . $row6["id"] . "&check_in_date=" 
									.htmlspecialchars($_POST["checkdatein"]) .
									"&check_out_date=".htmlspecialchars($_POST["checkdateout"])."&rent_price=".$row6["rent_price"].
									"&room_type=".$row6["room_type"]."&actroomtype=".$_POST["roomtype"]."'>Book</a></td>";
        						echo "</tr>";
							}
						}

						function bookedRangeTableDisabled($propId){
							global $conn;
							$sql5 = "SELECT check_in_date, check_out_date, booking_type 
								FROM bookings WHERE property_book_id = '$propId'";
							$sql6 = "SELECT id, property_type, location, room_type, rent_price
								FROM property_data WHERE id='$propId'";
							$result5 = $conn->query($sql5);
							$result6 = $conn->query($sql6);

							if($result6->num_rows > 0){
								$row6 = $result6->fetch_assoc();
								$row5 =  $result5->fetch_assoc();
								echo "<tr>";
        						echo "<td>" . $row6["property_type"] . "</td>";
        						echo "<td>" . $row6["location"] . "</td>";
        						echo "<td>" . $row6["room_type"] . "</td>";
        						echo "<td>" . $row6["rent_price"] . "</td>";
								echo "<td>" . $row5["check_in_date"] . "</td>";
								echo "<td>" . $row5["check_out_date"] . "</td>";
        						echo "<td><a href='viewpropertybig.php?id=" . $row6["id"] . "' target='_blank'>View Property</a></td>";
								echo "<td>Cant Book</td>";
        						echo "</tr>";
							}
						}

						function selectedDateParse($selectedDate){
							if($selectedDate){
								
								echo "<input type='date' class='form-control' id='checkdatein' name='checkdatein' value=". $_POST["checkdatein"] . " required readonly><br>";
							}
							else{
								echo "<input type='date' class='form-control' id='checkdatein' name='checkdatein'  required readonly><br>";
							}
						}

						function selectedDateParse2($selectedDate){
							if($selectedDate){
								echo "<input type='date' class='form-control' id='checkdateout' name='checkdateout' value=". $_POST["checkdateout"] . " required readonly><br>";
							}
							else{
								echo "<input type='date' class='form-control' id='checkdateout' name='checkdateout' required readonly><br>";
							}
						}

						function selectedRoomType($srt){
							if($srt){
								$roomType1 = $_POST['roomtype'];
								$roomType1 = substr($roomType1, 0, 1);

								echo "<select id='someselected' class='form-control' name='roomtype' required>";
								echo "<option>1RK</option>"; 
									for ($i = 1; $i <= 10; $i++) {
										if((Int)$roomType1 == $i){
											echo "<option selected='selected' value='" . $i . "BHK'>" . $i ."BHK</option>";
										}
										else{
											echo "<option value='" . $i . "BHK'>" . $i ."BHK</option>";
										}
									}
								echo "</select>";
							}
							else{
								echo "<select id='someselected' class='form-control' name='roomtype' required>";
								echo "<option></option>";
								echo "<option>1RK</option>";
									for ($i = 1; $i <= 10; $i++) {
										echo "<option value='" . $i . "BHK'>" . $i ."BHK</option>";
									}
								echo "</select>";
							}
						}

                        $hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "property_manage";

                        $conn = new mysqli($hostname, $username, $password, $database);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                        }
						
						$inputdatein = null;
						$inputdateout = null;
						$checkoutdat = null;
						$checkindat = null;
						$canbook = array();
						$cantbook = array();
						$roomtypecheck = null;

						if($_SERVER["REQUEST_METHOD"] == "POST"){
							$inputdatein = strtotime($_POST["checkdatein"]);
							$inputdateout = strtotime($_POST["checkdateout"]);
							$roomtypecheck = $_POST['roomtype'];
								//echo $inputdate;

							$sql = "SELECT * FROM bookings";
							$result = $conn->query($sql);

							$sql2 = "SELECT id, property_name, room_type FROM property_data";
							$result2 = $conn->query($sql2);
							$row2 = $result2->fetch_assoc();

							$sql3 = "SELECT id FROM property_data";
							$result3 = $conn->query($sql3);
							$row3 = array();

							while($_ = $result3->fetch_assoc()){
								array_push($row3, $_['id']);
							}

							$sql4 = "SELECT property_book_id FROM bookings";
							$result4 = $conn->query($sql4);
							$row4 = array();

							while($_ = $result4->fetch_assoc()){
								array_push($row4, $_["property_book_id"]);
							}

							echo "<div id='scrollhere'>";
							echo "<br><br>";
							if($result->num_rows >= 0){
								echo "<table id='viewtable'>";
								echo "<thead>";
								echo "<h3 style='text-align: center;'>Properties Available For Booking</h3>";
								echo "</thead>";
								echo "<tbody>";
								echo "<tr><th onclick='sortTable(0)'>Property Type</th><th onclick='sortTable(1)'>Location</th><th onclick='sortTable(2)'>Room Type</th><th onclick='sortTable(3)'>Rent Price</th><th>More Details</th><th>Book</th></tr>";
								while($row = $result->fetch_assoc()){
									$checkoutdat = strtotime($row["check_out_date"]);
									$checkindat = strtotime($row["check_in_date"]);
									
									if(checkAnyOverlap($inputdatein, $inputdateout, $checkindat, $checkoutdat)){
										array_push($cantbook, $row["property_book_id"]);
										continue;
									}
									else{
										if($row2["room_type"] < $roomtypecheck){
											continue;
										}
										else{
											array_push($canbook, $row["property_book_id"]);
										}
									}
								}
								foreach($canbook as $cn){
									buildBookTable($cn);
								}
								//properties never booked
								$notlistedprop = array_diff($row3, $row4);
								foreach($notlistedprop as $nlp){
									$sql5 = "SELECT room_type FROM property_data WHERE id=$nlp";
									$result5 = $conn->query($sql5);
									$row5 = $result5->fetch_assoc();

									if($row5["room_type"] >= $roomtypecheck){
										buildBookTable($nlp);
									}
								}
								echo "</tbody>";
								echo "</table>";
								}
								if(!empty($cantbook)){
								echo "<br><br>";
								echo "<table id='viewtable2'>";
								echo "<thead>";
								echo "<h3 style='text-align: center;'>Already Booked Properties</h3>";
								echo "</thead>";
								echo "<tbody>";
								echo "<tr><th onclick='sortTable(0, \"viewtable2\")'>Property Type</th><th onclick='sortTable(1, \"viewtable2\")'>Location</th><th onclick='sortTable(2, \"viewtable2\")'>Room Type</th><th onclick='sortTable(3, \"viewtable2\")'>Rent Price</th>
									<th onclick='sortTable(4, \"viewtable2\")'>Check In Date</th><th onclick='sortTable(5, \"viewtable2\")'>Check Out Date</th><th>More Details</th><th>Booked</th></tr>";
								foreach($cantbook as $ctn){
									$sql6 = "SELECT * FROM bookings WHERE property_book_id='$ctn'";
									$result6 = $conn->query($sql6);
									$row6 = $result6->fetch_assoc();

									bookedRangeTableDisabled($ctn);
								}
								echo "</tbody>";
								echo"</table>";
							}
							echo "</div>";
						}
                        $conn->close();
                    ?>
        </div>
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
	<script src="tablesort.js"></script>
	<script>

	window.onload = function() {
    	var table = document.getElementById("scrollhere");
    	if (table) {
      		table.scrollIntoView({ behavior: 'smooth', block: 'start' });
    	}
  	};						
	
		const formVal = document.getElementById("dateform");
		const submitBtn = document.getElementById("sbtbtn");

		submitBtn.addEventListener('click', function(event){
			event.preventDefault();
			const checkInDate = document.getElementById("checkdatein");
			const checkOutDate = document.getElementById("checkdateout");

			const today = new Date();
			const cid = Date.parse(checkInDate.value);
			const cod = Date.parse(checkOutDate.value);

			if(checkInDate.value > checkOutDate.value){
				alert("Check in date cannot be higher than check out date!");
			}
			else if(cid < today || cod < today){
				alert("Cant make bookings in the past.");
			}
			else{
				formVal.submit();
			}
		});

		//check in date
		document.addEventListener("DOMContentLoaded", function() {
  		const datepickerDays = document.getElementById('calendar');

		const checkDateIn = document.getElementById('checkdatein');
		
  		datepickerDays.addEventListener("click", function(event) {
    		const target = event.target;
    		if (target.classList.contains('day')) {
      			const day = target.textContent.trim();
      			const monthYearName = document.querySelector('.datepicker-days .datepicker-switch').textContent.trim();
				const monthYearBlock = monthYearName.split(" ");
				
				var months = {
					January : 1,
					February : 2,
					March : 3,
					April : 4,
					May : 5,
					June : 6,
					July : 7,
					August : 8,
					September : 9,
					October : 10,
					November : 11, 
					December : 12
				};

				const date = new Date(Date.parse(day + " " + months[monthYearBlock[0]]) + " " + monthYearBlock[1]);
				const formattedDay = day.padStart(2, '0');
				let formattedMonth = months[monthYearBlock[0]].toString().padStart(2, '0');
  				const formattedYear = date.getFullYear();
  				const formattedDate = `${formattedYear}-${formattedMonth}-${formattedDay}`;

				checkDateIn.value = formattedDate;	
    		}
  		});
	});

	//check out date
	document.addEventListener("DOMContentLoaded", function() {
  		const datepickerDays = document.getElementById('calendar1');

		const checkDateOut = document.getElementById('checkdateout');
		
  		datepickerDays.addEventListener("click", function(event) {
    		const target = event.target;
    		if (target.classList.contains('day')) {
      			const day = target.textContent.trim();
      			const monthYearName = document.querySelector('.datepicker-days .datepicker-switch').textContent.trim();
				const monthYearBlock = monthYearName.split(" ");
				
				var months = {
					January : 1,
					February : 2,
					March : 3,
					April : 4,
					May : 5,
					June : 6,
					July : 7,
					August : 8,
					September : 9,
					October : 10,
					November : 11, 
					December : 12
				};

				const date = new Date(Date.parse(day + " " + months[monthYearBlock[0]]) + " " + monthYearBlock[1]);
				const formattedDay = day.padStart(2, '0'); 
  				const formattedMonth = months[monthYearBlock[0]].toString().padStart(2, '0');
  				const formattedYear = date.getFullYear();
  				const formattedDate = `${formattedYear}-${formattedMonth}-${formattedDay}`;

				checkDateOut.value = formattedDate;	
    		}
  		});
	});
	</script>
		
</body>
</html>