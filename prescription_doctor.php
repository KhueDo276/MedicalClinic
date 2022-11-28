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
<?php
$port = $_SERVER
    ['WEBSITE_MYSQL_PORT'];
    $servername = "localhost:$port";
    $username = "azure";
    $password = "6#vWHD_$";
    $db = "localdb";
    session_start();
    $doctorid = $_SESSION["use"];
        //error when inputting date from the billing form on web app
        
    $mysqli = new mysqli($servername,$username,$password,$db);
        // Create connection
        // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
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
        ?>
<div class="employee">
    <h1>Prescription Information</h1>
        <form action="prescription_doctor.php" method="post"> 
            <div class="form">
                <label>Patient:</label>
                <?php
                    echo " <select name='patient'>
                    <option value='' disabled selected>--select--</option>";
                    foreach($dlisw as $temp) 
                    {
                        echo "<option> $temp[name] </option>";
                    }
                    echo "</select>";
                    ?>
                <label>Medicine:</label>
                <span><input type="text" maxlength="45" name="medicinename" required><br></span>
                <label>Amount:</label>
                <span><input type="text" maxlength="6" name="amount" required><br></span>
                <label>Refills Left:</label>
                <span><input type="text" maxlength="6" name="refills"><br></span>
            </div>
            <button class= "button1" type="submit" name="create" value="Submit">Submit</button>
        </form>
        <div class="delete">
            <?php
            $doctorid = $_SESSION["use"];

            $deleteresult = mysqli_query($mysqli,"SELECT Patient_ID as patient  FROM prescription WHERE Prescriber_ID = '$doctorid'");
            while($deleterow = mysqli_fetch_assoc($deleteresult)) 
            {
                $deletelist[] = $deleterow;
            }
            foreach($deletelist as $deletetemp)
            {
                $deleteid = $deletetemp["patient"];
                $deleteresulttwo = mysqli_query($mysqli,"SELECT CONCAT(Last_Name,' :' , Patient_Id) as name  FROM patient WHERE Patient_ID = '$deleteid'");
                while($deleterowtwo = mysqli_fetch_assoc($deleteresulttwo)) 
                {
                    $deletelisttwo[] = $deleterowtwo;
                }
            }
            $deletemresult = mysqli_query($mysqli,"SELECT Medicine_Name as med  FROM prescription WHERE Prescriber_ID = '$doctorid'");
            while($deletemrow = mysqli_fetch_assoc($deletemresult)) 
            {
            $deletemlist[] = $deletemrow;
            }
            ?>
            <h1>Delete a Patient's Information</h1>
            <form action="prescription_doctor.php" method="post">
                <div class="form">
                    <?php
                    echo "
                    <div class='form'>
                    <label>Patient ID: </label>
                    <span><select name='patient'>
                    <option value='' disabled selected>--select--</option>";
                    foreach($deletelisttwo as $deletetemptwo) {
                        echo "<option> $deletetemptwo[name] </option>";
                    }
                    
                    echo "</select><br></span>
                    <label>Medicine: </label>
                    <span><select name='med'>
                    <option value='' disabled selected>--select--</option>";
                    foreach($deletemlist as $deletemtemp) {
                        echo "<option> $deletemtemp[med] </option>";
                    }
                    
                    echo "</select><br></span>";
                    ?>
                </div>
                <button class= "button1" name="delete" type="submit" value="delete">Delete</button>
            </form>
        </div>
</div>

