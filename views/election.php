<?php

function codeValueElection($value, $separator='_') {
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

function decodeValueElection($coded_value, $separator='_') {

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


function getPositions($es_n) {

  $elections = '';

  require('connect.php');

  $protection_es_n = codeValueElection($es_n);

  //chk if positions exist
  $query_post = mysqli_query($con, "SELECT * FROM positions WHERE election='$protection_es_n'");

  if(mysqli_num_rows($query_post) > 0) {
    print_r('
        <div class="row position-row">');
    while($row = mysqli_fetch_assoc($query_post)) {
      $protection_ep_n = $row['name'];
      $ep_n = decodeValueElection($protection_ep_n);
      print_r('<div data-toggle="modal" data-target="#exampleModal" class="col position" id="'.$ep_n.'" election="'.$es_n.'">'.$ep_n.'</div>');
    }
    print_r('
      </div>');
  } else {
    print_r('No positions yet');
  }


}





function getElections() {

  $elections = "";

  require('connect.php');
  $query = mysqli_query($con, "SELECT * FROM elections ORDER BY id DESC");
  $count = mysqli_num_rows($query);

  if($count > 0) {
    print_r('<div class="row">');
    while($row = mysqli_fetch_assoc($query)) {

      $protection_es_n = $row["name"];

      $election = decodeValueElection($protection_es_n);

      print_r('<div class="tab-pane-baby col-10 offset-1 col-lg-5 offset-lg-0"><h5>'.$election.'</h5>

      ');

        print_r(getPositions($election));
      print_r('</div>');
    }
    print_r('</div>');
  } else {

  }

}


  print_r(getElections());
?>
