<?php

  $name = 'Bowen University Votes';
  $_GET['jsDoc'] = '';

  include('action.php');

  if(isset($_SESSION['sessionID']) && isset($_SESSION['sessionKey'])) {
    $ses_id = $_SESSION['sessionID'];
    $ses_key = $_SESSION['sessionKey'];



    function electionsToShow($ses_id) {

      require('connect.php');

      //get user details
      $query_details = mysqli_query($con, "SELECT * FROM users WHERE user='$ses_id' OR mail='$ses_id' LIMIT 1");
      $row = mysqli_fetch_assoc($query_details);

      $protection_faculty = $row['faculty'];
      $protection_department = $row['department'];
      $protection_level = $row['level'];

      //Get elections
      $query_getElections = mysqli_query($con, "SELECT * FROM elections WHERE faculty LIKE '%$protection_faculty%' AND department LIKE '%$protection_department%' AND level LIKE '%$protection_level%'");
      $elections = array();

      while($row_query_getElections = mysqli_fetch_assoc($query_getElections)) {
        $elections[] = $row_query_getElections['name'];

        /*$query_election_position = mysqli_query($con, "SELECT * FROM positions WHERE election='$election'");

        while($row_query_election_position = mysqli_fetch_assoc($query_election_position)) {

          print_r($row_query_election_position['name']);
        }*/
      }

      print_r($elections);

      /*foreach ($result as $key => $value) {


        print_r($value['faculty']);
        print_r('<br />');
        print_r($value['department']);
        print_r('<br />');
        print_r($value['level']);
        print_r('<br /><br /><br />');
      }*/


    }
    // print_r('<br />'.electionsToShow($_SESSION['sessionID']));
    // print_r(codeValue(200).'<br />');

    // print_r($ses_id.'<br />'.$ses_key);
  } else {
    $ses_id = '';
    $ses_key = '';
  }

?>
