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
        <form action="Rrevenue.php" method="post">
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
                    echo "Showing revenue date range: ".$_POST["fromdate"]." to ".$_POST["todate"];
                }
                else if($_POST["fromdate"] != "" && $_POST["todate"] == "") {
                    echo "Showing revenue from date: ".$_POST["fromdate"];
                }
                else if ($_POST["fromdate"] == "" && $_POST["todate"] != "") {
                    echo "Showing revenue up to date: ".$_POST["todate"];
                }
                
                        //Modified query with filters
                $query = "SELECT m.Name, m.bill_total  
                        FROM
                        (SELECT c.Clinic_Id, c.Name, s.bill_total
                        FROM clinics c
                        JOIN 
                        (select clinic_id, sum(amount) AS bill_total
                        from bills
                        WHERE 1=1".$fromdate.$todate."
                        group by bills.clinic_id) s ON c.Clinic_Id = s.clinic_id
                        WHERE ".$cliniccondition."
                        ORDER BY s.bill_total) m";
            }
            else {     //Query when no filters are used or before the filtering button is pressed
                $query = "SELECT m.Name, m.bill_total
                        FROM
                        (SELECT c.Clinic_Id, c.Name, s.bill_total
                        FROM clinics c
                        JOIN 
                        (select clinic_id, sum(amount) AS bill_total
                        from bills
                        WHERE 1=1 AND bills.paid_date >= '".$year."-01-01' AND bills.paid_date <= '".$year."-12-31'
                        group by bills.clinic_id) s ON c.Clinic_Id = s.clinic_id
                        ORDER BY s.bill_total) m";
            }
    $result = mysqli_query($mysqli, $query);
    while($row = mysqli_fetch_array($result)) {
        $dataPoints[$count]["label"] = $row["Name"];
        $dataPoints[$count]["y"] = $row["bill_total"];
        $count = $count + 1;
    }
    
?>

        <script> //Graph begins
        window.onload = function() {
         
        var chart = new CanvasJS.Chart("chartContainer", {
        	animationEnabled: true,
        	theme: "light2",
        	title:{
        		text: "Clinic Revenue"
        	},
        	axisY: {
        		title: "Clinic Revenue (in dollars)"
        	},
        	data: [{
        		type: "column",
        		yValueFormatString: "$#,##0.##",
        		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        	}]
        });
        chart.render();
         
        }
        </script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> <!--Graph ends-->


<?php //Table with graph info and weekly average maybe
    /*$port = $_SERVER
    ['WEBSITE_MYSQL_PORT'];
    $servername = "localhost:$port";
    $username = "azure";
    $password = "6#vWHD_$";
    $db = "localdb";
        
    //error when inputting date from the billing form on web app
        
    $mysqli = new mysqli($servername,$username,$password,$db);
    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    //query
    $query = "SELECT m.Name, m.bill_total
            FROM
            (SELECT c.Clinic_Id, c.Name, s.bill_total
            FROM clinics c
            JOIN 
            (select clinic_id, sum(amount) AS bill_total
            from bills
            group by bills.clinic_id) s ON c.Clinic_Id = s.clinic_id
            ORDER BY s.bill_total) m";*/

?>





</body>
</html>