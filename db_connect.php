<?php

  $con_user = 'bowenvotes-393707bc';
  $con_pass = '4gp9k9k4e2';
  $con_db = 'bowenvotes-393707bc';

  $con = mysqli_connect("shareddb-k.hosting.stackcp.net",$con_user,$con_pass,$con_db);

  // Check connection
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>
