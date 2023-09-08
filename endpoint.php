<?php

// Check if both query parameters are provided
if (!isset($_GET['param1']) || !isset($_GET['param2'])) {
    http_response_code(400);
    echo json_encode(array('error' => 'Both param1 and param2 are required.'));
    exit;
}

// Retrieve the query parameters
$param1 = $_GET['param1'];
$param2 = $_GET['param2'];

$db = mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db = mysqli_connect('localhost','root','','hng');

$stmt = $db->prepare("SELECT * FROM hngTable WHERE hngTable.slack_name = '$param1' AND hngTable.track = 'backend'");

// Replace this with your specific logic to process the parameters and generate a response.
// Here, we're just echoing back the parameters in JSON format.
// $response_data = array('param1' => $param1, 'param2' => $param2);

// // Set the response content type to JSON
// header('Content-Type: application/json');

// Send the JSON response
echo json_encode($stmt);

?>
