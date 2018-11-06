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

  } else {
    header('location: ./404.php');
  }

?>
