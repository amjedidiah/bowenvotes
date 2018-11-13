<?php

  $name = 'Admin | Bowen University Votes';
  $_GET['jsDoc'] = '';

  include('action.php');



  if(isset($_SESSION['sessionAdminID']) && isset($_SESSION['sessionAdminKey'])) {
    $ses_id = $_SESSION['sessionAdminID'];
    $ses_key = $_SESSION['sessionAdminKey'];

      function getSelectElection() {

        $return = '';
        require('connect.php');
        $query = mysqli_query($con, "SELECT * FROM elections");


        if(mysqli_num_rows($query) > 0) {
          $return .= "<option disabled selected value>Election Name</option>";

          while($row = mysqli_fetch_assoc($query)) {
            $return .= "<option>".decodeValue($row['name'])."</option>";
          }

        } else {
          $return .= "<option disabled selected value>No elections yet</option>";
        }

        return $return;
      }

  } else {
    $ses_id = '';
    $ses_key = '';
  }


?>
