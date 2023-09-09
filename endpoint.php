<?php

//Check if both query parameters are provided
if (!isset($_GET['slack_name']) || !isset($_GET['track'])) {
    http_response_code(400);
    echo json_encode(array('error' => 'Both param1 and param2 are required.'));
    exit;
}

//Retrieve the query parameters
$param1 = $_GET['slack_name'];
$param2 = $_GET['track'];



$pdo = new PDO('mysql:host=localhost;port=3306;dbname=id21239516_hng', 'id21239516_root', '1Q2w3e4r5t6y@');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$todayInUTC = gmdate('Y-m-d\TH:i:s\Z');
$todayDayOfWeek = date('l');

$updateSql = "UPDATE hngTable SET `utc_time` = :todayInUTC, `current_day` = :todayDayOfWeek WHERE `slack_name` = :param1 AND `track` = :param2";
$stmt = $pdo->prepare($updateSql);

// Bind the values to the placeholders
$stmt->bindParam(':todayInUTC', $todayInUTC, PDO::PARAM_STR);
$stmt->bindParam(':todayDayOfWeek', $todayDayOfWeek, PDO::PARAM_STR);
$stmt->bindParam(':param1', $param1, PDO::PARAM_STR);
$stmt->bindParam(':param2', $param2, PDO::PARAM_STR);

// Execute the update query
$stmt->execute();

$statement = $pdo->prepare("SELECT * FROM hngTable WHERE hngTable.slack_name = '$param1' AND hngTable.track = '$param2'");
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

$result = $products[0];

// Set the response content type to JSON
header('Content-Type: application/json');




echo json_encode($result, JSON_FORCE_OBJECT);
exit;

?>
