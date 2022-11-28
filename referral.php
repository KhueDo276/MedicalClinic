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
                    
                    $result = mysqli_query($mysqli,"SELECT Adress FROM clinics");
                    $list = [];
                    while($row = mysqli_fetch_assoc($result)) {
                        $list[] = $row;
                    }
                    echo "<form action = '/referral2.php' method='post'>";
                    echo "<label>Clinic Location<label>";
                    echo "<select name='clinic'  onchange = 'this.form.submit()' >";
                    echo "<option value='' disabled selected>--select--</option>";
                    foreach($list as $temp) {
                        echo "<option> $temp[Adress] </option>";
                    }
                    echo "</select>";
                    echo "</form>";
                
                    ?>
            </div>
        </body>
</html>
