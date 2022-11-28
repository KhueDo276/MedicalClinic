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
    <!--Navbar link-->
<div id="nav-placeholder"></div>
<script>
$(function(){
  $("#nav-placeholder").load("navbar_admin.html");
});
</script>
<div  class="employee">
    <h1>Employee Fill Out Form</h1>
        <form action="employee_ad.php"  method="post"> 
            <div class="form">
                <label>First Name:</label>
                <span><input type="text" maxlength="20" name="firstname" required><br></span> 
                <label>Middle Initial:</label>
                <span><input type="text" maxlength="1" name="middlei"><br></span>
                <label>Last Name:</label>
                <span><input type="text" maxlength="20" name="lastname" required><br></span>
            </div>
            <div class ="form">
                <label>Employee ID:</label>
                <span><input type="text" maxlength="11" name="employeeid"required><br></span>
                <label>Salary:</label>
                <span><input type="text" maxlength="11" name="salary"required><br></span>
                <label>Sex:</label>
                <select name="sex" id="sex">
                    <option value = "M">Male</option>
                    <option value = "F">Female</option>
                </select>
                <label>Ethinicity:</label>
                <span><input type="text" maxlength="45" name="ethnicity"><br></span>
            </div>
            <div class ="form">
                <label>Email:</label>
                <span><input type="text" maxlength="45" name="email"required><br></span>
                <label>Phone Number:</label>
                <span><input type="text" maxlength="11" name="phonenumber" required><br></span>
                <label>Job Type:</label>
                <select name="type" id="type">
                    <option value = "Doctor">Doctor</option>
                    <option value = "Nurse">Nurse</option>
                    <option value = "Other">Administrator</option>
                    <option value = "Other">Other</option>
                </select>
                <label>Last 4 SSN:</label>
                <span><input type="text" minlength = "4" maxlength="4" name="SSN" required><br></span>
            </div>
    </div>
<?php
$port = $_SERVER
    ['WEBSITE_MYSQL_PORT'];
    $servername = "localhost:$port";
    $username = "azure";
    $password = "6#vWHD_$";
    $db = "localdb";
    
    $mysqli = new mysqli($servername,$username,$password,$db);
    if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$result = mysqli_query($mysqli,"SELECT `Clinic_id` FROM `clinics`");
                    $list = [];
                    while($row = mysqli_fetch_assoc($result)) {
                        $list[] = $row;
                    }
                    //Monday pick
                    
                    //echo "<form action='employeeform.php' method='post'>";
                    echo"<h1> Choose the Clinic ID and the Day to Work</h1>";
                    echo "<p>";
                    echo "Monday:"; 
                    echo "<select name='Monday' id='Monday'>";
                    echo "<option selected='selected'>Choose one</option>";
                    foreach($list as $temp) {
                        echo "<option> $temp[Clinic_id] </option>";
                    }
                    echo "</select>";
                    
                    //Tuesday pick
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;Tuesday:";
                    echo "<select name='Tuesday' id='Tuesday'>";
                    echo "<option selected='selected'>Choose one</option>";
                    foreach($list as $temp) {
                        echo "<option> $temp[Clinic_id] </option>";
                    }
                    echo "</select>";
                    
                    //Wednesday pick
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;Wednesday:";
                    echo "<select name='Wednesday' id='Wednesday'>";
                    echo "<option selected='selected'>Choose one</option>";
                    foreach($list as $temp) {
                        echo "<option> $temp[Clinic_id] </option>";
                    }
                    echo "</select>";
                    
                    //Thursday pick
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;Thursday:";
                    echo "<select name='Thursday' id='Thursday'>";
                    echo "<option selected='selected'>Choose one</option>";
                    foreach($list as $temp) {
                        echo "<option> $temp[Clinic_id] </option>";
                    }
                    echo "</select>";
                    
                    //Friday pick
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;Friday:";
                    echo "<select name='Friday' id='Friday'>";
                    echo "<option selected='selected'>Choose one</option>";
                    foreach($list as $temp) {
                        echo "<option> $temp[Clinic_id] </option>";
                    }
                    echo "</select>";
                    echo "<input type = 'submit' class='button1' name='add' value = 'Enter Info'>";
                    echo "</form>";
// Username is root



    
 
