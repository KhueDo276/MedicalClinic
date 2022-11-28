   <style>
   .employee{
       text-align:center;
   }
form{
    text-align:center;
}
.form {
  display: grid;
  grid-template-columns: repeat(6, auto);
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
</div>
<?php
$port = $_SERVER
        ['WEBSITE_MYSQL_PORT'];
        $servername = "localhost:$port";
        $username = "azure";
        $password = "6#vWHD_$";
        $db = "localdb";
        session_start();
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
        $doctorresult = mysqli_query($mysqli,"SELECT Adress as cname  FROM clinics");
        while($drow = mysqli_fetch_assoc($doctorresult)) 
        {
            $ddlisw[] = $drow;
        }
        echo " <div class='employee'>
            <h1>Enter Patient Billing Information </h1>
            <form action='billing_admin.php' method='post'>
                <div class='form'>
                    <label>Patient</label>
                    <select name='patient'>
                    <option value='' disabled selected>--select--</option>";
                    foreach($dlisw as $temp) {
                        echo "<option> $temp[name] </option>";
                    }
                    echo "</select>
                    <label>Clinic:</label>
                    <select name='clinic'>
                    <option value='' disabled selected>--select--</option>";
                    foreach($ddlisw as $temp) {
                        echo "<option> $temp[cname] </option>";
                    }
                    echo "</select
                    <label>Due Date:</label>
                    <span><input type='date' name='date' required><br></span>
                    <label>Amount Due: $</label>
                    <span><input type='text' name='amount' required><br></span>
                </div>
                <button class= 'button1' name='create' type='submit' value='Submit'>Submit</button>
            </form>
        </div>";
    if (isset($_POST['create'])){
        $owerid = $_POST["patient"];
        
        $variable = substr($owerid, strpos($owerid, ":")+1, (strlen($owerid) -strpos($owerid, ":")) );
        $clinicid = $_POST["clinic"];
        $duedate = $_POST["date"];
        $amountdue = $_POST["amount"];
        $clinicresult = mysqli_query($mysqli,"SELECT Clinic_Id FROM clinics WHERE Adress = '$clinicid'");
                    while($crow = mysqli_fetch_assoc($clinicresult)) {
                        $clinic = $crow["Clinic_Id"];
                    }
        $result = mysqli_query($mysqli,"SELECT Patient_ID FROM patient WHERE Last_Name = '$owerid'");
                    while($cdrow = mysqli_fetch_assoc($result)) {
                        $patient = $cdrow["Patient_ID"];
                    }
        $sql = "INSERT INTO bills(Oid,clinic_id,Due_date,Amount) VALUES ('$variable','$clinic','$duedate','$amountdue')";
        
        if ($mysqli->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }   
    }
// SQL query to select data from database
$sql1 = " SELECT * FROM bills";
$result = $mysqli->query($sql1);
$mysqli->close();
?>
    <section>
        <h1>Patient Billing Information Table</h1>
        <!-- TABLE CONSTRUCTION -->
        <table>
            <tr>
                <th>Ower ID</th>
                <th>Clinic ID</th>
                <th>Due Date</th>
                <th>Amount</th>
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
                <td><?php echo $rows['Oid'];?></td>
                <td><?php echo $rows['clinic_id'];?></td>
                <td><?php echo $rows['Due_date'];?></td>
                <td>$<?php echo $rows['Amount'];?></td>
            </tr>
            
            <?php
                }
            ?> 
            
        </table>
    </section>
</body>
</html>

