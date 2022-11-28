<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body style="margin: 50px;">
        <h1>Doctor-Patient Appointments</h1>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Clinic</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Appointment Date</th>
                    <th>Reason</th>
                </tr>
            </thead>
            <tbody>
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
                    
                    //Get data from database
                    $sql = "SELECT CONCAT(p.First_Name,' ', p.Last_Name) AS 'Patient',
                                   p.Patient_ID,
	                               CONCAT(e.First_Name,' ',e.Last_Name) AS 'Doctor',
	                               e.Employee_ID,
	                               c.Name AS 'Clinic',
                                   c.Adress,
                                   c.Phone_Number,
                                   a.DATE,
                                   a.Reason
                            FROM patient p
                            JOIN appointment a ON p.Patient_ID = a.patient_id
                            JOIN employees e ON a.Doctor = e.Employee_ID
                            JOIN clinics c ON c.Clinic_Id = a.Clinic_ID";
                    $result = $mysqli->query($sql);
                    //Check for valid query
                    if(!$result){
                        echo "Invalid query or no patient information is available";
                        
                    }
                    else{
                    while($row = $result->fetch_assoc()) {
                        if($_SESSION['use'] == $row["Employee_ID"] && $_POST['d_patient'] == $row['Patient_ID']){
                        echo "<tr>
                            <td>" . $row["Patient"] . "</td>
                            <td>" . $row["Doctor"] . "</td>
                            <td>" . $row["Clinic"] . "</td>
                            <td>" . $row["Adress"] . "</td>
                            <td>" . $row["Phone_Number"] . "</td>
                            <td>" . $row["DATE"] . "</td>
                            <td>" . $row["Reason"] . "</td>
                        </tr>";
                        }
                    }
                    }
                    
                ?>
                </tbody>
                </table>
        <br>
        <table class="table">
            <h1>Doctor-Patient Referrals</h1>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Doctor Phone</th>
                    <th>Receiving Doctor</th>
                    <th>Receiving Doctor Phone</th>
                    <th>Clinic</th>
                    <th>Address</th>
                    <th>Clinic Phone</th>
                </tr>
            </thead>
            <tbody>
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
                    
                    //Get data from database
                    $sql = "SELECT CONCAT(p.First_Name,' ', p.Last_Name) AS 'Patient',
                                   CONCAT(eD.First_Name,' ', eD.Last_Name) AS 'Doctor',
                                   eD.Employee_ID AS 'd_id',
                                   ed.Phone_Number AS 'Doctor Phone',
                                   CONCAT(eR.First_Name,' ', eR.Last_Name) AS 'Receiving Doctor',
                                   eR.Employee_ID AS 'rd_id',
                                   ed.Phone_Number AS 'Receiving Doctor Phone',
                                   c.Name AS 'Clinic',
                                   c.Adress AS 'Address',
                                   c.Phone_Number AS 'Clinic Phone'       
                            FROM referrals r
                            JOIN clinics c ON c.Clinic_Id = r.Address_Id
                            JOIN employees eD ON eD.Employee_ID = r.Doctor
                            JOIN employees eR ON eR.Employee_ID = r.Receiving_Doctor
                            JOIN patient p ON p.Patient_ID = r.Patient";
                    $result = $mysqli->query($sql);
                    //Check for valid query
                    if(!$result) {
                        echo "Invalid query or no patient information is available";
                    }
                    else {
                    while($row = $result->fetch_assoc()) {
                        if($_SESSION['use'] == $row["d_ID"] OR $_SESSION['use'] == $row["rd_id"]){
                        echo "<tr>
                            <td>" . $row["Patient"] . "</td>
                            <td>" . $row["Doctor"] . "</td>
                            <td>" . $row["Doctor Phone"] . "</td>
                            <td>" . $row["Receiving Doctor"] . "</td>
                            <td>" . $row["Receiving Doctor Phone"] . "</td>
                            <td>" . $row["Clinic"] . "</td>
                            <td>" . $row["Address"] . "</td>
                            <td>" . $row["Clinic_Phone"] . "</td>
                        </tr>";
                    }
                    }
                    }
                ?>
                
            </tbody>
        </table>
        <br>
        <table class="table">
            <h1>Doctor-Patient Prescriptions</h1>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Prescribing Doctor</th>
                    <th>Medication Name</th>
                    <th>Amount</th>
                    <th>Refills</th>
                </tr>
            </thead>
            <tbody>
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
                    
                    //Get data from database
                    $sql = "SELECT CONCAT(p.First_Name,' ', p.Last_Name) AS 'Patient Name',
                                   p.Patient_ID,
                                   CONCAT(e.First_Name,' ', e.Last_Name) AS 'Prescribing Doctor',
                                   pr.Prescriber_ID as 'pr_id',
                                   pr.Medicine_Name,
                                   pr.Amount,
                                   pr.Refills_Left
                            FROM prescription pr
                            JOIN patient p ON p.Patient_ID = pr.Patient_ID
                            JOIN employees e ON e.Employee_ID = pr.Prescriber_ID";
                    $result = $mysqli->query($sql);
                    //Check for valid query
                    if(!$result) {
                        echo "Invalid query or no patient data available";
                    }
                    else {
                    while($row = $result->fetch_assoc()) {
                        if($_SESSION['use'] == $row["pr_ID"]) {
                        echo "<tr>
                            <td>" . $row["Patient_Name"] . "</td>
                            <td>" . $row["Prescribing_Doctor"] . "</td>
                            <td>" . $row["Medicine_Name"] . "</td>
                            <td>" . $row["Amount"] . "</td>
                            <td>" . $row["Refills_Left"] . "</td>
                        </tr>";
                        }
                    }
                    }
                ?>
            </tbody>
        </table>
            <button onclick="document.location='DoctorPatientHistoryReportParam.php'" formtarget="_blank">Return to Patient Select</button>
    </body>
</html>