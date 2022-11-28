
<!-- this is the page for referrals -->
<?php
        $port = $_SERVER
        ['WEBSITE_MYSQL_PORT'];
        $servername = "localhost:$port";
        $username = "azure";
        $password = "6#vWHD_$";
        $db = "localdb";
        session_start();
        $patientid = $_SESSION['patient'];
        $mysqli = new mysqli($servername,$username,$password,$db);
        // Create connection
        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
            }
        $doctorresult = mysqli_query($mysqli,"SELECT CONCAT(Last_Name,' :',Employee_ID) as name  FROM employees WHERE Type = 'Doctor'");
        while($drow = mysqli_fetch_assoc($doctorresult)) 
        {
            $dlisw[] = $drow;
        }
        $result = mysqli_query($mysqli,"SELECT Adress FROM clinics");
        $list = [];
        while($row = mysqli_fetch_assoc($result)) 
        {
            $list[] = $row;
        }
                      
            // -- creating select query for table --
            $sqlSELECT = " SELECT * FROM referrals ";
            $result = $mysqli->query($sqlSELECT);
    ?>  
    
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
  /*margin-bottom: 100px;*/
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
  /*justify-content:center;*/
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
  /*justify-content: center;*/
  align-items: center;
  object-fit: contain;
  position: absolute;
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
  $("#nav-placeholder").load("navbar_patient.html");
});
</script>
<?php 
       echo " <div class='employee'>
            <h1>Enter Patient Information </h1>
            <form action='Referral_patienttwo.php' method='post'>
                <div class='form'>
                    <label>Doctor</label>
                    <select name='doctorname'>
                    <option value='' disabled selected>--select--</option>";
                    foreach($dlisw as $temp) {
                        echo "<option> $temp[name] </option>";
                    }
                    echo "</select>
                    <label>Receiving Doctor</label>
                    <select name='receivingdoctorname'>
                    <option value='' disabled selected>--select--</option>";
                    foreach($dlisw as $drtemp) {
                        echo "<option> $drtemp[name] </option>";
                    }
                    echo "</select>
                    
                </div>
                <button class= 'button1' name='create' type='submit' value='Submit'>Submit</button>
            </form>
        </div> ";
        $pa = $_SESSION['patient'];
     $sql1 = " SELECT * FROM patientassigneddoctor WHERE Patient = '$pa'";
$result = $mysqli->query($sql1);
$mysqli->close();
?>
    <section>
        <h1>Referral Data Information</h1>
        <!-- TABLE CONSTRUCTION -->
        <table>
            <tr>
                <th>You</th>
                <th>Doctor</th>
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
                <td><?php echo $rows['Patient'];?></td><td>
                    <?php echo $rows['Doctor'];?></td>
                
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
    </body>
</html>
    