<?php
if(!isset($_SESSION))
{
  session_start();
}
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  require ('C:\xampp\mysqli_connect.php');

  $errors = array();

  $reserve_id = $_POST['reserve_id'];
  $q = "SELECT * FROM reservation WHERE reservation_id= '$reserve_id' ";
  $r = mysqli_query($dbc, $q);
  $row = mysqli_fetch_array($r);
  $id = $row['reservation_id'];
  $date = $row['checkin_date'];
  $today = time();
  $your_date = strtotime($date);
  $datediff = abs($today - $your_date);
  $diffDates = floor($datediff/(60*60*24));
  $_SESSION['penalty'] = "null";

  if ($diffDates < 7 && $diffDates >= 0)
  {
    $_SESSION['penalty'] = 1;
  }

  if (is_numeric($_POST['reserve_id']))
  {
    $q = "SELECT reservation_id FROM reservation WHERE reservation_id= '$reserve_id' ";
    $r = mysqli_query($dbc, $q);
    $numOfRows = mysqli_num_rows($r);


    if ($numOfRows > 0)
    {

      $_SESSION['reserve_id'] = $reserve_id;

    }

    else
    {
      $errors[] =  "Reservation number not valid.";
    }

  }

  if (empty($errors))
  {
    include ('review_cancel.php');
  }

  else
  {
    include ('cancel.php');
  }

  mysqli_close($dbc); // Close the database connection.
}
?>
