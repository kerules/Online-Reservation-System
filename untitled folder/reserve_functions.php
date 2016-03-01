<?php
$errors1 = array(); // Initialize error array.

	require ('/Applications/MAMP/mysqli_connect.php');

$checkin_date = strtotime($_POST['year']."-".$_POST['month']."-".$_POST['day']);
$checkin_date = date('Y-m-d', $checkin_date);
$checkin_time = $_POST['time'];
$checkin_time = date('H:i:s',strtotime($checkin_time));
$hours_reserved = $_POST['hours_reserved'];
$checkout_time = date('H:i:s', strtotime($checkin_time+"$hours_reserved"));


$sql2 = mysqli_query($dbc, "SELECT * FROM `reservation` WHERE `checkin_date` = '$checkin_date' AND `checkin_time` = '$checkin_time'");

if($sql2 && mysqli_num_rows($sql2) > 0){

    $errors1[] = "<h2>There is no avalability for this requested date and time.</h2><p>";
}


?>