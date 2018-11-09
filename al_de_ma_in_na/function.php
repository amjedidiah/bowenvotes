<?php

  $name = 'Admin | Bowen University Votes';
  $_GET['jsDoc'] = '';

  include('action.php');

  if(isset($_SESSION['sessionAdminID']) && isset($_SESSION['sessionAdminKey'])) {
    $ses_id = $_SESSION['sessionAdminID'];
    $ses_key = $_SESSION['sessionAdminKey'];

    if(isset($_SESSION['es_n'])) {
      $es_n = $_SESSION['es_n'];
    } else {
      $es_n = '';
    }

  } else {
    $ses_id = '';
    $ses_key = '';
  }

?>
