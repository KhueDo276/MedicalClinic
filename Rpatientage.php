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


                                    <!--Filtering begins here -->
<div class="employee">
        <h2>Data Filtering</h2>
        <form action="Rpatient.php" method="post">
            <div class='form'>
                <label>Clinic:</label>
                <select name="clinic[]" multiple>
                    <?php 
                    session_start();
                    $port = $_SERVER
                    ['WEBSITE_MYSQL_PORT'];
                    $servername = "localhost:$port";
                    $username = "azure";
                    $password = "6#vWHD_$";
                    $db = "localdb";
                    
                    $mysqli = new mysqli($servername,$username,$password,$db);
                        if ($mysqli->connect_error) {die("Connection failed: " . $mysqli->connect_error);}
                    $sql = "SELECT Name, Clinic_Id FROM clinics";
                    $result = $mysqli->query($sql);
                    echo '<option value= "n/a">All</option>';
                    while ($row = $result->fetch_assoc()){
                    echo '<option value= "'. $row['Clinic_Id'] .'">' . $row['Name'] . '</option>';
                    }
                    ?>
                </select>
                <label>Age Lower Bound:</label>
                <span><input type="number" name="fromdate" ><br></span>
                <label>Age Upper Bound:</label>
                <span><input type="number" name="todate" ><br></span>
                <label>From Date:</label>
                <span><input type="date" name="fromdate" ><br></span>
                <label>To Date:</label>
                <span><input type="date" name="todate" ><br></span>
            </div>
            <button class= "button1" name="filter" type="submit" value="Submit">Filter</button>
        </form>
</div>
                                      <!--Filtering ends here -->



<?php

     $port = $_SERVER
    ['WEBSITE_MYSQL_PORT'];
    $servername = "localhost:$port";
    $username = "azure";
    $password = "6#vWHD_$";
    $db = "localdb";

        
    $mysqli = new mysqli($servername,$username,$password,$db);
    $dataPoints = array();
    $count = 0;
                       //Decision for the query based on filter selections is made here//
    $year = date("Y");
    $clinicaddon = " AND s.clinic_id = ";
    $cliniccondition = "1=1";
    $fromdate = "";
    $todate = "";
    $i = 0;
            if (isset($_POST['filter'])){
                if(sizeof($_POST["clinic"]) != 0 && $_POST["clinic"][0] != "n/a"){ //Check for clinic filter selection.
                    while($i < sizeof($_POST["clinic"])) {
                        $cliniccondition = $cliniccondition.$clinicaddon.$_POST["clinic"][$i];
                        $i = $i + 1;
                        if($i > 0) {$clinicaddon = " OR s.clinic_id = ";}
                    }
                }
                if($_POST["fromdate"] != "") {            //Check if fromdate was selected
                    $fromdate = " AND bills.paid_date >= '".$_POST["fromdate"]."'";
                }
                if($_POST["todate"] != "") {              //Check if todate was selected
                    $todate = " AND bills.paid_date <= '".$_POST["todate"]."'";
                }
                
                if($_POST["fromdate"] != "" && $_POST["todate"] != "") {   //Display date range being used, with both filters or one
                    echo "Showing patient age groups in date range: ".$_POST["fromdate"]." to ".$_POST["todate"];
                }
                else if($_POST["fromdate"] != "" && $_POST["todate"] == "") {
                    echo "Showing patient age groups from date: ".$_POST["fromdate"];
                }
                else if ($_POST["fromdate"] == "" && $_POST["todate"] != "") {
                    echo "Showing patient age groups up to date: ".$_POST["todate"];
                }
                
                        //Modified query with filters
                $query = "";
            }
            else {     //Query when no filters are used or before the filtering button is pressed
                $query = "select p.Patient_ID, FLOOR(DATEDIFF(CURRENT_DATE, p.DOB)/365) AS Age, a.DATE, c.Name
                            FROM patient p
                            JOIN appointment a ON a.patient_id = p.Patient_ID
                            JOIN clinics c ON a.CLINIC_ID = c.Clinic_Id";
            }
    $result = mysqli_query($mysqli, $query);
    while($row = mysqli_fetch_array($result)) {
        $dataPoints[$count]["label"] = $row["Name"];
        $dataPoints[$count]["y"] = $row["bill_total"];
        $count = $count + 1;
    }
    
?>











</body>
</html>

