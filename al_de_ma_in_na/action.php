<?php

  session_start();

  require('connect.php');

  //Protect
  function protection($value) {
    return md5(md5($value).'bowen');
  }

  function codeValue($value, $separator='_') {
    $array = str_split($value);
    $cipher = array(
      "al"=>"a",
      "ba"=>"b",
      "ca"=>"c",
      "de"=>"d",
      "ec"=>"e",
      "fa"=>"f",
      "ga"=>"g",
      "he"=>"h",
      "in"=>"i",
      "ja"=>"j",
      "ka"=>"k",
      "li"=>"l",
      "ma"=>"m",
      "na"=>"n",
      "os"=>"o",
      "pa"=>"p",
      "qu"=>"q",
      "ra"=>"r",
      "sa"=>"s",
      "ta"=>"t",
      "un"=>"u",
      "vi"=>"v",
      "wh"=>"w",
      "xy"=>"x",
      "ya"=>"y",
      "za"=>"z",
      "at"=>"@",
      "do"=>".",
      "sp"=>"%20",
      "sl"=>"/",
      "an"=>"&",
      "cl"=>" ",
      "ze"=>0,
      "on"=>1,
      "tw"=>2,
      "th"=>3,
      "fo"=>4,
      "fi"=>5,
      "si"=>6,
      "se"=>7,
      "ei"=>8,
      "ni"=>9
    );


    $coded_value = array();
    foreach ($array as $key => $value) {
      $key = array_search (strtolower($value), $cipher);
      $coded_value[] = $key;
    }
    return implode($separator,$coded_value);

  }


  if(isset($_GET['jsDoc']))  {

    //signin
    function signIn($loginID, $loginPass) {

      //if logged in
      if(isset($_SESSION["sessionAdminID"]) && isset($_SESSION["sessionAdminKey"])) {
        return 'Refresh page';
      } else {
        $md5_pass =  protection($loginPass);
        $protection_login_id = codeValue($loginID);

        require('connect.php');
        $query_signin = mysqli_query($con, "SELECT * FROM ed6d1dbcfceec0db6d0989fb54528b99 WHERE user='$protection_login_id' AND pass='$md5_pass' LIMIT 1");
        if(mysqli_num_rows($query_signin) > 0) {
          // Set session variables
          $_SESSION["sessionAdminID"] = $protection_login_id;
          $_SESSION["sessionAdminKey"] = codeValue($md5_pass);

          return 2;
        } else {
          return 'Please ensure that your login details are correct';
        }
      }
    }
    if(isset($_POST['loginID']) && isset($_POST['loginPass'])) {
      print_r(signIn($_POST['loginID'], $_POST['loginPass']));
    }




    //signout
    function signOut($logout) {
      if($logout === '1') {
        session_destroy();
        header('location: ./');
      }
    }
    if(isset($_GET['logout'])) {
      print_r(signOut($_GET['logout']));
    }




    //upload .csv
    function uploadCSV($file) {
      print_r(0);
      $destination_path = getcwd().DIRECTORY_SEPARATOR. 'csv/';
      $target_path = $destination_path . basename( $file['name']);

      if(@move_uploaded_file($file['tmp_name'], $target_path)) {
         print_r(1);
      } else {
        print_r(2);
      }

      sleep(1);
    }
    if(isset($_FILES['csv_file'])) {
      print_r(uploadCSV($_FILES['csv_file']));
    }





    //put users into db
    function registerStudents($file_link) {

      $error_regs = [];
      $existing_regs = [];

      $destination_path = explode("fakepath", $file_link);
      $indexNum = count($destination_path) - 1;
      $fileName = $destination_path[$indexNum];



      $file_link = getcwd().DIRECTORY_SEPARATOR. 'csv'.$fileName;
      if (($handle = fopen($file_link, "r")) !== FALSE) {
          while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
              $num = count($data);
              for ($c=0; $c < $num; $c++) {

                  $reg_num = $data[0];
                  $faculty = $data[1];
                  $department = $data[2];
                  $level = $data[3];

                  $protection_reg_num = codeValue($reg_num);
                  $protection_faculty = codeValue($faculty);
                  $protection_department = codeValue($department);
                  $protection_level = codeValue($level);
              }

              require('connect.php');
               //insert into db

               //check if they exist already
               $chk_usr_exist = mysqli_query($con, "SELECT * FROM users WHERE user='$protection_reg_num' LIMIT 1");

               if(mysqli_num_rows($chk_usr_exist) > 0) {
                 $existing_regs[] = $reg_num;
               } else {
                 $user_input_query = mysqli_query($con, "INSERT INTO users (id, user, pass, mail, valid, candidates, faculty, department, level) VALUES (NULL, '$protection_reg_num', '', '', 0, '', '$protection_faculty', '$protection_department', '$protection_level')");
                 if(!$user_input_query) {
                   $error_regs[] = $reg_num;
                 }
               }
          }
      }

      if(count($error_regs) > 0 || count($existing_regs) > 0) {
        $result[] = $existing_regs;
        $result[] = $error_regs;
      } else {
        $result = 2;
      }

      print_r($result);
    }
    if(isset($_POST['csvFile'])) {
      print_r(registerStudents($_POST['csvFile']));
    }




    // ADMIN functions



    //Create elections
    function createElection($es_name, $es_f, $es_d, $es_l, $el_tab='elections') {

      require('connect.php');

      //es_f, es_d & es_l should be posted as arrays using AJAX and not put in $_GET;

      //md5 & hash table name
      $protection_es_name = codeValue($es_name);
      $protection_es_f= codeValue(implode($es_f)); //convert these ones to string to store them in db as string
      $protection_es_d = codeValue(implode($es_d));  //convert these ones to string to store them in db as string
      $protection_es_l = codeValue(implode($es_l));  //convert these ones to string to store them in db as string

      //chk if election already exists
      $query_election_name_check = mysqli_query($con, "SELECT * FROM $el_tab WHERE name = '$protection_es_name' LIMIT 1");
      $count = mysqli_num_rows($query_election_name_check);

      if($count > 0) {
        return 'error_ election exists';
      } else {
        $query_election_create = mysqli_query($con, "INSERT INTO $el_tab (id, name, faculty, department, level) VALUES (NULL, '$protection_es_name', '$protection_es_f', '$protection_es_d', '$protection_es_l')");
        if($query_election_create) {
          return 'success';
        } else {
          return 'error_election create';
        }
      }

    }
    if(isset($_GET['electionName']) && !isset($_GET['positionName']) && !isset($_GET['candidateName']) && !isset($_GET['vote'])) {

      //change this to $_POST from AJAX document
      $_POST['esf'] = array('Engineering', 'Pharmacy');
      $_POST['esd'] = array('ECE', 'MME');
      $_POST['esl'] = array(100, 200, 400);

      print_r(createElection($_GET['electionName'], $_POST['esf'], $_POST['esd'], $_POST['esl']));
    }

    //delete election
    function deleteElection($es_name, $el_tab='elections', $pos_tab = 'positions', $can_tab = 'candidates') {

      //protect election & position
      $protection_es_name = codeValue($es_name);

      require('connect.php');

      $query_delete_election = mysqli_query($con, "DELETE FROM $el_tab WHERE name='$protection_es_name' LIMIT 1");
      $query_delete_election_position = mysqli_query($con, "DELETE FROM $pos_tab WHERE election='$protection_es_name'");
      $query_delete_election_position_candidates = mysqli_query($con, "DELETE FROM $can_tab WHERE election='$protection_es_name'");

      if($query_delete_election && $query_delete_election_position && $query_delete_election_position_candidates) {
        return 'success';
      } else {
        return 'error_candidate delete';
      }

    }
    if(isset($_GET['electionDel']) && !isset($_GET['positionDel']) && !isset($_GET['candidateDel'])) {
      print_r(deleteElection($_GET['electionDel']));
    }




    //Create positions
    function createPositions($es_name, $position_name, $el_tab='elections', $pos_tab='positions') {

      //protect election & position
      $protection_es_name = codeValue($es_name);
      $protection_position_name = codeValue($position_name);

      require('connect.php');
      //chk if position already exists

      $query_election_check = mysqli_query($con, "SELECT * FROM $el_tab WHERE name='$protection_es_name' LIMIT 1");
      $query_position_check = mysqli_query($con, "SELECT * FROM $pos_tab WHERE name = '$protection_position_name' AND election = '$protection_es_name' LIMIT 1");
      $count = mysqli_num_rows($query_position_check);

      if(mysqli_num_rows($query_election_check) !== 1) {
        return 'error_position election_not_found';
      } else if($count > 0) {
        return 'error_position exists';
      } else {
        $query_position_create = mysqli_query($con, "INSERT INTO $pos_tab (id, name, election) VALUES(NULL ,'$protection_position_name','$protection_es_name')");

        if($query_position_create) {
          return 'success';
        } else {
          return 'error_position create';
        }

      }



    }
    if(isset($_GET['electionName']) && isset($_GET['positionName']) && !isset($_GET['candidateName']) && !isset($_GET['vote'])) {
      print_r(createPositions($_GET['electionName'], $_GET['positionName']));
    }

    //Delete positions
    function deletePosition($es_name, $position_name, $pos_tab = 'positions', $can_tab = 'candidates') {

      //protect election & position
      $protection_es_name = codeValue($es_name);
      $protection_position_name = codeValue($position_name);

      require('connect.php');

      $query_delete_position = mysqli_query($con, "DELETE FROM $pos_tab WHERE name='$protection_position_name'  AND election='$protection_es_name' LIMIT 1");
      $query_delete_position_candidates = mysqli_query($con, "DELETE FROM $can_tab WHERE position='$protection_position_name'  AND election='$protection_es_name'");

      if($query_delete_position && $query_delete_position_candidates) {
        return 'success';
      } else {
        return 'error_candidate delete';
      }

    }
    if(isset($_GET['electionDel']) && isset($_GET['positionDel']) && !isset($_GET['candidateDel'])) {
      print_r(deletePosition($_GET['electionDel'], $_GET['positionDel']));
    }




    //Create candidates
    function createCandidates($es_name, $position_name, $candidate_name, $el_tab = 'elections', $pos_tab = 'positions', $can_tab = 'candidates') {

      //protect election & position
      $protection_es_name = codeValue($es_name);
      $protection_position_name = codeValue($position_name);
      $protection_candidate_name = codeValue($candidate_name);

      require('connect.php');
      //chk if candidate already exists
      //chk if position already exists

      $query_election_check = mysqli_query($con, "SELECT * FROM $el_tab WHERE name='$protection_es_name' LIMIT 1");
      $query_position_check = mysqli_query($con, "SELECT * FROM $pos_tab WHERE name='$protection_position_name' LIMIT 1");
      $query_candidate_check = mysqli_query($con, "SELECT * FROM $can_tab WHERE name='$protection_candidate_name' AND position='$protection_position_name' AND election='$protection_es_name' LIMIT 1");
      $count = mysqli_num_rows($query_candidate_check);

      if(mysqli_num_rows($query_election_check) !== 1) {
        return 'error_candidate election_not_found';
      } else if(mysqli_num_rows($query_position_check) !== 1) {
        return 'error_candidate position_not_found';
      } else if($count > 0) {
        return 'error_candidate exists';
      } else {
        $query_candidate_create = mysqli_query($con, "INSERT INTO $can_tab (id, name, position, election, votes) VALUES(NULL, '$protection_candidate_name' ,'$protection_position_name','$protection_es_name', 0)");

        if($query_candidate_create) {
          return 'success';
        } else {
          return 'error_position create';
        }

      }
    }
    if(isset($_GET['electionName']) && isset($_GET['positionName']) && isset($_GET['candidateName']) && !isset($_GET['vote'])) {
      print_r(createCandidates($_GET['electionName'], $_GET['positionName'], $_GET['candidateName']));
    }

    //Delete candidates
    function deleteCandidates($es_name, $position_name, $candidate_name, $can_tab = 'candidates') {

      //protect election & position
      $protection_es_name = codeValue($es_name);
      $protection_position_name = codeValue($position_name);
      $protection_candidate_name = codeValue($candidate_name);

      require('connect.php');

      $query_delete_candidate = mysqli_query($con, "DELETE FROM $can_tab WHERE name='$protection_candidate_name' AND position='$protection_position_name'  AND election='$protection_es_name' LIMIT 1");

      if($query_delete_candidate) {
        return 'success';
      } else {
        return 'error_candidate delete';
      }

    }
    if(isset($_GET['electionDel']) && isset($_GET['positionDel']) && isset($_GET['candidateDel'])) {
      print_r(deleteCandidates($_GET['electionDel'], $_GET['positionDel'], $_GET['candidateDel']));
    }

  } else {
    header('location: ./404.php');
  }

?>
