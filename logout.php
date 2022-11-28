<?php   session_start();  ?>

<html>
  <head>
       <title> Logout Page </title>
  </head>
  <body>
<?php
 session_start();

  echo "Logout Successfully ";
  session_destroy();   // function that Destroys Session 
  header("Location:https://medicalgroup.azurewebsites.net/");
?>
</body>
</html>






