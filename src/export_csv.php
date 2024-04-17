<?php
session_start();

function transpose($array) {
    array_unshift($array, null);
    return call_user_func_array('array_map', $array);
}

$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "property_manage";
				
$conn = new mysqli($hostname, $username, $password, $database);
				
if($conn->connect_error){
	die("Failed to connect to database" . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $date_filter = date("d-m-Y", strtotime($_POST['dateFill']));

    $sql = "SELECT * FROM feedback WHERE submit_date = '$date_filter'";
    $result = $conn->query($sql);

    $head_data = array('Name', 'Phone', 'Type', 'Date');
    $ref_na = [];
    $ref_ph = [];
    $submit_name = [];
    $submit_phone = [];
    $type_push = [];
    $date_push = [];

    if($result->num_rows > 0){
	    while($row = $result->fetch_assoc()){
            array_push($submit_name, $row["name"]);
            array_push($submit_phone, $row["phone"]);
            array_push($type_push, "Submitter");
            array_push($date_push, $date_filter);

            $ref_na = explode(",", $row["ref_name"]);
            foreach($ref_na as $n){
                array_push($submit_name, $n);
            }
            $ref_ph = explode(",", $row["ref_phone"]);
            foreach($ref_ph as $n){
                array_push($submit_phone, $n);
            }
            for($i = 0; $i < count($ref_na); $i++){
                array_push($type_push, "Referral");
                array_push($date_push, $date_filter);
            }
        }
    }

    $conn->close();

    $tableData = array($submit_name, $submit_phone, $type_push, $date_push);

    $tableDataTransposed = transpose($tableData);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="feedback_data.csv"');

    $output = fopen('php://output', 'w');

    fputcsv($output, $head_data);

    foreach ($tableDataTransposed as $columnData) {
        fputcsv($output, $columnData);
    }

    fclose($output);
}
else{
    echo "No data recieved.";
}
?>
