<?php

  session_start();

  if(isset($_SESSION['sessionID']) && isset($_SESSION['sessionKey'])) {
    $ses_id = $_SESSION['sessionID'];
    $ses_key = $_SESSION['sessionKey'];

  } else {
    $ses_id = '';
    $ses_key = '';
  }

?>
