<style>
 label{
        align-items: center;
        display: block;
        color: #0e067a;
        margin-bottom: 5px;
        transition: 0.4s;
        font-size: 50px;
    }
select{
    align-items: center;
    display: block;
  width: 50%;
  padding: 15px 20px;
  background: white;
  border-radius: 3px;
  transition: 0.4s;
}   
.content {
  max-width: 500px;
  margin: auto;
  margin-top: 20%;
  front-size: 20px;
}
option{
    front-size: 20px;
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
<div class="content">
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
                    $var = $_POST["clinic"];   
                    echo "Address selected ".$var;
                    $clinicadress = $var;
                    $clinicresult = mysqli_query($mysqli,"SELECT Clinic_Id FROM clinics WHERE Adress = '$clinicadress'");
                    while($crow = mysqli_fetch_assoc($clinicresult)) {
                        $clisw = $crow["Clinic_Id"];
                    }
                    $doctorresult = mysqli_query($mysqli,"SELECT D_ID FROM availability WHERE Monday = '$clisw' OR Tuesday = '$clisw' OR Wednesday = '$clisw' OR Thursday = '$clisw' OR Friday = '$clisw'");
                    
                    while($drow = mysqli_fetch_assoc($doctorresult)) {
                        $dlisw[] = $drow;
                    }
                  foreach($dlisw as $dtemp)
                  {
                      $to = $dtemp[D_ID];
                      $doctornameresult = mysqli_query($mysqli,"SELECT Last_Name FROM employees WHERE Employee_ID = '$to'");
                      while($nrow = mysqli_fetch_assoc($doctornameresult)){
                        $dlist[] = $nrow;
                    }
                  }
                    echo "<form action = 'referral3.php' method='post'>";
                    echo "<label>Doctor Location<label>";
                    echo "<input type='hidden' value= '$var' name='adress' />";
                    echo "<input type='hidden' value= '$clisw' name='clinicid'/>";
                    echo "<select name='doctor'  onchange = 'this.form.submit()' >";
                    echo "<option value='' disabled selected>--select--</option>";
                  foreach($dlist as $ntemp)
                  {
                      echo "<option> $ntemp[Last_Name] </option>";
                  }
                  echo "</select>";
                    ?>
                    
        </div>
        </body>
    </html>
        