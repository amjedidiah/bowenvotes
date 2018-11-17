<?php

  // Start the session
  require('session.php');
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




    function vote($es_n, $ep_n, $ec_n, $ses_id) {

      require('connect.php');

      //protect stuff
      $protection_es_n = codeValue($es_n);
      $protection_ep_n = codeValue($ep_n);
      $protection_ec_n = codeValue($ec_n);

      $error = 'false';
      $msg = '';

      //query user vote
      $query = mysqli_query($con, "SELECT * FROM votes WHERE user='$ses_id' AND election='$protection_es_n' AND position='$protection_ep_n' LIMIT 1");

      //if user has voted before
      if(mysqli_num_rows($query) > 0) {
        $query = mysqli_query($con, "DELETE from votes WHERE user='$ses_id' AND election='$protection_es_n' AND position='$protection_ep_n'");

        //if deleted
        if($query) {
          $error = 'false';
        } else {
          $error = 'true';
        }

      }

      if($error === 'false') {
        //add user vote
        $query = mysqli_query($con, "INSERT INTO votes (id, user, candidate, position, election) VALUES (NULL, '$ses_id', '$protection_ec_n', '$protection_ep_n', '$protection_es_n')");

        //if Successful
        $msg = ($query ? $ep_n.'jedidiah'.$es_n : 'try again');
      }
      return $msg;

    }
    if(isset($_REQUEST['electionVote']) && isset($_REQUEST['positionVote']) && isset($_REQUEST['candidateVote'])) {
      print_r(vote($_REQUEST['electionVote'], $_REQUEST['positionVote'], $_REQUEST['candidateVote'], $ses_id));
    }
?>
