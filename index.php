<?php

  include('function.php');
  include('./views/header.view.php');

  if($ses_id !== '' || $ses_key !== '') {
    include('./views/dashboard_user.view.php');
  } else {
    include('./views/home.view.php');
  }

  include('./views/footer.view.php');

?>
