<?php


function decodeValueSelect($coded_value, $separator='_') {

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


function getSelectElection() {

  $return = '';
  require('../connect.php');
  $query = mysqli_query($con, "SELECT * FROM elections");


  if(mysqli_num_rows($query) > 0) {
    $return .= "<option disabled selected value>Election Name</option>";

    while($row = mysqli_fetch_assoc($query)) {
      $return .= "<option>".decodeValueSelect($row['name'])."</option>";
    }

  } else {
    $return .= "<option disabled selected value>No elections yet</option>";
  }

  return $return;
}



  print_r(getSelectElection());
?>
