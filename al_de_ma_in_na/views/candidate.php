<?php

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


  //list candidates
  function getCandidates($protection_ep_n, $protection_es_n) {

    $return = '';

    require('../connect.php');

    $query = mysqli_query($con, "SELECT * FROM candidates WHERE election='$protection_es_n' AND position='$protection_ep_n'");

    if(mysqli_num_rows($query) > 0) {
      $return .= '<div class="candidate-div"><div class="candidates">';

      while($row = mysqli_fetch_assoc($query)) {

        $protection_ec_n = $row['name'];

        $query_num = mysqli_query($con, "SELECT * FROM votes WHERE election='$protection_es_n' AND position='$protection_ep_n' AND candidate='$protection_ec_n'");

        if(mysqli_num_rows($query_num) > 1) {
          $pl = 's';
        } else {
          $pl = '';
        }

        $return .= '<div class="candidate text-center" ec_n="'.decodeValue($protection_ec_n).'" es_n="'.decodeValue($protection_es_n).'" ep_n="'.decodeValue($protection_ep_n).'">'.decodeValue($protection_ec_n).'<br />'.mysqli_num_rows($query_num).' vote'.$pl.'</div>';
      }
      $return .= '</div></div>';
    } else {
      $return .= "<p class='text-center'>No candidates created yet</p>";
    }

    return $return;

  }
  if(isset($_GET['position']) && isset($_GET['election'])) {
    print_r(getCandidates($_GET['position'], $_GET['election']));
  }

?>
