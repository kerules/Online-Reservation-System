<?php
      session_start();
      ?>
<html>
<script type="text/javascript" charset="utf-8" src="function.js"></script>
</style>
<title>Reserve Room</title>
      <style>
            body {
    background-color: #D3D3D3;
    margin: 0;
}

</style>
<head>
      
      <?php include('header.php'); ?>
      <?php
       if (!isset($_SESSION['user_id'])) {
     echo"<h1>You are not logged in!</h1>
<p>Please login first.</p>";
Echo "<a href=loginreg.php>Login</a>";
       }
else {
?>
      </head>
  
      
               <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
                  <table width="400" border="0" cellspacing="1" cellpadding="2">
                 

                     <tr>

<h2>Check for Availability</h2><tr>
Date:
<input type="date" name="date">
</tr>
<br>
<tr> 
  <?
  $i = 1;
$dir = './images'; // Define the directory to view.
$files = array();
if (is_dir($dir)){
  if ($dh = opendir($dir)){
     while (($file = readdir($dh)) !== false){
       $files[] = $file;
     }
  }
}
       foreach ($files as $image){
         $ext = strtolower ( substr ($image, -4));

	if (substr($image, 0, 1) != '.' && $ext == '.jpg') { // Ignore anything starting with a period.
	
   
		// Get the image's size in pixels:
		$image_size = getimagesize ("$dir/$image");
		
		// Calculate the image's size in kilobytes:
		$file_size = round ( (filesize ("$dir/$image")) / 1024) . "kb";
		
		// Determine the image's upload date and time:
		$image_date = date("F d, Y H:i:s", filemtime("$dir/$image"));
		
		// Make the image's name URL-safe:
		$image_name = urlencode($image);
    
		
		// Print the information:
    ?>
      <input type= "radio" name ="roomNumber" value =
    <?
    $i
    ?>
    >
    <?
    
		echo "<a href=\"javascript:create_window('$image_name',$image_size[0],$image_size[1])\">Room $i </a>";
	 $i++;

	} // End of the IF.
    
}
?>
<br>

<tr>
Check in: <select name="time">
  <option value="4:00">4:00 am</option>
  <option value="5:00">5:00 am</option>
  <option value="6:00">6:00 am</option>
  <option value="7:00">7:00 am</option>
  <option value="8:00">8:00 am</option>
  <option value="9:00">9:00 am</option>
  <option value="10:00">10:00 am</option>
  <option value="11:00">11:00 am</option>
  <option value="12:00">12:00 pm</option>
  <option value="13:00">1:00 pm</option>
  <option value="14:00">2:00 pm</option>
  <option value="15:00">3:00 pm</option>
  <option value="16:00">4:00 pm</option>
  <option value="17:00">5:00 pm</option>
  <option value="18:00">6:00 pm</option>
  <option value="19:00">7:00 pm</option>
  <option value="20:00">8:00 pm</option>
  <option value="21:00">9:00 pm</option>
  <option value="22:00">10:00 pm</option>
  <option value="23:00">11:00 pm</option>
</select>
      </tr>
</select>
<tr>
	<br>
Hours Reserved:<select name ="hours_reserved">
  					<option value="1:00">1</option>
  					<option value="2:00">2</option>
 					<option value="3:00">3</option>
  					<option value="4:00">4</option>
</tr>
                        <td width="100"> </td>
                        <td>
                           <input name="submit" type="submit" value="Check">
                        </td>
                
                  
                  </table>
               </form>
			   <?php 
  			include ('/Applications/MAMP/mysqli_connect.php');  // depend on the correct path in your machine 
  		?> 



<?php
if(isset($_POST['submit'])) 
{ 
 $id = $_SESSION['user_id'];
// Check connection
if($dbc === false){
    die("ERROR: " . mysqli_connect_error());
}

$checkin_date = strtotime($_POST['date']);
$checkin_date = date('Y-m-d', $checkin_date);
$checkin_time = $_POST['time'];
$checkin_time = date('H:i',strtotime($checkin_time));
$hours_reserved = $_POST['hours_reserved'];
$hours_reserved = date('H:i',strtotime($hours_reserved));

$check = strtotime($checkin_time)-strtotime("00:00:00");
$checkout_time = date("H:i:s",strtotime($hours_reserved)+$check);

$sql2 = mysqli_query($dbc, "SELECT * FROM `reservation` WHERE `checkin_date` = '$checkin_date' AND `checkin_time` = '$checkin_time'");

if($sql2 && mysqli_num_rows($sql2) > 0)
{
    echo "There is no avalability for this requested date and time.";
}
else {

$SQL = "INSERT INTO `cps3351`.`reservation` (`reservation_id`, `checkin_date`, `checkin_time`, `checkout_time`, `totalhours`, `user_id`, `payment_id`) 
VALUES ('', '$checkin_date', '$checkin_time', '$checkout_time', '$hours_reserved', $id, '')";


if(mysqli_query($dbc, $SQL)){
    echo "Reservation added successfully.";
} else{
    echo "ERROR: Could not able to execute " . mysqli_error($dbc);

}
}
}
       }
?>  
            
            
   
      </body>
      <?php include('footer.php'); ?>
      </html>