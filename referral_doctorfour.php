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
    $patientid = $_POST['patientid'];
    $rdoctorid = $_POST['receivingid'];
    $doctorid = $_SESSION['use'];
    $monday = $_POST['mondayid'];
    $tuesday = $_POST['tuesdayid'];
    $wednesday = $_POST['wednesdayid'];
    $thursday = $_POST['thursdayid'];
    $friday = $_POST['fridayid'];
    $wclinic = $_POST['clinicid'];
    $date = $_POST['date'];
    
    $mysqli = new mysqli($servername,$username,$password,$db);
        // Create connection
        // Check connection
    if ($mysqli->connect_error) 
    {
        die("Connection failed: " . $mysqli->connect_error);
    }
$wdayworked = [];
                    if ($monday == $wclinic)
                    {
                        $wdayworked[] = "Monday";
                    }
                    if ($tuesday == $wclinic)
                    {
                        $wdayworked[] = "Tuesday";
            
                    }
                    if ($wednesday == $wclinic)
                    {
                        $wdayworked[] = "Wednesday";
                    }
                    if ($thursday == $wclinic)
                    {
                        $wdayworked[] = "Thursday";
                    }
                    if ($friday == $wclinic)
                    {
                        $wdayworked[] = "Friday";
                    }
                    
                    $paymentDate = $date;
                    
                    $day = date('l', strtotime($paymentDate));
                    $good = false;
                    foreach($wdayworked as $dtemp)
                    {
                        if ($day == $dtemp)
                    {
                        $good = true;
                        
                    }
                    }
                    if ($good == false)
                    {
                        if ($doctorid==$rdoctorid)
                        {
                            Header('Location:https://medicalgroup.azurewebsites.net/referral_doctor.php');
                        }
                        else{
                        echo "Hello Doctor, You put the wrong day in";
                        echo "<form action = '/referral_doctor.php'>";
                        echo "<button class ='button1' type='submit' name = 'Submit'>Go-Back</button>";
                        echo "</form>";}
                    }
                    elseif ($good == true)
                    {   
                        if ($doctorid==$rdoctorid)
                        {
                            Header('Location:https://medicalgroup.azurewebsites.net/referral_doctor.php');
                        }
                        else{
                        $sql = "INSERT INTO referrals(Patient,Doctor, Receiving_Doctor,Address_Id,Date) VALUES ('$patientid','$doctorid','$rdoctorid','$wclinic','$date')";}
                if ($mysqli->query($sql) === TRUE) 
                {
                echo "New record created successfully";     
                } 
                else
                {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
                }
                    }
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