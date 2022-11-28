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
        $ddoctorid = $_POST["employee"];
        $port = $_SERVER
        ['WEBSITE_MYSQL_PORT'];
        $servername = "localhost:$port";
        $username = "azure";
        $password = "6#vWHD_$";
        $db = "localdb";
        $doctorid = $_SESSION['use'];
        $owerid = $_POST["patient"];
        $patientid = substr($owerid, strpos($owerid, ":")+1, (strlen($owerid) -strpos($owerid, ":")) );
        
        $list = substr($ddoctorid, strpos($ddoctorid, ":")+1, (strlen($ddoctorid) -strpos($ddoctorid, ":")) );
        
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
        
   if ($list ==  $doctorid)
   {
       echo "You have accidentaly selected yourself, please go back";
   }
    
    $result = mysqli_query($mysqli,"SELECT  Monday FROM availability WHERE D_ID = '$list'");
    $mlist;
    while($row = mysqli_fetch_assoc($result)) 
    {
    $mlist = $row["Monday"];
    }

    $result = mysqli_query($mysqli,"SELECT  Tuesday FROM availability WHERE D_ID = '$list'");
    $tlist;
    while($row = mysqli_fetch_assoc($result)) 
    {
    $tlist = $row["Tuesday"];
    }
    
    $result = mysqli_query($mysqli,"SELECT Wednesday FROM availability WHERE D_ID = '$list'");
    $wlist;
    while($row = mysqli_fetch_assoc($result)) 
    {
    $wlist = $row["Wednesday"];
    }
    
    $result = mysqli_query($mysqli,"SELECT  Thursday FROM availability WHERE D_ID = '$list'");
    $thlist;
    while($row = mysqli_fetch_assoc($result)) 
    {
    $thlist = $row["Thursday"];
    }
    
    $result = mysqli_query($mysqli,"SELECT Friday FROM availability WHERE D_ID = '$list'");
    $flist;
    while($row = mysqli_fetch_assoc($result)) 
    {
    $flist = $row["Friday"];
    }
    $clinic = [];
    $result = mysqli_query($mysqli,"SELECT Adress FROM clinics WHERE Clinic_Id = '$mlist'");
    while($row = mysqli_fetch_assoc($result)) 
    {
    $clinic[] = $row;
    }
    if ($mlist != $tlist)
    {
        $result = mysqli_query($mysqli,"SELECT Adress FROM clinics WHERE Clinic_Id = '$tlist'");
        while($row = mysqli_fetch_assoc($result)) 
        {
            
            $clinic[] = $row;
        }
    }
    if ($mlist != $wlist)
    {
        $result = mysqli_query($mysqli,"SELECT Adress FROM clinics WHERE Clinic_Id = '$wlist'");
        while($row = mysqli_fetch_assoc($result)) 
        {
            
            $clinic[] = $row;
        }
    }
    if ($mlist != $thlist)
    {
        $result = mysqli_query($mysqli,"SELECT Adress FROM clinics WHERE Clinic_Id = '$thlist'");
        while($row = mysqli_fetch_assoc($result)) 
        {
            
            $clinic[] = $row;
        }
    }
    if ($mlist != $flist)
    {
        $result = mysqli_query($mysqli,"SELECT Adress FROM clinics WHERE Clinic_Id = '$flist'");
        while($row = mysqli_fetch_assoc($result)) 
        {
            
            $clinic[] = $row;
        }
    }
    echo " 
        <div class='employee'>
        <h1> Choose Clinic Location </h1>
        <form action='referral_doctorthree.php' method='post'>
            <div class='form'>
                <label>Clinic</label>
                <select name='clinic'>
                <option value='' disabled selected>--select--</option>";
                foreach($clinic as $ntemp)
                {
                     echo "<option> $ntemp[Adress]</option>";
                }
        echo "      
        </select>
        </div>
        <input type='hidden' value= '$patientid' name='patientid'/>
        <input type='hidden' value= '$mlist' name='mondayid'/>
        <input type='hidden' value= '$tlist' name='tuesdayid'/>
        <input type='hidden' value= '$wlist' name='wednesdayid'/>
        <input type='hidden' value= '$thlist' name='thursdayid'/>
        <input type='hidden' value= '$flist' name='fridayid'/>
        <input type='hidden' value= '$list' name='receivingid'/>
        <button class= 'button1' name='send' type='submit' value='Submit'>Submit</button>
        </form>
        </div>
            ";
?>
            </form>
        </div>
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
    
       