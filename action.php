<?php

  // Start the session
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

  function toString($array, $separator='_') {
    return implode($separator, $array);
  }

  function toArray($string, $separator='_') {
    return explode($separator, $string);
  }




  //if from jsDoc: change $_GET here to post, tis post variable is what the AJAX function from the jS file will post
  if(isset($_GET['jsDoc']))  {

    function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function validateLoginID($loginID, $user_mail) {

      $protection_login_id = codeValue($loginID);

        if (filter_var($user_mail, FILTER_VALIDATE_EMAIL)) {
          require('connect.php');
          $query_verify_user = mysqli_query($con, "SELECT * FROM users WHERE user='$protection_login_id' LIMIT 1");
          if(mysqli_num_rows($query_verify_user) > 0) {

            //if pass already exists
            if(mysqli_fetch_assoc($query_verify_user)['pass'] !== '') {
              return 1;
            } else {

                $pass = generateRandomString();
                $md5_pass = protection($pass);

                // $message = file_get_contents('./inc/pass.inc.php');
                $message = "<html lang='en'>
                    <head>

                        <!-- Meta Tags -->
                        <meta charset='utf-8' />
                        <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
                        <meta name='viewport' content='width=device-width, initial-scale=1' />
                        <meta name='description' content='' />
                        <meta name='keywords' content='' />
                        <meta name='author' content='' />

                        <!-- Title -->
                        <title> KwaaKwaa | Subscription Successful </title>

                        <!-- jQuery -->
                        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>

                        <!-- Latest compiled and minified BootStrap CSS -->
                        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>

                        <!-- Latest compiled and minified BootStrapJavaScript -->
                        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>

                        <!-- Font Awesome -->
                        <script src='https://use.fontawesome.com/a0e8ab68c0.js'></script>

                        <!-- Google Fonts -->
                        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
                                <link href='https://fonts.googleapis.com/css?family=Monsieur+La+Doulaise' rel='stylesheet'>

                        <style>

                                    * {
                                        color: #333;
                                    }

                          body {
                            background: #eeeeee;
                          }

                          #body {
                            box-shadow: 1px 1px 10px #0f2ec5;
                            margin-top: 20px;
                            margin-bottom: 20px;
                            background: #fff;
                            border-top: 5px solid #0f2ec5;
                        }

                            * {
                             font-family: 'Montserrat', sans-serif;
                            }

                            #header {
                              text-align: center;
                              border-bottom: 1px solid #ccc;
                          }

                                    #header img {
                              margin: 20px auto;
                                        width: 150px;
                                        min-width: 100px;
                          }

                                    #main {
                                        padding-top: 25px;
                                        padding-bottom: 25px;
                                    }

                                    #footer {
                                        border-top: 1px solid #ccc;
                                        padding: 10px 0 5px 0;
                                        text-align: center
                                    }

                                    .social {
                                        color: #0f2ec5;
                                        margin-left: 10px;
                                        margin-right: 10px
                                    }

                                    .truly {
                                        margin-top: 20px
                                    }

                                    .sign {
                                        font-family: 'Monsieur La Doulaise', cursive;
                                        font-size: 200%
                                    }

                        </style>



                    </head>
                    <body>

                        <div class='container'>
                                <div class='row'>
                                <div class='col-xs-10 col-xs-offset-1' id='body'>

                            <div class='row' id='header'>
                                    <div class='col-xs-12'>
                                <img src='./img/logo.png' width='125px' class='img-responsive' />
                                    </div>
                            </div>

                            <div class='row' id='main'>
                                    <div class='col-xs-12'>

                              <h4>Hello, </h4>
                              <p>Thank you for registering on <strong>Bowen University Votes</strong>.<br />Your pasword is: </p>
                              <p class='lead text-center'><strong>".$pass."</strong></p>
                                        <h5 class='truly'>Yours truly,</h5>
                                        <p> <span class='sign'>Odera &amp;&nbsp; Ebuka</span><br />For KwaaKwaa</p>

                                    </div>
                          </div>

                                    <div class='row' id='footer'>
                                    <div class='col-xs-12'>

                                        <h5>Follow us on:<a href='https://facebook.com/KwaaKwa-1810360815959500/'><img class='social' src='./img/facebook.png' width='18px' style='margin-left: 10px;margin-right: 10px' /></a></h5>


                                    </div>
                          </div>

                        </div>
                                </div>
                                </div>



                    </body>
                    </html>";
                $subject = "Bowen University Votes: Your Password";

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <admin@bowenuiversityvotes.com>' . "\r\n";

                //if(mail($user_mail,$subject,$message,$headers)) {
                if($headers) {

                  $protection_mail = codeValue($user_mail);
                  $query_password_update = mysqli_query($con, "UPDATE users SET pass='$md5_pass', mail='$protection_mail', valid=1 WHERE user='$protection_login_id' LIMIT 1");

                  if($query_password_update) {
                    return 0;
                  } else {
                    return 'Please try again';
                  }

                }
                else {
                    return 'Please try again';
                }
            }
          } else {
            return 'Please enter a valid Matriculation Number';
          }
        } else {
          return 'Please enter a valid email address';
        }
    }
    if(isset($_POST['matricNum']) && isset($_POST['email'])) {
      print_r(validateLoginID($_POST['matricNum'], $_POST['email']));
    }



    function signIn($loginID, $loginPass) {

      //if logged in
      if(isset($_SESSION["sessionID"]) && isset($_SESSION["sessionKey"])) {
        return 'error_logged in';
      } else {
        $md5_pass =  protection($loginPass);
        $protection_login_id = codeValue($loginID);

        require('connect.php');
        $query_signin = mysqli_query($con, "SELECT * FROM users WHERE (user='$protection_login_id' OR mail='$protection_login_id') AND pass='$md5_pass' AND valid=1 LIMIT 1");
        if(mysqli_num_rows($query_signin) > 0) {
          // Set session variables
          $_SESSION["sessionID"] = $protection_login_id;
          $_SESSION["sessionKey"] = codeValue($md5_pass);

          return 2;
        } else {
          return 'Please ensure that your login details are correct';
        }
      }
    }
    if(isset($_POST['loginID']) && isset($_POST['loginPass'])) {
      print_r(signIn($_POST['loginID'], $_POST['loginPass']));
    }



    function signOut($logout) {
      if($logout === '1') {
        session_destroy();
        header('location: ./');
      }
    }
    if(isset($_GET['logout'])) {
      print_r(signOut($_GET['logout']));
    }




    function vote($es_name, $position_name, $candidate_name, $vote) {

      require('connect.php');

      if($vote === 0) {
        $query;
      } else {

      }
      return $es_name.' '.$position_name.' '.$candidate_name.' '.$vote;

    }
    if(isset($_GET['electionName']) && isset($_GET['positionName']) && isset($_GET['candidateName']) && isset($_GET['vote'])) {
      print_r(vote($_GET['electionName'], $_GET['positionName'], $_GET['candidateName'], $_GET['vote']));
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
