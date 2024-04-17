<?php
session_start();

$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "property_manage";

$conn = new mysqli($hostname, $username, $password, $database);
if($conn->connect_error){
	die("Failed to connect to database" . $conn->connect_error);
}

$today = date("d-m-Y");

$stmt = $conn->prepare("INSERT INTO feedback (name, phone, email, city, ambience_rating, cleanliness_rating, food_quality_rating, service_rating, suggestions, ref_name, ref_phone, submit_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssiiiissss", $name, $phone, $email, $city, $ambience_rating, $cleanliness_rating, $food_quality_rating, $service_rating, $suggestions, $ref_name, $ref_phone, $submit_date);

$ref_name = [];
$ref_phone = [];
$submit_date = date("d-m-Y");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $city = htmlspecialchars($_POST['city']);
    $ambience_rating = htmlspecialchars($_POST['ambience']);
    $cleanliness_rating = htmlspecialchars($_POST['cleanliness']);
    $food_quality_rating = htmlspecialchars($_POST['foodQuality']);
    $service_rating = htmlspecialchars($_POST['service']);
    $suggestions = htmlspecialchars($_POST['suggestions']);
    for ($i = 0; $i < (int)htmlspecialchars($_POST['referenceCount']); $i++) {
        array_push($ref_name, htmlspecialchars($_POST["referenceName"][$i]));
        array_push($ref_phone, htmlspecialchars($_POST["referencePhone"][$i]));
    }
    $ref_name = implode(",", $ref_name);
    $ref_phone = implode(",", $ref_phone);

$stmt->execute();
$stmt->close();
$_SESSION["form_submitted"] = true;
header("Location: thankyou.php");
exit();

}
else{
    echo "Unknown Error Occured. Form not submitted.";
}
$conn->close();

echo "Feedback submitted successfully!";
?>
