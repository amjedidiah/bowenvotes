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

  function decodeValue($coded_value, $separator='_') {

    $array = explode($separator, $coded_value);
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

    $decoded_value = array();

    foreach ($array as $key => $value) {
      $decoded_value[] = $cipher[$value];
    }


    return implode($decoded_value);
  }





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
    if(isset($_REQUEST['loginID']) && isset($_REQUEST['loginPass'])) {
      print_r(signIn($_REQUEST['loginID'], $_REQUEST['loginPass']));
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

      $destination_path = explode("fakepath", $file_link);
      $indexNum = count($destination_path) - 1;
      $fileName = $destination_path[$indexNum];



      $file_link = getcwd().DIRECTORY_SEPARATOR. 'csv'.$fileName;
      if (($handle = fopen($file_link, "r")) !== FALSE) {
          while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
              $num = count($data);

              if($num < 4 || $num > 4) {
                return 'Please check that your document follows the standard format';
              } else {
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
              }

              require('connect.php');
              //insert into db & if exists update regnum
              $user_input_query = mysqli_query($con, "INSERT INTO users (user, pass, mail, valid, candidates, faculty, department, level)
                                                      VALUES ('$protection_reg_num', '', '', 0, '', '$protection_faculty', '$protection_department', '$protection_level')
                                                      ON DUPLICATE KEY UPDATE
                                                      user='$protection_reg_num'
                                                      ");
              //put faculty
              $insert_f_query =  mysqli_query($con, "INSERT INTO faculty (name)
                                                      VALUES ('$protection_faculty')
                                                      ON DUPLICATE KEY UPDATE
                                                      name='$protection_faculty'
                                                      ");
              //put department
              $insert_d_query =  mysqli_query($con, "INSERT INTO department (name, faculty)
                                                      VALUES ('$protection_department', '$protection_faculty')
                                                      ON DUPLICATE KEY UPDATE
                                                      name='$protection_department'
                                                      ");
              //put department
              $insert_l_query =  mysqli_query($con, "INSERT INTO level (name, department, faculty)
                                                      VALUES ('$protection_level', '$protection_department', '$protection_faculty')
                                                      ON DUPLICATE KEY UPDATE
                                                      name='$protection_level'
                                                      ");

              if(!$user_input_query || !$insert_f_query || !$insert_d_query || !$insert_l_query) {
                $error_regs[] = $reg_num;
              }

          }
      }

      if(count($error_regs) > 0) {
        $result[] = $error_regs;
      } else {
        $result = 'Students registered successfully';
      }

      return $result;
    }
    if(isset($_REQUEST['csvFile'])) {
      print_r(registerStudents($_REQUEST['csvFile']));
    }




    //create election
    function createElection($es_n, $es_t, $es_c) {

      require('connect.php');

      //md5 & hash table name
      $protection_es_n = codeValue($es_n);
      $protection_es_t = codeValue($es_t); //convert these ones to string to store them in db as string
      $protection_es_c = codeValue($es_c);   //convert these ones to string to store them in db as string

      //chk if election already exists
      $query_election_name_check = mysqli_query($con, "SELECT * FROM elections WHERE name = '$protection_es_n' LIMIT 1");
      $count = mysqli_num_rows($query_election_name_check);

      if($count > 0) {
        return 'An election already exists with this name';
      } else {
        $query_election_create = mysqli_query($con, "INSERT INTO elections (id, name, type, class) VALUES (NULL, '$protection_es_n', '$protection_es_t', '$protection_es_c')");
        if($query_election_create) {
          return 'election_created';
        } else {
          return 'Please try again';
        }
      }
    }
    if(isset($_REQUEST['electionName']) && isset($_REQUEST['est']) && isset($_REQUEST['esc'])) {
      print_r(createElection($_REQUEST['electionName'], $_REQUEST['est'], $_REQUEST['esc']));
    }

    //electiontype list
    function getSelectList($type) {
      $list = [];
      require ('connect.php');

      $election_type_query = mysqli_query($con, "SELECT * FROM $type");

      while($row = mysqli_fetch_assoc($election_type_query)) {
        $list[] = decodeValue($row['name']);
      }

      return json_encode($list);
    }
    if(isset($_REQUEST['election_type'])) {
      print_r(getSelectList($_REQUEST['election_type']));
    }




    //chk position
    function electionPositionCheck($es_n, $ep_n) {

      require('connect.php');

      //md5 & hash table name
      $protection_es_n = codeValue($es_n);  //convert these ones to string to store them in db as string
      $protection_ep_n = codeValue($ep_n);

      //chk if election already exists
      $query_election_position_name_check = mysqli_query($con, "SELECT * FROM positions WHERE name = '$protection_ep_n' AND election='$protection_es_n' LIMIT 1");
      $count = mysqli_num_rows($query_election_position_name_check);

      if($count > 0) {
        return 'Position already exists';
      }
    }
    if(isset($_REQUEST['position_name_check']) && isset($_REQUEST['election_position_name_check'])) {
      print_r(electionPositionCheck($_REQUEST['election_position_name_check'], $_REQUEST['position_name_check']));
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
        return 'Please create an election first';
      } else if($count > 0) {
        return 'Position already exists';
      } else {
        $query_position_create = mysqli_query($con, "INSERT INTO $pos_tab (id, name, election) VALUES(NULL ,'$protection_position_name','$protection_es_name')");

        if($query_position_create) {
          return 'refresh_position';
        } else {
          return 'Please try again';
        }

      }


    }
    if(isset($_REQUEST['electionName']) && isset($_REQUEST['positionName']) && !isset($_REQUEST['candidateName']) && !isset($_REQUEST['vote'])) {
      print_r(createPositions($_REQUEST['electionName'], $_REQUEST['positionName']));
    }

    //electionposition list
    function getPositionSelectList($type) {

      $protection_es_n = codeValue($type);

      $list = [];
      require ('connect.php');

      $election_type_query = mysqli_query($con, "SELECT * FROM positions WHERE election='$protection_es_n'");

      while($row = mysqli_fetch_assoc($election_type_query)) {
        $list[] = decodeValue($row['name']);
      }

      return json_encode($list);
    }
    if(isset($_REQUEST['electionNameCandidate']) && !isset($_REQUEST['es_p']) && !isset($_REQUEST['candidateName']) && !isset($_REQUEST['vote'])) {
      print_r(getPositionSelectList($_REQUEST['electionNameCandidate']));
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
        return 'Election not found';
      } else if(mysqli_num_rows($query_position_check) !== 1) {
        return 'Position not found';
      } else if($count > 0) {
        return 'Candidate already exists';
      } else {
        $query_candidate_create = mysqli_query($con, "INSERT INTO $can_tab (id, name, position, election) VALUES(NULL, '$protection_candidate_name' ,'$protection_position_name','$protection_es_name')");

        if($query_candidate_create) {
          return 'candidate_added';
        } else {
          return 'Try again';
        }

      }
    }
    if(isset($_REQUEST['electionNameCandidate']) && isset($_REQUEST['es_p']) && isset($_REQUEST['candidateName']) && !isset($_REQUEST['vote'])) {
      print_r(createCandidates($_REQUEST['electionNameCandidate'], $_REQUEST['es_p'], $_REQUEST['candidateName']));
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
        return 'error';
      }

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
        return 'error';
      }

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
        $array = $protection_es_name.'jedidiah'.$protection_position_name;

        return $array;
      } else {
        return 'error';
      }

    }

    if(isset($_GET['electionDel']) && isset($_GET['positionDel']) && isset($_GET['candidateDel'])) {
      $es_d = $_GET['electionDel'];
      $ep_d = $_GET['positionDel'];
      $ec_d = $_GET['candidateDel'];

      if($es_d !== '' && $ec_d === '' && $ep_d === '') {
        print_r(deleteElection($es_d));
      } elseif($es_d !== '' && $ec_d === '' && $ep_d !== '') {
        print_r(deletePosition($es_d, $ep_d));
      } elseif ($es_d !== '' && $ec_d !== '' && $ep_d !== '') {
        print_r(deleteCandidates($es_d, $ep_d, $ec_d));
      } elseif ($es_d === '' && $ec_d === '' && $ep_d === '') {
        print_r('closes');
      }
    }

?>
