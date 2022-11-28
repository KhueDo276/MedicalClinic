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
            Patient Registration
        </title>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
<body>
        <div id="nav-placeholder">
    </div>
<script>
$(function(){
  $("#nav-placeholder").load("navbar_admin.html");
});
</script>

<!--Patient form-->

        <div class="employee">
            <h1>Enter Patient Information </h1>
            <form action="test2.php" method="post">
                <div class="form">
                    <label>First Name:</label>
                    <span><input type="text" maxlength = "20" name="firstname" required><br></span>
                    <label>Middle Initial:</label>
                    <span><input type="text" maxlength = "1" name="middlei"><br></span>
                    <label>Last Name:</label>
                    <span><input type="text" maxlength = "20" name="lastname" required><br></span>
                </div>
                <div class="form">
                    <label>Ethinicity:</label>
                    <span><input type="text" maxlength = "45" name="ethnicity" required><br></span>
                    <label>Sex:</label>
                    <select name="sex" id="sex">
                        <option value = "0">Male</option>
                        <option value = "1">Female</option>
                    </select>
                </div>
                <div class="form">
                    <label>DOB:</label>
                    <span><input type='date' name='date' required><br></span>
                    <label>Weight:</label>
                    <span><input type="text" name="weight" required><br></span> 
                    <label>Height:</label>
                    <span><input type="text" maxlength = "6" name="height" required></span>
                </div>
                <div class="form">
                    <label>Address:</label>
                    <span><input type="text" maxlength = "45" name="address" required><br></span>
                    <label>Email:</label>
                    <span><input type="text" maxlength = "45" name="email"><br></span>
                    <label>Phone Number:</label>
                    <span><input type="text" maxlength = "11" name="phonenumber" required><br></span>
                </div>
                <div class="form">
                    <label>Last 4 SSN:</label>
                    <span><input type="text" maxlength = "4" name="SSN" required><br></span>
                    <label>Pharmacy Phone Number:</label>
                    <span><input type="text" maxlength = "11" name="phpn" required><br></span>
                </div>
                <div class="form">
                    
                    <label>Pharmacy Address:</label>
                    <span><input type="text" maxlength = "45" name="pha" required><br></span>
                    <label>Insurance ID:</label>
                    <span><input type="text" maxlength = "11" name="insid"><br></span>
                    <label>Insurance Name: </label>
                    <span><input type="text" maxlength = "45" name="insname"><br></span>
                </div>
                <button class="button1" name="create" type="submit" value="Submit">Submit</button>
            </form>
        </div>
        <div class="delete">
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
            $doctorresult = mysqli_query($mysqli,"SELECT CONCAT(Last_Name,' :' , Patient_Id) as name  FROM patient");
            while($drow = mysqli_fetch_assoc($doctorresult)) 
            {
            $dlisw[] = $drow;
            }
            $mysqli->close();
            ?>
            <h1>Delete a Patient's Information</h1>
            <form action="patient_admin.php" method="post">
            <?php
                    echo "
                    <div class='form'>
                    <label>Patient</label>
                    <span><select name='patient'>
                    <option value='' disabled selected>--select--</option>";
                    foreach($dlisw as $temp) {
                        echo "<option> $temp[name] </option>";
                    }
                    
                    echo "</select><br></span></div>";
                    ?>
            <button class="button1" name="delete" type="submit" value="delete">Delete</button>
            </form>
        </div>
        <div class="update">
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
            $doctorresult = mysqli_query($mysqli,"SELECT CONCAT(Last_Name,' :' , Patient_Id) as name  FROM patient");
            while($drow = mysqli_fetch_assoc($doctorresult)) 
            {
            $dlisw[] = $drow;
            }
            $mysqli->close();
            ?>
            <h1>Update a Patient's Information</h1>
            <form action="patient_admin.php" method="post">
                    <?php
                    echo "
                    <div class='form'>
                    <label>Patient</label>
                    <span><select name='patient'>
                    <option value='' disabled selected>--select--</option>";
                    foreach($dlisw as $temp) {
                        echo "<option> $temp[name] </option>";
                    }
                    
                    echo "</select><br></span></div>";
                    ?>
                    <div class="form">
                        
                    <label>First Name:</label>
                    <span><input type="text" maxlength = "20" name="firstname" required><br></span>
                    <label>Middle Initial:</label>
                    <span><input type="text" maxlength = "1" name="middlei"><br></span>
                    <label>Last Name:</label>
                    <span><input type="text" maxlength = "20" name="lastname" required><br></span>
                </div>
                <div class="form">
                    <label>Ethinicity:</label>
                    <span><input type="text" maxlength = "45" name="ethnicity" required><br></span>
                    <label>Sex:</label>
                    <select name="sex" id="sex">
                        <option value = "0">Male</option>
                        <option value = "1">Female</option>
                    </select>
                </div>
                <div class="form">
                    <label>DOB:</label>
                    <span><input type='date' name='date' required><br></span>
                    <label>Weight:</label>
                    <span><input type="text" name="weight" required><br></span> 
                    <label>Height:</label>
                    <span><input type="text" maxlength = "6" name="height" required></span>
                </div>
                <div class="form">
                    <label>Address:</label>
                    <span><input type="text" maxlength = "45" name="address" required><br></span>
                    <label>Email:</label>
                    <span><input type="text" maxlength = "45" name="email"><br></span>
                    <label>Phone Number:</label>
                    <span><input type="text" maxlength = "11" name="phonenumber" required><br></span>
                </div>
                <div class="form">
                    <label>Last 4 SSN:</label>
                    <span><input type="text" maxlength = "4" name="SSN" required><br></span>
                    <label>Pharmacy Phone Number:</label>
                    <span><input type="text" maxlength = "11" name="phpn" required><br></span>
                </div>
                <div class="form">
                    
                    <label>Pharmacy Address:</label>
                    <span><input type="text" maxlength = "45" name="pha" required><br></span>
                    <label>Insurance ID:</label>
                    <span><input type="text" maxlength = "11" name="insid"><br></span>
                    <label>Insurance Name: </label>
                    <span><input type="text" maxlength = "45" name="insname"><br></span>
                </div>
                <button class="button1" name="update" type="submit" value="Submit">Update</button>
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
        if (isset($_POST['create'])){
            $firstname = $_POST["firstname"];
            $middlei = $_POST["middlei"];
            echo $middlei;
            $lastname = $_POST["lastname"];
            echo $lastname;
            $address = $_POST["address"];
            $dob = $_POST["date"];
           
            $weight = $_POST["weight"];
            $height = $_POST["height"];
            $phpn = $_POST["phpn"];
            $pha = $_POST["pha"];
            $insuranceid = $_POST["insid"];
            $insurancename = $_POST["insname"]; 
            $email = $_POST["email"];
            $ethnicity = $_POST["ethnicity"];
            $phonenumber = $_POST["phonenumber"];
            $ssn = $_POST["SSN"];
            $sex = $_POST["sex"];
            $sql = "INSERT INTO patient (First_Name,Middle_Initial,Last_Name,DOB,Last_4_SSN,Weight,Height,Sex,Ethnicity,Pharmacist_Phone,Pharmacist_Address,Insurance_ID,Insurance_Name,Phone_Number,Email,Address) VALUES ('$firstname','$middlei','$lastname','$dob','$ssn','$weight','$height','$sex','$ethnicity','$phpn','$pha','$insuranceid','$insurancename','$phonenumber','$email','$address')";

            if ($mysqli->query($sql) === TRUE) {
                echo "New record created successfully";     
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
        elseif ($_POST['delete']){
            $patientid = $_POST["patient"];
            $variable = substr($patientid, strpos($patientid, ":")+1, (strlen($patientid) -strpos($patientid, ":")));
            $sql = "DELETE FROM patient WHERE Patient_ID=$variable";
        
            if ($mysqli->query($sql) === TRUE) {
                echo "Record deleted successfully";     
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
        elseif(isset($_POST['update'])){
            $patientid = $_POST["patient"];
            $variable = substr($patientid, strpos($patientid, ":")+1, (strlen($patientid) -strpos($patientid, ":")));
            $firstname = $_POST["firstname"];
            $middlei = $_POST["middlei"];
            //echo $middlei;
            $lastname = $_POST["lastname"];
            //echo $lastname;
            $address = $_POST["address"];
            $dob = $_POST["date"];
           
            $weight = $_POST["weight"];
            $height = $_POST["height"];
            $phpn = $_POST["phpn"];
            $pha = $_POST["pha"];
            $insuranceid = $_POST["insid"];
            $insurancename = $_POST["insname"]; 
            $email = $_POST["email"];
            $ethnicity = $_POST["ethnicity"];
            $phonenumber = $_POST["phonenumber"];
            $ssn = $_POST["SSN"];
            $sex = $_POST["sex"];

            $sql = "UPDATE patient SET First_Name='$firstname', Middle_Initial ='$middlei', Last_Name='$lastname', 
            Address='$address', DOB ='$dob', Weight='$weight', Height='$height',Pharmacist_Phone='$phpn',
            Pharmacist_Address='$pha', Insurance_ID='$insuranceid', Insurance_Name='$insurancename', Email ='$email',
            Ethnicity='$ethnicity', Phone_Number='$phonenumber', Last_4_SSN='$ssn', Sex='$sex' WHERE Patient_ID='$variable'";
            
            if ($mysqli->query($sql) === TRUE) {
                echo "Updated successfully";     
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
        // SQL query to select data from database
$sql1 = " SELECT * FROM patient";
$result = $mysqli->query($sql1);
$mysqli->close();
    ?>
        <section>
        <h1>Patient Data Information</h1>
        <!-- TABLE CONSTRUCTION -->
        <table>
            <tr>
                <th>First Name</th>
                <th>Middle Initial</th>
                <th>Last Name</th>
                <th>DOB</th>
                <th>Patient ID</th>
                <th>Last 4 SSN</th>
                <th>Weight</th>
                <th>Height</th>
                <th>Sex</th>
                <th>Ethnicity</th>
                <th>Pharmacist Phone</th>
                <th>Pharmacist Address</th>
                <th>Insurance ID</th>
                <th>Insurance Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Address</th>
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
                <td><?php echo $rows['First_Name'];?></td>
                <td><?php echo $rows['Middle_Initial'];?></td>
                <td><?php echo $rows['Last_Name'];?></td>
                <td><?php echo $rows['DOB'];?></td>
                <td><?php echo $rows['Patient_ID'];?></td>
                <td><?php echo $rows['Last_4_SSN'];?></td>
                <td><?php echo $rows['Weight'];?></td>
                <td><?php echo $rows['Height'];?></td>
                <td><?php echo $rows['Sex'];?></td>
                <td><?php echo $rows['Ethnicity'];?></td>
                <td><?php echo $rows['Pharmacist_Phone'];?></td>
                <td><?php echo $rows['Pharmacist_Address'];?></td>
                <td><?php echo $rows['Insurance_ID'];?></td>
                <td><?php echo $rows['Insurance_Name'];?></td>
                <td><?php echo $rows['Phone_Number'];?></td>
                <td><?php echo $rows['Email'];?></td>
                <td><?php echo $rows['Address'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
    </body>
</html>
     