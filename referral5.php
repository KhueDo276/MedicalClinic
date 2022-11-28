<style>
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
            <div id="nav-placeholder"></div>
        <script>
        $(function(){
        $("#nav-placeholder").load("navbar_patient.html");
        });
</script>
        
<?php 
    session_start();
    $port = $_SERVER['WEBSITE_MYSQL_PORT'];
    $servername = "localhost:$port";
    $username = "azure";
    $password = "6#vWHD_$";
    $db = "localdb";
    $time =  $_POST['time'];
    $doctor = $_POST['namew'];
    $clinic = $_POST['clinicidd'];
    $date = $_POST['date'];
     
    $mysqli = new mysqli($servername,$username,$password,$db);
                    // Create connection
                    // Check connection
    if ($mysqli->connect_error) 
    {
        die("Connection failed: " . $mysqli->connect_error);
    }
    echo "<form method = 'POST'>
            <label>Reason:</label>
            <select name='reason'>
                    <option value='cough'>Cough</option>
                    <option value='back pain'>Back Pain</option>
                    <option value='abdominal symptoms'>Abdominal Symptoms</option>
                    <option value='pharyngitis'>Pharyngitis</option>
                    <option value='dermatitis'>Dermatitis</option>
                    <option value='fever'>Fever</option>
                    <option value='headache'>Headache</option>
                    <option value='leg symptoms'>Leg Symptoms</option>
                    <option value='respiratory concerns'>Respiratory Concerns</option>
                    <option value='fatigue'>Fatigue</option>
                    <option value='other'>Other</option>
            </select>
            <input type='hidden' value = '$time' name='timeE' />
            <input type='hidden' value = '$doctor' name='doctorR'/>
            <input type='hidden' value = '$date' name='dateE' />
            <input type='hidden' value = '$clinic' name='clinicC' />
            <input type='submit' name ='submit'>
        </form>";
    ?>
    
        <?php
    if (isset($_POST["submit"]))
    {
        $id = $_SESSION['patient'];
        $time =  $_POST['timeE'];
        $reason =  $_POST['reason'];
        $doctor = $_POST['doctorR'];
        $clinic = $_POST['clinicC'];
        $date = $_POST['dateE'];
        
                    // Create connection
                    // Check connection
        
        $sql = "INSERT INTO appointment(patient_id, DATE, CLINIC_ID,Doctor,Reason,Time) VALUES ('$id','$date','$clinic','$doctor','$reason','$time')";
        if ($mysqli->query($sql) === TRUE) 
        {
            echo "New record created successfully";     
        } 
        else
        {
            echo "Error: " . $mysqli->error;
        } 
    }
?>
<section>
        <h1>Appointment Information</h1>
        <table>
        <tr>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Clinic</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Appointment Date</th>
            <th>Reason</th>
            <th>Time</th>
        </tr>
    <?php
    $sql = "SELECT CONCAT(p.First_Name,' ', p.Last_Name) AS 'Patient',
                                   p.Patient_ID,
	                               CONCAT(e.First_Name,' ',e.Last_Name) AS 'Doctor',
	                               e.Employee_ID,
	                               c.Name AS 'Clinic',
                                   c.Adress,
                                   c.Phone_Number,
                                   a.DATE,
                                   a.Reason,
                                   a.Time
                            FROM patient p
                            JOIN appointment a ON p.Patient_ID = a.patient_id
                            JOIN employees e ON a.Doctor = e.Employee_ID
                            JOIN clinics c ON c.Clinic_Id = a.Clinic_ID";
    $result = $mysqli->query($sql);
                    //Check for valid query
    if(!$result)
    {
        echo "Invalid query or no patient information is available";
    }
    else
    {
        while($row = $result->fetch_assoc()) 
        {
            if((int)$_SESSION['patient'] == $row["Patient_ID"])
            {
                echo 
                    "<tr>
                        <td>" . $row["Patient"] . "</td>
                        <td>" . $row["Doctor"] . "</td>
                        <td>" . $row["Clinic"] . "</td>
                        <td>". $row["Adress"] . "</td>
                        <td>" . $row["Phone_Number"] . "</td>
                        <td>" . $row["DATE"] . "</td>
                        <td>". $row["Reason"] . "</td>
                        <td>". $row["Time"] . "</td>
                    </tr>";
            }
        }
    }
    ?>
    </table> 
        </section>
</body>
</html>