// Checking for connections

 if (isset($_POST['add'])){
   $firstname = $_POST["firstname"];
        $middlei = $_POST["middlei"];
        echo $middlei;
        $lastname = $_POST["lastname"];
        echo $lastname;
        $employeeid = $_POST["employeeid"];
        $email = $_POST["email"];
        $salary = $_POST["salary"];
        $ethnicity = $_POST["ethnicity"];
        $phonenumber = $_POST["phonenumber"];
        $ssn = $_POST["SSN"];
        $sex = $_POST["sex"];
        $type = $_POST["type"];
        $sql = "INSERT INTO employees(First_Name,Middle_I,Last_Name,Employee_ID,Salary, Sex, Ethnicity, SSN, Type,email,Phone_Number) VALUES ('$firstname','$middlei','$lastname','$employeeid','$salary','$sex','$ethnicity','$ssn','$type','$email','$phonenumber')";
        
        if ($mysqli->query($sql) === TRUE) 
        {
   
        } 
    else 
    {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $Monday = $_POST["Monday"];
    $Tuesday = $_POST["Tuesday"];
    $Wednesday = $_POST["Wednesday"];
    $Thursday = $_POST["Thursday"];
    $Friday = $_POST["Friday"];
    $wsql = "INSERT INTO availability(D_ID,Monday,Tuesday,Wednesday,Thursday,Friday) VALUES ('$employeeid','$Monday','$Tuesday','$Wednesday','$Thursday','$Friday')";
        
        //either insert into doctors or employees, and match field names to that table
        if ($mysqli->query($wsql) === TRUE) {
    } else {
    echo "Error: " . $wsql . "<br>" . $mysqli->error;
    }
}
elseif ($_POST['delete']){
    $id = $_REQUEST["employee"];
    $variable = substr($id, strpos($id, ":")+1, (strlen($id) -strpos($id, ":")) );        
    $sql = "DELETE FROM employees WHERE Employee_ID='$variable'";
        
    if ($mysqli->query($sql) === TRUE) 
    {
      
    } 
    else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}
elseif(isset($_POST['update'])){
        $employeeid = $_POST["employee"];
        $variable = substr($employeeid, strpos($employeeid, ":")+1, (strlen($employeeid) -strpos($employeeid, ":")));
        $firstname = $_POST["firstname"];
        $middlei = $_POST["middlei"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $salary = $_POST["salary"];
        $ethnicity = $_POST["ethnicity"];
        $phonenumber = $_POST["phonenumber"];
        $ssn = $_POST["SSN"];
        $sex = $_POST["sex"];
        $type = $_POST["type"];

            $sql = "UPDATE employees SET First_Name='$firstname', Middle_I ='$middlei', Last_Name='$lastname', 
            Salary='$salary', Sex='$sex', Ethnicity='$ethnicity',SSN='$ssn', Type='$type', email ='$email'
            ,Phone_Number='$phonenumber' WHERE Employee_ID='$variable'";
            
            if ($mysqli->query($sql) === TRUE) {
                echo "Updated successfully";     
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }

// SQL query to select data from database


?>
<div class="delete">
    <?php
    $doctorresult = mysqli_query($mysqli,"SELECT CONCAT(Last_Name,' :' , Employee_ID) as name  FROM employees");
        while($drow = mysqli_fetch_assoc($doctorresult)) 
        {
            $dlisw[] = $drow;
        }
        
        ?>
         <h1>Delete a Employee's Information</h1>
            <form action="employee_ad.php" method="post">
            <div class="form">
            <?php
            echo " <label>Employee:</label>
                    <select name='employee'>
                    <option value='' disabled selected>--select--</option>";
                    foreach($dlisw as $temp) {
                        echo "<option> $temp[name] </option>";
                    }
                    echo "</select>";?>   
            <button class="button1" name="delete" type="submit" value="delete">Delete</button>
            </form>
        </div>
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
            $result = mysqli_query($mysqli,"SELECT CONCAT(Last_Name,' :' , Employee_ID) as name  FROM employees");
            while($drow = mysqli_fetch_assoc($result)) 
            {
            $dlisw[] = $drow;
            }
            ?>
            <h1>Update a Employee's Information</h1>
            <form action="employee_ad.php" method="post">
                    <?php
                    echo "
                    <div class='form'>
                    <label>Employee: </label>
                    <span><select name='employee'>
                    <option value='' disabled selected>--select--</option>";
                    foreach($dlisw as $temp) {
                        echo "<option> $temp[name] </option>";
                    }
                    
                    echo "</select><br></span></div>";
                    ?>
                    <div class="form">
                <label>First Name:</label>
                <span><input type="text" maxlength="20" name="firstname" required><br></span> 
                <label>Middle Initial:</label>
                <span><input type="text" maxlength="1" name="middlei"><br></span>
                <label>Last Name:</label>
                <span><input type="text" maxlength="20" name="lastname" required><br></span>
            </div>
            <div class ="form">
                <label>Salary:</label>
                <span><input type="text" maxlength="11" name="salary"required><br></span>
                <label>Sex:</label>
                <select name="sex" id="sex">
                    <option value = "M">Male</option>
                    <option value = "F">Female</option>
                </select>
                <label>Ethinicity:</label>
                <span><input type="text" maxlength="45" name="ethnicity"><br></span>
            </div>
            <div class ="form">
                <label>Email:</label>
                <span><input type="text" maxlength="45" name="email" required><br></span>
                <label>Phone Number:</label>
                <span><input type="text" maxlength="10" name="phonenumber" required><br></span>
                <label>Job Type:</label>
                <select name="type" id="type">
                    <option value = "Doctor">Doctor</option>
                    <option value = "Nurse">Nurse</option>
                    <option value = "Other">Administrator</option>
                    <option value = "Other">Other</option>
                </select>
                <label>Last 4 SSN:</label>
                <span><input type="text" minlength = "4" maxlength="4" name="SSN" required><br></span>
                <button class="button1" name="update" type="submit" value="update">Update</button>
            </div>
    </div>

    <section>
        <h1>Employee Data Information</h1>
        <!-- TABLE CONSTRUCTION -->
        <table>
            <tr>
                <th>Employee ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Middle Initial</th>
                <th>Sex</th>
                <th>Salary</th>
                <th>Ethnicity</th>
                <th>Title</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Last 4 SSN</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
                $sql1 = "SELECT * FROM employees";
                $result = $mysqli->query($sql1);
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $rows['Employee_ID'];?></td>
                <td><?php echo $rows['First_Name'];?></td>
                <td><?php echo $rows['Last_Name'];?></td>
                <td><?php echo $rows['Middle_I'];?></td>
                <td><?php echo $rows['Sex'];?></td>
                <td><?php echo $rows['Salary'];?></td>
                <td><?php echo $rows['Ethnicity'];?></td>
                <td><?php echo $rows['Type'];?></td>
                <td><?php echo $rows['email'];?></td>
                <td><?php echo $rows['Phone_Number'];?></td>
                <td><?php echo $rows['SSN'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>
</html>

 
