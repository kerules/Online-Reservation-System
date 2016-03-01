<?
require ('C:\xampp\mysqli_connect.php');
if(!isset($_SESSION))
{
  session_start();
}

$reserve_id = $_SESSION['reserve_id'];
$penalty = $_SESSION['penalty'];
$newTotal = $_SESSION['newTotal'];

$q = "UPDATE reservation SET status='Cancelled' WHERE reservation_id='$reserve_id'";
mysqli_query($dbc, $q);

if ($penalty == 1)
{
  $sql = "UPDATE payment SET amount = '$newTotal' WHERE reservation_id = '$reserve_id'";
  mysqli_query($dbc, $sql);
}

include('reservation.php');
echo $penalty;
echo "<footer><h3><center>Reservation Cancelled!</h3></center>";
?>
