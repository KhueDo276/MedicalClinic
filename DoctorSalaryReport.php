<!-- Creates webpage to display the Salary of each employee -->
<style>
    h1{
        text_align: center;
    }
    
</style>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
    <body >
            <!--Navbar link-->
<div id="nav-placeholder">
    </div>
<script>
$(function(){
  $("#nav-placeholder").load("navbar.html");
});
</script>
        <h1>Employee Salaries</h1>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Employee ID</th>
                    <th>Title</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
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
                    
                    //Get Employee salaries
                    $sql = "SELECT Employee_ID,
                                   CONCAT(e.First_Name,' ', e.Last_Name) AS 'Employee',
                                   Type,
                                   Salary
                            FROM employees e";
                    $result = $mysqli->query($sql);
                    //Check for valid query
                    if(!$result) {
                        echo "Invalid query or employee data is not available";
                    }
                    else {
                    while($row = $result->fetch_assoc()) {
                        if($_SESSION['use'] == $row["Employee_ID"]) {
                        echo "<tr>
                            <td>" . $row["Employee"] . "</td>
                            <td>" . $row["Employee_ID"] . "</td>
                            <td>" . $row["Type"] . "</td>
                            <td>" . $row["Salary"] . "</td>
                        </tr>";
                        }
                    }
                    }
                ?>
            </tbody>

        </table>
        <button onclick="document.location='doctorwelcome.php'" formtarget="_blank">Back to home</button>
    </body>
</html>