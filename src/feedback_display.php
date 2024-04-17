<?php
session_start();
if(!isset($_SESSION['username'])){
	header('Location: login.php');
}
$profilepic = $_SESSION["pfp"];
$_SESSION["pickedDate"] = date('Y-m-d');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Feedback</title>
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
		padding-right: 80px;
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
				<img src="<?php echo $profilepic; ?>" class="img-responsive" alt="">
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
			<li class="active"><a href="feedback_display.php"><em class="fa fa-comment">&nbsp;</em> Feedback</a></li>
		</ul>
		<a class="link-fix-2" href="logout.php"><button class="btn-fix-2">Logout</button></a>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					Dashboard
				</a></li>
                <li class="active">View Feedback</li>
			</ol>
		</div><!--/.row-->
		
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header head-fix-1">Feedback</h1>
		</div>
	</div>
	<div class="outer-sub-1">
        <form class="form-format-1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="sub-section-1">
            	<label for="dateFilter">Select Date:</label>
            	<input class="form-control" type="date" id="dateFilter" name="dateFilter" style="width: 300px;"
            	<?php
            	if (isset($_POST["dateFilter"])) {
                	echo 'value="' . htmlspecialchars($_POST["dateFilter"]) . '"';
            	}
            	?>
            	>
				<div class="submit-btn-3">
            		<button class="input-btn-2" type="submit" name="submit">Submit</button>
				</div>
			</div>
        </form>
		<div class="outer-sub-1">
		<div class="sub-section-1">
		<div>
			<h2>Export CSV</h2>
			<p style="margin-left: 0; font-size: 15px;">Export feedback data for current date</p>
			<div class="submit-btn-3">
    			<button id="exportSomeBtn" class="export-btn input-btn-2">Export CSV</button>
			</div>
			<div>
				<p style="margin-left: 0; font-size: 15px;">Export all feedback data</p>
    			<button id="exportAllBtn" class="export-btn input-btn-2">Export CSV (Full)</button>
			</div>
		</div>
		</div>
		</div>
	</div>
		<table id="feedbackTable">
			
			<?php 
				$hostname = "localhost";
				$username = "root";
				$password = "";
				$database = "property_manage";
				
				$conn = new mysqli($hostname, $username, $password, $database);
				
				if($conn->connect_error){
					die("Failed to connect to database" . $conn->connect_error);
				}

                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $date_filter = date("d-m-Y", strtotime($_POST["dateFilter"]));
                    $_SESSION["pickedDate"] = $_POST["dateFilter"];

                    $sql = "SELECT * FROM feedback WHERE submit_date = '$date_filter'";
				    $result = $conn->query($sql);

                    $ref_na = [];
                    $ref_ph = [];

				    if($result->num_rows > 0){
					echo "<thead id='scrollHere'>";
					echo "<h3>Feedback Data</h3>";
					echo "</thead>";
					echo "<tbody>";
					echo "<tr>";
                    echo "<th onclick='sortTable(0, \"feedbackTable\")'>Submit Date</th>";
					echo "<th onclick='sortTable(1, \"feedbackTable\")'>Customer Name</th>";
					echo "<th onclick='sortTable(2, \"feedbackTable\")'>Customer Phone</th>";
					echo "<th onclick='sortTable(3, \"feedbackTable\")'>Customer Email</th>";
                    echo "<th onclick='sortTable(4, \"feedbackTable\")'>Customer City</th>";
                    echo "<th style='padding-right: 10px;' onclick='sortTable(5, \"feedbackTable\")'>Ambience Rating</th>";
                    echo "<th style='padding-right: 10px;' onclick='sortTable(6, \"feedbackTable\")'>Cleanliness Rating</th>";
                    echo "<th style='padding-right: 10px;' onclick='sortTable(7, \"feedbackTable\")'>Food Quality Rating</th>";
                    echo "<th style='padding-right: 10px;' onclick='sortTable(8, \"feedbackTable\")'>Service Rating</th>";
                    echo "<th onclick='sortTable(9, \"feedbackTable\")'>Suggestions</th>";
                    echo "<th>Referral Name(s)</th>";
                    echo "<th>Referral Phone No.(s)</th>";
					echo "</tr>";
					while($row = $result->fetch_assoc()){
							echo "<tr>";
                            echo "<td>".$row["submit_date"]."</td>";
							echo "<td>".$row["name"]."</td>";
							echo "<td>".$row["phone"]."</td>";
							echo "<td>".$row["email"]."</td>";
							echo "<td>".$row["city"]."</td>";
                            echo "<td>".$row["ambience_rating"]."</td>";
                            echo "<td>".$row["cleanliness_rating"]."</td>";
                            echo "<td>".$row["food_quality_rating"]."</td>";
                            echo "<td>".$row["service_rating"]."</td>";
                            echo "<td>".$row["suggestions"]."</td>";

                            echo "<td>";
                            $ref_na = explode(",", $row["ref_name"]);
                            $ref_na_c = 1;
                            foreach($ref_na as $i){
                                echo $ref_na_c;
                                echo ". ";
                                echo $i;
                                echo "<br>";
                                $ref_na_c++;
                            }
                            echo "</td>";

                            echo "<td>";
                            $ref_ph = explode(",", $row["ref_phone"]);
                            $ref_ph_c = 1;
                            foreach($ref_ph as $i){
                                echo $ref_ph_c;
                                echo ". ";
                                echo $i;
                                echo "<br>";
                                $ref_ph_c++;
                            }
                            echo "</td>";
							echo "</tr>";
					}
				}
				else{
					echo "<h5 style='color: red;'>No records found.</h5>";
				}
                }
				$conn->close();
				
			?>
			</tbody>
			</table>
		
		<div><!--/.row-->
			<?php include "footer.php";?>
		</div><!--/.row-->
	</div>	<!--/.main-->
	
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

	window.onload = function() {
    	var table = document.getElementById("scrollHere");
    	if (table) {
      		table.scrollIntoView({ behavior: 'smooth', block: 'start' });
    	}
  	};

    $(document).ready(function() {
        $('#submitFilter').on('click', function() {
            loadFeedbackData();
        });
        function loadFeedbackData() {
            var selectedDate = $('#dateFilter').val();
            $.ajax({
                url: 'fetch_feedback.php', 
                method: 'POST',
                data: { date: selectedDate },
                success: function(response) {
                    // Clear existing table rows
                    $('#feedbackTable tbody').empty();
                    // Append new table rows with filtered data
                    $('#feedbackTable tbody').append(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching feedback data:', error);
                }
            });
        }
    });

	//quite the complicated case
	$(document).ready(function() {
    $("#exportSomeBtn").click(function() {
		var checkDate = document.getElementById("dateFilter").value;
		if(checkDate){
        $.ajax({
            url: "export_csv.php",
            type: "POST",
			data: {
				dateFill : checkDate
			},
            success: function(response) {
                // Download CSV file
                var link = document.createElement("a");
                link.href = "data:text/csv;charset=utf-8," + encodeURI(response);
                link.download = "feedback_data_" + checkDate +".csv";
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function(xhr, status, error) {
                console.error("Error exporting CSV:", error);
            }
        });
	}
	else{
		alert("Date is not set cant export file.");
	}
    });
});

	$(document).ready(function() {
        $("#exportAllBtn").click(function() {
            $.ajax({
                url: "fetch_feedback_data_all.php", 
                type: "GET",
                success: function(response) {
                    var link = document.createElement("a");
                	link.href = "data:text/csv;charset=utf-8," + encodeURI(response);
                	link.download = "feedback_data_all.csv";
                	document.body.appendChild(link);
                	link.click();
                	document.body.removeChild(link);
                },
                error: function(xhr, status, error) {
                    console.error("Error exporting table data:", error);
                }
            });
        });
    });

</script>

	<script src="tablesort.js"></script>
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