<?php

  $name = 'Admin | Bowen University Votes';
  $_GET['jsDoc'] = '';

  include('action.php');



  if(isset($_SESSION['sessionAdminID']) && isset($_SESSION['sessionAdminKey'])) {
    $ses_id = $_SESSION['sessionAdminID'];
    $ses_key = $_SESSION['sessionAdminKey'];




    function getPositions($es_n) {

      $elections = '';

      require('connect.php');

      $protection_es_n = codeValue($es_n);

      //chk if positions exist
      $query_post = mysqli_query($con, "SELECT * FROM positions WHERE election='$protection_es_n'");

      if(mysqli_num_rows($query_post) > 0) {
        $elections .='
            <div class="row position-row">';
        while($row = mysqli_fetch_assoc($query_post)) {
          $protection_ep_n = $row['name'];
          $ep_n = decodeValue($protection_ep_n);
          $elections .='<div class="col position" id="'.$ep_n.'" election="'.$es_n.'">'.$ep_n.'</div>';
        }
        $elections .='
          </div>';
      }

      return $elections;

    }





    function getElections() {

      $elections = "";

      require('connect.php');
      $query = mysqli_query($con, "SELECT * FROM elections ORDER BY id DESC");
      $count = mysqli_num_rows($query);

      if($count > 0) {
        while($row = mysqli_fetch_assoc($query)) {

          $protection_es_n = $row["name"];

          $election = decodeValue($protection_es_n);

          $elections .= '<div class="tab-pane-baby col-10 offset-1">
            <h5>'.$election.'</h5>
            <form id="formCreatePosition" class="form form2 text-left">
              <div class="form-group">
                <input election="'.$election.'" name="positionName" type="text" class="form-control form-control-validated" id="positionName" aria-describedby="positionNameHelp" placeholder="Position Name" min="5" required>
                <small id="positionNameHelp" class="form-text text-muted color-err"></small>
              </div>
              <div class="form-group d-none">
                <input name="ElectionName" value="'.$election.'" type="text" class="form-control form-control-validated" id="electionName" aria-describedby="ElectionNameHelp" placeholder="Election Name" min="5" disabled>
                <small id="ElectionNameHelp" class="form-text text-muted color-err"></small>
              </div>
              <button type="submit" class="btn btn-primary btn-block bg-1 mt-3">Add Position</button>
              <div class="sub-msg" id="sub-msg"></div>
            </form>';

            $elections .= print_r(getPositions($election));
        $elections .='
          </div>';

        }
      } else {
        $elections = '';
      }

      return $elections;


    }


  } else {
    $ses_id = '';
    $ses_key = '';
  }


?>
