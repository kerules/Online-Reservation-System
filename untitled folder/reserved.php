<?php
session_start();
?>
      <!DOCTYPE html>

	<style>
		body {
    background-color: #D3D3D3;
    margin: 0;
}
</style>
<title>Reservation</title>

<!-- Login Page -->
      <style>
            body {
    background-color: #D3D3D3;
    margin: 0;
}
</style>
<head>
      
      <?php include('header.php');
     ?> </head>
      <?php
// If no session variable exists, tell user to login:
if (!isset($_SESSION['user_id'])) {
     echo"<h1>You are not logged in!</h1>
<p>Please login first.</p>";
Echo "<a href=loginreg.php>Login</a>";
}
else {
      $SQL = "INSERT INTO `cps3351`.`reservation` (`reservation_id`, `checkin_date`, `checkin_time`, `checkout_time`, `totalhours`, `user_id`, `payment_id`) 
VALUES ('', '$checkin_date', '$checkin_time', '$checkout_time', '$hours_reserved', $id, '3')";


if(mysqli_query($dbc, $SQL)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute " . mysqli_error($dbc);

}
}

     ?>
     
     
     
      
      </body>
      <?php include('footer.php'); ?>
      </html>