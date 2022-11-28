
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
        session_start();
        $port = $_SERVER
        ['WEBSITE_MYSQL_PORT'];
        $servername = "localhost:$port";
        $username = "azure";
        $password = "6#vWHD_$";
        $db = "localdb";
        $doctorid = $_SESSION['use'];
        $mysqli = new mysqli($servername,$username,$password,$db);
        // Create connection
        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
            }
            
            // -- creating select query for table --
            $sqlSELECT = " SELECT * FROM referrals ";
            $result = $mysqli->query($sqlSELECT);
            //
        $doctorresult = mysqli_query($mysqli,"SELECT Patient as patient  FROM patientassigneddoctor WHERE Doctor = '$doctorid'");
        while($crow = mysqli_fetch_assoc($doctorresult)) 
        {
            $clisw[] = $crow;
        }
        
        foreach($clisw as $temp)
        {
            $id = $temp["patient"];
            
            $doctorresult = mysqli_query($mysqli,"SELECT CONCAT(Last_Name,' :' , Patient_Id) as name  FROM patient WHERE Patient_ID = '$id'");
            while($drow = mysqli_fetch_assoc($doctorresult)) 
            {
                $dlisw[] = $drow;
            }
        }
        $doctorresult = mysqli_query($mysqli,"SELECT CONCAT(Last_Name,' :' , Employee_ID) as name  FROM employees");
        while($ddrow = mysqli_fetch_assoc($doctorresult)) 
        {
            $ddlisw[] = $ddrow;
        }
        $doctorresult = mysqli_query($mysqli,"SELECT ref_id as ID FROM referrals WHERE Doctor = '$doctorid'");
        while($dddrow = mysqli_fetch_assoc($doctorresult)) 
        {
            $dddlisw[] = $dddrow;
        }
        $mysqli->close();
        ?>
        
        <div class="employee">
            <h1>Enter Patient Information </h1>
            <form action="referral_doctor2.php" method="post">
                <div class="form">
                    
                <label>Patient:</label>
                <?php
                    echo " <select name='patient'>
                    <option value='' disabled selected>--select--</option>";
                    foreach($dlisw as $temp) 
                    {
                        echo "<option> $temp[name] </option>";
                    }
                    echo "</select>"
                    ?>
                </div>
                <div class="form">
                    <?php
                echo " <label>Employee:</label>
                    <select name='employee'>
                    <option value='' disabled selected>--select--</option>";
                    foreach($ddlisw as $temp) {
                        echo "<option> $temp[name] </option>";
                    }
                    echo "</select>";?> 
                </div>
                <button class= "button1" name="create" type="submit" value="Submit">Submit</button>
            </form>
        </div>
        <div class="delete">
            <h1>Delete a Patient's referral Information</h1>
            <form action="referral_doctor.php" method="post">
                <div class="form">
                    <label>Patient:</label>
                    <?php
                    echo " <select name='id'>
                    <option value='' disabled selected>--select--</option>";
                    foreach($dddlisw as $temp) 
                    {
                        echo "<option> $temp[ID] </option>";
                    }
                    echo "</select>"
                    ?>
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
            //
            
        if ($_POST['delete']){
            $patientid = $_REQUEST["id"];
            
            $sql = "DELETE FROM referrals WHERE ref_id=$patientid";
        
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
        <h1>Referral Data Information</h1>
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
    
       