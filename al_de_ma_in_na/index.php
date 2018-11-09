<?php

  include('function.php');
  include('./views/header.view.php');

  if($ses_id !== '' || $ses_key !== '') {
    if($es_n !== '') {
      include('./views/dashboard_admin_election.view.php');
    } else {
      include('./views/dashboard_admin.view.php');
    }

  } else {
    include('./views/home.view.php');
  }

  include('./views/footer.view.php');

?>