<?php
    
    if (isset($_POST['create'])){    
        $patientid = $_POST["patient"];
        $prescriberID = $_POST["prescriberID"];
        $medicinename = $_POST["medicinename"];
        $amount = $_POST["amount"];
        $refills = $_POST["refills"];
        $doctorid = $_SESSION["use"];
        $patient = substr($patientid, strpos($patientid, ":")+1, (strlen($patientid) -strpos($patientid, ":")) );
        $sql = "INSERT INTO prescription (Patient_ID,Prescriber_ID,Medicine_Name, Amount, Refills_left) VALUES ('$patient','$doctorid','$medicinename','$amount','$refills')";
       
        if ($mysqli->query($sql) === TRUE) {
            echo "New record created successfully";     
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }  
    }
    elseif ($_POST['delete']){   //not working for this form currently
            $patientid = $_REQUEST["patient"];
            $medicine = $_REQUEST["med"];
            $patient = substr($patientid, strpos($patientid, ":")+1, (strlen($patientid) -strpos($patientid, ":")) );
            $sql = "DELETE FROM prescription WHERE Patient_ID='$patient' AND Medicine_Name = '$medicine'";
        
            if ($mysqli->query($sql) === TRUE) {
                if ($mysqli -> affected_rows == 0)
                {
                    echo "Nothing has changed, the medicine is not being taken by the patient";
                    
                }
                else{
                echo "Record deleted successfully";
                //Header('Location: '.$_SERVER['PHP_SELF']);
                windows.reload();
                }    
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
    elseif(isset($_POST['update'])){
        $patientid = $_POST["patient"];
        $patient = substr($patientid, strpos($patientid, ":")+1, (strlen($patientid) -strpos($patientid, ":")) );
        $prescriberID = $_POST["prescriberID"];
        $medicinename = $_POST["medicinename"];
        $amount = $_POST["amount"];
        $refills = $_POST["refills"];

            $sql = "UPDATE prescription SET Prescriber_ID='$prescriberID',
            Medicine_Name='$medicinename', Amount='$amount', Refills_left='$refills' WHERE Patient_ID='$patient' AND Medicine_Name='$medicinename'";
            
            if ($mysqli->query($sql) === TRUE) {
                echo "Updated successfully";     
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
        
    // SQL query to select data from database

?>
<div class="update">
            <?php
            $doctorid = $_SESSION["use"];
            
            
            $updateresult = mysqli_query($mysqli,"SELECT Patient_ID as patient  FROM prescription WHERE Prescriber_ID = '$doctorid'");
            while($updaterow = mysqli_fetch_assoc($updateresult)) 
            {
            $updatelist[] = $updaterow;
            }
            foreach($updatelist as $updatetemp)
            {
            $updateid = $updatetemp["patient"];
            
            $updateresulttwo = mysqli_query($mysqli,"SELECT CONCAT(Last_Name,' :' , Patient_Id) as name  FROM patient WHERE Patient_ID = '$updateid'");
            while($updaterowtwo = mysqli_fetch_assoc($updateresulttwo)) 
            {
                $updatelisttwo[] = $updaterowtwo;
            }
         }
            ?>
            <h1>Update a Employee's Information</h1>
            <form action="prescription_doctor.php" method="post">
                    <?php
                    echo "
                    <div class='form'>
                    <label>Patient ID: </label>
                    <span><select name='patient'>
                    <option value='' disabled selected>--select--</option>";
                    foreach($updatelisttwo as $updatetemptwo) {
                        echo "<option> $updatetemptwo[name] </option>";
                    }
                    
                    echo "</select><br></span></div>";
                    ?>
                    <div class="form">
                <label>Prescriber ID:</label>
                <span><input type="text" maxlength="11" name="prescriberID" required><br></span>
                <label>Medicine Name:</label>
                <span><input type="text" maxlength="45" name="medicinename" required><br></span>
                <label>Amount:</label>
                <span><input type="text" maxlength="6" name="amount" required><br></span>
                <label>Refills Left:</label>
                <span><input type="text" maxlength="6" name="refills"><br></span>
            </div>
            <button class= "button1" type="submit" name="update" value="Submit">Update</button>
    <section>
        <h1>Medicine Data Information</h1>
        <!-- TABLE CONSTRUCTION -->
        <table>
            <tr>
                <th>Patient ID</th>
                <th>Prescriber ID</th>
                <th>Medicine Name</th>
                <th>Amount</th>
                <th>Refills Left</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
                $sql1 = " SELECT * FROM prescription";
                $result = $mysqli->query($sql1);
                $mysqli->close();
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $rows['Patient_ID'];?></td>
                <td><?php echo $rows['Prescriber_ID'];?></td>
                <td><?php echo $rows['Medicine_Name'];?></td>
                <td><?php echo $rows['Amount'];?></td>
                <td><?php echo $rows['Refills_Left'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
    </body>
</html>