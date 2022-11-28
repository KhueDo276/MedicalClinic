<style>
    select{
    align-items: center;
    display: block;
  width: 50%;
  padding: 15px 20px;
  background: white;
  border-radius: 3px;
  transition: 0.4s;
}   
.content {
  max-width: 500px;
  margin: auto;
  margin-top: 20%;
  front-size: 20px;
}
.button1 {
  display: inline-block;
  padding: 10px 15px;
  border-radius: 8px;
  background-color: blue;
  background-size: 200%;
  background-position: 0%;
  transition: 0.4s;
  color: white;
  font-weight: 700;
  cursor: pointer;
  font-size: large;
}
</style>

<html>
    <head>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
<body>
    <div id="nav-placeholder">

</div>

<script>
$(function(){
  $("#nav-placeholder").load("navbar.html");
});
</script>
<div class="content">
    <h1> Patient History</h1>
<form method="POST" action="/DoctorPatientHistoryReport.php">
    <h2>Enter the patient ID:</h2>
<select name="d_patient">
<?php 
session_start();
$port = $_SERVER
['WEBSITE_MYSQL_PORT'];
$servername = "localhost:$port";
$username = "azure";
$password = "6#vWHD_$";
$db = "localdb";

$mysqli = new mysqli($servername,$username,$password,$db);
                    // Create connection
                    // Check connection
                    if ($mysqli->connect_error) {
                      die("Connection failed: " . $mysqli->connect_error);
                    }
$sql = "SELECT Patient FROM patientassigneddoctor WHERE Doctor = ".$_SESSION['use'];
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()){
echo '<option value= "'. $row['Patient'] .'">' . $row['Patient'] . '</option>';
}
?>
</select>
  <input class="button1" type="submit" value="Submit">
</form>
    <button onclick="document.location='doctorwelcome.php'" formtarget="_blank">Back to Home </button><br><br>
</div>
</body>
</html> 