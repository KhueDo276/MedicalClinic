<!-- this is the page for referrals -->
<style>
form{
    text-align:center;
}
.form {
  display: grid;
  grid-template-columns: repeat(8, auto);
  grid-gap: 11px;
  list-style: none;
  text-align: center;
  width: 60vw;
  justify-content: center;
  margin-right: 2rem;
  margin-bottom: 50px;
}
label {
  display: block;
  color: #0e067a;
  margin-bottom: 5px;
  transition: 0.4s;
  /*float: left;*/
  font-size: 18px;
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

table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
 
        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
 
        td {
            background-color: #E4F5D4;
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
 
        td {
            font-weight: lighter;
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
  $("#nav-placeholder").load("navbar.html");
});
</script>

<?php 
    $port = $_SERVER['WEBSITE_MYSQL_PORT'];
    $servername = "localhost:$port";
    $username = "azure";
    $password = "6#vWHD_$";
    $db = "localdb";
    session_start();
    $doctorid = $_SESSION['use'];
    $patientid = $_POST["patientid"]; 
    $rdoctorid = $_POST['receivingid'];
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
    
    $dresult = mysqli_query($mysqli,"SELECT Last_Name FROM employees WHERE Employee_ID = '$rdoctorid'");
                    while($cdrow = mysqli_fetch_assoc($dresult)) {
                        $name = $cdrow["Last_Name"];
                    }
    $clinicresult = mysqli_query($mysqli,"SELECT Clinic_Id FROM clinics WHERE Adress = '$clinica'");
                    while($crow = mysqli_fetch_assoc($clinicresult)) {
                        $clinic = $crow["Clinic_Id"];
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
        <form action='referral_doctorfour.php' method='post'>
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
        <input type='hidden' value= '$patientid' name='patientid'/>
        <input type='hidden' value= '$clinic' name='clinicid'/>
        <button class= 'button1' name='send' type='submit' value='Submit'>Submit</button>
        </form>
        </div>
            ";
?>
        <div class="delete">
            <h1>Delete a Patient's Information</h1>
            <form action="referral_doctor.php" method="post">
                <div class="form">
                    <label>Patient ID:</label>
                    <span><input type="text" maxlength = "11" name="patientid" required><br></span>
                </div>
                <button class= "button1" name="delete" type="submit" value="delete">Delete</button>
            </form>
        </div>

<?php
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
            
            // -- creating select query for table --
            $sqlSELECT = " SELECT * FROM referrals ";
            $result = $mysqli->query($sqlSELECT);
            //'
            if ($_POST['delete']){
            $patientid = $_REQUEST["patientid"];
            
            $sql = "DELETE FROM referrals WHERE Patient=$patientid";
        
            if ($mysqli->query($sql) === TRUE) {
                echo "Record deleted successfully";     
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
            // SQL query to select data from database
$sql1 = " SELECT * FROM referrals";
$result = $mysqli->query($sql1);
$mysqli->close();
?>
    <section>
        <h1>Employee Data Information</h1>
        <!-- TABLE CONSTRUCTION -->
        <table>
            <tr>
                <th>Referral ID</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Receiving ID</th>
                <th>Address ID</th>
                <th>Approval</th>
                <th>Date</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $rows['ref_id'];?></td>
                <td><?php echo $rows['Patient'];?></td>
                <td><?php echo $rows['Doctor'];?></td>
                <td><?php echo $rows['Receiving_Doctor'];?></td>
                <td><?php echo $rows['Address_Id'];?></td>
                <td><?php echo $rows['Approval'];?></td>
                <td><?php echo $rows['DATE'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
    </body>
</html>
    