<style>
.employee {
  height: 100vh;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  object-fit: contain;
  position: absolute;
  top: 0;
}
h1 {
  background-image: linear-gradient(to left, #ce2dc6, #0e067a);
  color: transparent;
  background-clip: text;
  -webkit-background-clip: text;
  margin-bottom: 100px;
}
form{
    text-align:center;
}
.form {
  display: grid;
  grid-template-columns: repeat(4, auto);
  grid-gap: 11px;
  list-style: none;
  text-align: center;
  width: 60vw;
  justify-content:center;
  margin-right: 2rem;
  margin-bottom: 50px;
}

label {
  display: block;
  color: #0e067a;
  margin-bottom: 5px;
  transition: 0.4s;
  float: left;
  font-size: 18px;
}
.employee:focus-within label {
  color: #ce2dc6;
}

.employee:focus-within input {
  color: black;
}
.button1 {
  display: inline-block;
  padding: 10px 15px;
  border-radius: 8px;
  background-image: linear-gradient(to right, #ce2dc6, #0e067a);
  background-size: 200%;
  background-position: 0%;
  transition: 0.4s;
  color: white;
  font-weight: 700;
  cursor: pointer;
  font-size: large;
  margin-top: 100px;
  /*margin-bottom: 50px;*/
}
.delete{
    margin-top: 750px;
    height: 50vh;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  object-fit: contain;
  position: absolute;
}
</style>

<html>
    <head>
        <title>
            Referrals
        </title>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>

<body>
    <!--Navbar link-->
<div id="nav-placeholder">
    </div>
<script>
$(function(){
  $("#nav-placeholder").load("navbar_patient.html");
});
</script>
<?php 
    $port = $_SERVER['WEBSITE_MYSQL_PORT'];
    $servername = "localhost:$port";
    $username = "azure";
    $password = "6#vWHD_$";
    $db = "localdb";
    session_start();
    $patientid = $_SESSION['patientid'];
    $rdoctorid = $_POST['receivingid'];
    $doctorid = $_POST['doctorid'];
    $monday = $_POST['mondayid'];
    $tuesday = $_POST['tuesdayid'];
    $wednesday = $_POST['wednesdayid'];
    $thursday = $_POST['thursdayid'];
    $friday = $_POST['fridayid'];
    $clinica = $_POST['clinic'];
    
    $mysqli = new mysqli($servername,$username,$password,$db);
        // Create connection
        // Check connection
    if ($mysqli->connect_error) 
    {
        die("Connection failed: " . $mysqli->connect_error);
    }
    $clinicresult = mysqli_query($mysqli,"SELECT Clinic_Id FROM clinics WHERE Adress = '$clinica'");
                    while($crow = mysqli_fetch_assoc($clinicresult)) {
                        $clinic = $crow["Clinic_Id"];
                    }
    $dresult = mysqli_query($mysqli,"SELECT Last_Name FROM employees WHERE Employee_ID = '$rdoctorid'");
                    while($cdrow = mysqli_fetch_assoc($dresult)) {
                        $name = $cdrow["Last_Name"];
                    }
    $dayworked = [];
                    if ($monday == $clinic)
                    {
                        $dayworked[] = "Monday";
                    }
                    if ($tuesday == $clinic)
                    {
                        $dayworked[] = "Tuesday";
            
                    }
                    if ($wednesday == $clinic)
                    {
                        $dayworked[] = "Wednesday";
                    }
                    if ($thursday == $clinic)
                    {
                        $dayworked[] = "Thursday";
                    }
                    if ($friday == $clinic)
                    {
                        $dayworked[] = "Friday";
                    }
                    echo "Dr. ". $name. " CAN ONLY WORK ON: "."<br>";
                    foreach($dayworked as $dtemp)
                    {echo $dtemp . "<br>";}
    echo " 
        <div class='employee'>
        <h1> Choose Clinic Location </h1>
        <form action='Referral_patientfour.php' method='post'>
            <div class='form'>
                <label>Date</label>
                <input type='date'  name='date'>
        </div>
        <input type='hidden' value= '$monday' name='mondayid'/>
        <input type='hidden' value= '$tuesday' name='tuesdayid'/>
        <input type='hidden' value= '$wednesday' name='wednesdayid'/>
        <input type='hidden' value= '$thursday' name='thursdayid'/>
        <input type='hidden' value= '$friday' name='fridayid'/>
        <input type='hidden' value= '$rdoctorid' name='receivingid'/>
        <input type='hidden' value= '$doctorid' name='doctorid'/>
        <input type='hidden' value= '$clinic' name='clinicid'/>
        <button class= 'button1' name='send' type='submit' value='Submit'>Submit</button>
        </form>
        </div>
            ";
?>
        
    </body>
</html>
    