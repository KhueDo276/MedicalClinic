<style>
    h1{
        text-align: center;
    }
</style>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
    <body>
        <div id="nav-placeholder">
    </div>
<script>
$(function(){
  $("#nav-placeholder").load("navbar_patient.html");
});
</script>
        <h1>Patients and their associated bills</h1>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Payment Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <form method="post" action="">
                <?php
                session_start();
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
                    
                    function getBills() {
                        global $mysqli;
                        //Get data from database
                        $sql = "SELECT p.First_Name, p.Last_Name, b.Amount, b.Due_date,
                                       p.Patient_ID, b.bill_id, b.paid, b.paid_date
                                FROM patient p
                                JOIN bills b ON p.Patient_ID = b.Oid
                                ORDER BY b.paid";
                        $result = $mysqli->query($sql);
                        //Check for valid query
                        if(!$result) {
                            echo "No patient data available";
                        }
                        else {
                            while($row = $result->fetch_assoc()) {
                                if((int)$_SESSION['patient'] == $row["Patient_ID"]) {
                                    if($row["paid"] == 1) {$status = "Paid";} //Change status if bill is paid
                                    else {$status = "Unpaid";}
                                    if($status == "Paid") {$paydate = $row["paid_date"];} //Assign pay-date if bill is paid
                                    else {$paydate = "";}
                                    $bill = $row["bill_id"];
                                echo "<tr>
                                    <td>" . $row["First_Name"] . "</td>
                                    <td>" . $row["Last_Name"] . "</td>
                                    <td>$" . $row["Amount"] . "</td>
                                    <td>" . $row["Due_date"] . "</td>
                                    <td>" . $paydate . "</td>
                                    <td>" . $status . "</td>
                                    <td><button type='submit' name='billpay' value='{$bill}'>Pay now</button></td>
                                </tr>";
                                }
                            }
                        }
                    }
                    if (isset($_POST['billpay']) ) {
                        $bill_paid = (int) $_POST['billpay'];
                        // Do the database update code to set Accept
                        $updatequery = "UPDATE bills SET paid = 1, paid_date = current_date() WHERE bill_id =".$bill_paid;
                        if ($mysqli->query($updatequery) === TRUE) {
                          echo "Payment processed successfully";
                        } else {
                          echo "Error processing payment: " . $mysqli->error;
                        }
                     }
                    getBills();
                ?>
                </form>
            </tbody>
        </table>
            <button onclick="document.location='password.php'" formtarget="_blank">Back to home</button>
    </body>
</html>