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
	<title>Lumino - View Bookings</title>
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
				<em class="fa fa-bookmark fa-minus">&nbsp;</em> Bookings <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus fa-minus"></em></span>
				</a>
				<ul class="children collapse in" id="sub-item-2">
					<li><a class="" href="createbooking.php">
						<span class="fa fa-thumb-tack">&nbsp;</span> Create Booking
					</a></li>
					<li class='active'><a class="active" href="viewbooking.php">
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
				<li class="active">View Bookings</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">View Current Bookings</h1>
			</div>
		</div><!--/.row-->
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="outer-sub-1">
				<div class="sub-section-1">
				<div class="row" style="display: flex; justify-content: center;">
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								Check In Date
							</div>
						<div class="panel-body">
							<div id="calendar2"></div>
							</div>
						</div>
					</div>
				</div>
			<div style="display: flex;">
			<div class="form-group  prop-type form-format-1 form-format-2">
            	<label for="checkin">Check In Date</label><br>
            	<?php echo selectedDateParse3(isset($_POST['checkdatein1']));?><br>
			</div>
			<div class="form-group  prop-type form-format-1 form-format-2">
				<label for="bookingstatus">Checkout Status</label>
    			<?php echo checkoutChecker(isset($_POST["bookingstatus"])); ?>
				<br>
			</div>
			</div>
				<div class="get-to-center" style="display: flex; justify-content: center;">
					<input class="input-btn-1" type="submit" value="Search">
				</div>
			</div>
			</div>
		</form>

		<?php

			function selectedDateParse3($selectedDate){
				if($selectedDate){
				echo "<input type='date' class='form-control' id='checkdatein1' name='checkdatein1' value=". $_POST["checkdatein1"] . " required readonly><br>";
			}
			else{
				echo "<input type='date' class='form-control' id='checkdatein1' name='checkdatein1'  required readonly><br>";
			}
			}

			function checkoutChecker($cc){
				if($cc){
					$check = $_POST['bookingstatus'];

					echo "<select id='bookingstatus' class='form-control' name='bookingstatus' style='width: 95%;' required>";
					if($check == 'No'){
						echo "<option selected='selected' value='No'>Not Checked Out</option>";
						echo "<option value='Yes'>Checked Out</option>";
					}
					elseif($check == 'Yes'){
						echo "<option value='No'>Not Checked Out</option>";
						echo "<option selected='selected' value='Yes'>Checked Out</option>";
					}
        			else{
						echo "<script> alert('Unknown error occured.');</script>";
					}
    				echo "</select>";
				}
				else{
					echo "<select id='bookingstatus' class='form-control' name='bookingstatus' style='width: 95%;' required>";
					echo "<option></option>";
        			echo "<option value='No'>Not Checked Out</option>";
        			echo "<option value='Yes'>Checked Out</option>";
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

			if($_SERVER["REQUEST_METHOD"] == "POST"){

				$checkoutstatus = htmlspecialchars($_POST['bookingstatus']);
				$searchDate = htmlspecialchars($_POST['checkdatein1']);
				$searchDate = date("d-m-Y", strtotime($searchDate));
				$sql = "SELECT * FROM bookings WHERE check_in_date = '$searchDate' AND checkout_check='$checkoutstatus';";
				$result = $conn->query($sql);

				echo "<div id='scrollhere'>";
				echo "<br><br>";
				if($result->num_rows > 0){
					echo "<table id='viewtable'>";
					echo "<thead>";
					echo "<h3>Bookings found:</h3>";
					echo "</thead>";
					echo "</tbody>";
    				echo "<tr><th onclick='sortTable(0)'>Booking Id</th><th onclick='sortTable(1)'>Booking Name</th><th onclick='sortTable(2)'>Booking Phone</th>
						<th onclick='sortTable(3)'>Check In Date</th><th onclick='sortTable(4)'>Check Out Date</th><th>More Details</th></tr>";
    			while($row = $result->fetch_assoc()) {
        			echo "<tr>";
        			echo "<td>" . $row["booking_id"] . "</td>";
        			echo "<td>" . $row["book_name"] . "</td>";
        			echo "<td>" . $row["book_phone"] . "</td>";
        			echo "<td>" . $row["check_in_date"] . "</td>";
        			echo "<td>" . $row["check_out_date"] . "</td>";
        			echo "<td><a href='viewbookingbig.php?booking_id=" . $row["booking_id"] . "'>View More</a></td>";
        			echo "</tr>";
    			}
				echo "</tbody>";
    			echo "</table>";
				}
				else{
					echo("<h4 style='color: red; font-weight: 500;'>No bookings found for the check-in date: $searchDate OR All bookings 
						for selected check in date have already checked out!</h4>");
				}
				echo"<br><br>";
				echo "</div>";
				
		}
		$conn->close();
		?>
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
		
		window.onload = function () {
			var table2 = document.getElementById('scrollhere');
			if(table2){
				table2.scrollIntoView({behaviour: 'smooth', block: 'start'});
			}
		}

		document.addEventListener("DOMContentLoaded", function() {
  		const datepickerDays = document.getElementById('calendar2');

		const checkDateIn1 = document.getElementById('checkdatein1');
		
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

				checkDateIn1.value = formattedDate;	
    		}
  		});
	});

	</script>
		
</body>
</html>