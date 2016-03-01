<?php
if(!isset($_SESSION))
{
  session_start();
}
require_once('C:\xampp\mysqli_connect.php');
?>
<!DOCTYPE html>

<!-- Header-->
<html>
<style>
#svgLogo{
  max-width: 260px;
  max-height: 0px;
  left: 0px;
}
.hover_img a
{
  position:relative;

}
.hover_img a span
{
  position:absolute;
  display:none;
  left: -200px;

  z-index:99;
}
.hover_img a:hover span
{
  display:block;
}
#header {
  background-color: #4d89ff;
  padding: 0px 10px;
  height:40px;
}
#nav {
  float: right;
  list-style: none;
  padding: 0px;
  display: inline-block;
}
#nav li {
  display:inline-block;
  padding: 0px;
  padding-right: 100px;
}
table, th, td {
  border: 4px outset #ff3333;
  border-collapse: collapse;
}
body {
  background-color: #e5eeff;
  margin: 0;
}
#content {
  align: center;
}
#left
{
  float:left;
}

#right
{
  float:right;

}


#book
{
  float:right;
  padding-right:380px;
}

.right
{
  padding-right:100px;
  float: right;
}

.left
{
  padding-left:200px;
  float: left;
}
.right2
{
  padding-right:250px;
  float: right;
}

.left2
{
  padding-left:250px;
  float: left;
}
h3{
  color: #ff7733;
}
h1{
  color: blue;
  border-bottom: 2px inset #000;
}
p label{

  display: inline-block;
  width: 150px;

}
p input{
  width:150px;
  color: #0058ff;
}
.tr{
  color: #ff7733;
}
a:link {
   color: #4747d1;
   text-shadow: 2px 2px #cccccc;
   active: color: #4747d1;
   visited: color: #4747d1;
}
</style>
<div id="header">
  <div id="svgLogo">
    <!--logo goes here-->
    <img src="reservation_logo (1).svg">

  </div>
  <ul id="nav">
    <li><a href="reservation.php">Home</a></li>
    <li><a href="history.php">History</a></li>
    <?php
    if (isset($_SESSION['user_id'])) {
      $userID = $_SESSION['user_id'];

      //get reservation id to use in payment information
      $q = "SELECT * FROM users WHERE user_id='$userID'";
      $r = @mysqli_query ($dbc, $q);
      $row = mysqli_fetch_array($r);
      $role = $row['role'];

      if ($role == "Admin")
      {
        echo '<li><a href="view_users.php">Edit/View Users</a></li>';
      }
    }

    ?>
    <li><a href="settings.php">Profile Settings</a></li>
    <li><a href="logout.php">Log Out</a></li>
  </ul>
</div>
</html>
