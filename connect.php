<?php

  $con_user = 'root';
  $con_pass = '';
  $con_db = 'bowen';

  $con = mysqli_connect("localhost",$con_user,$con_pass,$con_db);

  // Check connection
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>
