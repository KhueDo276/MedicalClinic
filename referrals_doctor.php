<!-- this is the page for referrals -->
<style>
.employee {
  height: 100vh;
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  object-fit: contain;
  position: absolute;
  top: 0;
  margin-top: 100px;
}
h1 {
  background-image: linear-gradient(to left, #ce2dc6, #0e067a);
  color: transparent;
  background-clip: text;
  -webkit-background-clip: text;
  margin-bottom: 100px;
}
form{
    text-align:center;
}
.form {
  display: grid;
  grid-template-columns: repeat(4, auto);
  grid-gap: 11px;
  list-style: none;
  text-align: center;
  width: 60vw;
  justify-content:center;
  margin-right: 2rem;
  margin-bottom: 50px;
}

label {
  display: block;
  color: #0e067a;
  /*margin-bottom: 5px;*/
  transition: 0.4s;
  float: left;
  font-size: 18px;
}
.employee:focus-within label {
  color: #ce2dc6;
}

.employee:focus-within input {
  color: black;
}
.button1 {
  display: inline-block;
  padding: 10px 15px;
  border-radius: 8px;
  background-image: linear-gradient(to right, #ce2dc6, #0e067a);
  background-size: 200%;
  background-position: 0%;
  transition: 0.4s;
  color: white;
  font-weight: 700;
  cursor: pointer;
  font-size: large;
  /*margin-top: 100px;*/
  /*margin-bottom: 50px;*/
}
.content{
max-width: 500px;
  margin: auto;
  margin-top: 35%;
}
</style>
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
            
        // -- creating select query for table --
        $sqlSELECT = " SELECT * FROM referrals ";
        $result = $mysqli->query($sqlSELECT);
        //
            
        if (isset($_POST['create'])){
            $patientid = $_POST["patientid"];
            $doctorid = $_POST["doctorid"];
            $ddoctorid = $_POST["ddoctorid"];
            $clinicid = $_POST["clinicid"];
            $date = $_POST["date"];
        
            $sql = "INSERT INTO referrals (Patient,Doctor,Receiving_Doctor,Address_Id,DATE) VALUES ($patientid,$doctorid,$ddoctorid,$clinicid,$date)";
            if ($mysqli->query($sql) === TRUE) {
                echo "New record created successfully";     
            } else {
                echo "Error: " . "<br>" . $mysqli->error;
            }
        }
        elseif ($_POST['id']){
            $id = $_POST['id'];
            
            $sql = "DELETE FROM referrals WHERE Ref_id=$id";
        if ($mysqli->query($sql) === TRUE) {
                echo 1; 
                exit;
            } else {
                echo 0;
                exit;
            }
        }
    ?>      
    

       
<html>
    <head>
    <meta charset="utf-8">
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script> 
        <script src='https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js'></script>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script>
            $(document).ready(function () {

                // Delete 
                $('.delete').click(function () {
                    var el = this;

                    // Delete id
                    var deleteid = $(this).data('ref_id');

                    // Confirm box
                    bootbox.confirm("Do you really want to delete record?", function (result) {

                        if (result) {
                            // AJAX Request
                            $.ajax({
                                url: 'referrals_doctor.php',
                                type: 'POST',
                                data: {id: deleteid},
                                success: function (response) {

                                    // Removing row from HTML Table
                                    if (response == 1) {
                                        $(el).closest('tr').css('background', 'tomato');
                                        $(el).closest('tr').fadeOut(800, function () {
                                            $(this).remove();
                                        });
                                    } else {
                                        bootbox.alert('Record not deleted.');
                                    }

                                }
                            });
                        }

                    });

                });
            });
        </script>
</head>

<body>
    <!--Navbar link-->
<div id="nav-placeholder">
    </div>
<script>
$(function(){
  $("#nav-placeholder").load("navbar.html");
});
</script>

        <div class="employee">
            <h1>Enter Patient Information </h1>
            <form action="referral_doctor.php" method="post">
                <div class="form">
                    <label>Patient ID:</label>
                    <span><input type="text" maxlength = "11" name="patientid" required><br></span>
                    <label>Doctor ID:</label>
                    <span><input type="text" maxlength = "11" name="doctorid" required><br></span>
                </div>
                <div class="form">
                    <label>Receiving ID:</label>
                    <span><input type="text" maxlength = "11" name="ddoctorid" required><br></span>
                    <label>Clinic ID:</label>
                    <span><input type="text" maxlength = "11" name="clinicid" required><br></span>
                    <label>Date:</label>
                    <span><input type="DATE"  name="date" required><br></span>
                </div>
                <button class= "button1" name="create" type="submit" value="Submit">Submit</button>
            </form>
        </div>
    <div class="content">
        <section>
            <table border='1' class='table'>
                <tr style='background: whitesmoke;'>
                    <th>#</th>
                    <th>Patient ID</th>
                    <th> Doctor ID </th>
                    <th>Receiving Date</th>
                    
                </tr>

                <?php
                $sqlSELECT = "SELECT * FROM referrals";
                $result = $mysqli->query($sqlSELECT);
                
                $count = 1;
                while ($rows=$result->fetch_assoc()) {
                    $id = $rows['ref_id']
                    ?>
                    <tr>
                        <td align='center'><?= $count ?></td>
                        <td><?php echo $rows['Patient'];?></td>
                        <td><?php echo $rows['Doctor'];?></td>
                        <td><?php echo $rows['DATE'];?></td>
                        <td align='center'>
                            <button class= "delete btn btn-danger" id='del_<?= $id ?>' data-id='<?= $id ?>' >Delete</button>
                        </td>
                    </tr>
                    <?php
                    $count++;
                }
                ?>
            </table>
        </section>
    </div>
    </body>
</html>
