<?php
session_start();
	class LoginPortal{
		public $username;
		public $passcode;

		private function sanitize($data){
			$data = trim($data);
        	$data = stripslashes($data);
        	$data = htmlspecialchars($data);
        	return $data;
		}
		public function __construct($user, $pass)
		{
			$this->username = $this->sanitize($user);
			$this->passcode = $this->sanitize($pass);
		}
	}

	$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "property_manage";

	$connect = new mysqli($hostname, $username, $password, $database);
	if($connect->connect_error){
		die("Failed to connect to database" . $connect->connect_error);
	}
	//echo("Connected to database successfully");

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$loginp = new LoginPortal($_POST["username"], $_POST["password"]);

		$sqlqr = "SELECT id FROM login_data WHERE name = ? AND password = ?;";
		$stmt = $connect->prepare($sqlqr);

		if($stmt){
			$stmt->bind_param("ss", $loginp->username, $loginp->passcode);
			$stmt->execute();
			$stmt->bind_result($id);
			$stmt->fetch();
			$stmt->close();
		}
		
		if($id){
			$_SESSION['username'] = $loginp->username;
			$sql = "SELECT * FROM login_data WHERE id = $id;";
			$result = $connect->query($sql);
			$row = $result->fetch_assoc();
			$_SESSION["pfp"] = $row["profile_picture"];
			$_SESSION["profileid"] = $row["id"];
			header("Location: index.php");
        	exit;
		}
		else{
			echo("
			<div class=\"error-data\">
				<p> Username or Password Incorrect. </p>
			</div>
			");
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Login</title>
	<link rel="icon" type="image/x-icon" href="assets/7337932.png">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="custom.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body class="body-fix">
	<div class="row">
		<div class="login-head">
			<p> ADMIN LOGIN PANEL </p>
		</div>
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4 login-fix">
			<div class="login-panel panel panel-default panel-fix-1">
				<div class="panel-heading panel-head-adj">Log In</div>
				<div class="panel-body">
					<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<!--<input name="remember" type="checkbox" value="Remember Me">Remember Me-->
								</label>
							</div>
							<input class="btn btn-primary btn-fix-1" type="submit" value="Login"></fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	<div class="footer-fix-1">
	<?php include "footer.php";?>
	</div>

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
