<?php


function strip_all($in) {
  $in = trim($in);
  $in = stripslashes($in);
  $in = htmlspecialchars($in);
  return $in;
}

function validate_tnam1($in) {
  if (empty($in)) {
    return false;
  }    
  $in = strip_all($in);	
  if (strlen($in) <> 45) {return false;}	
  $reg_tnam1 = '/tnam1[a-zA-Z0-9]{40}$/i';	
  return preg_match($reg_tnam1, $in);
}

function return_part_tnam1($in) {
  if (empty($in)) {
    return false;
  }
  $in = strip_all($in);
  $reg_tnam1 = '/tnam1[a-zA-Z0-9]{40}/i';
  $pattern_matches = '';
  preg_match($reg_tnam1, $in, $pattern_matches);
  return($pattern_matches[0]);	
}

function validate_integer($in) {
  if (empty($in)) {
    return false;
  }    
  $in = strip_all($in);
  if (strlen($in) > 25) {return false;}
  $reg_int = '/\d+$/i';
  return preg_match($reg_int, $in);
}

function validate_proposal_id($in) {
	return validate_integer($in);
}

function validate_double($in) {
  if (empty($in)) {return false;}	
  $in = strip_all($in);
  if (strlen($in) > 25) {return false;}
  $reg_double = '/^\d*\.?\d+$/i';
  return preg_match($reg_double, $in);
}

function hyperlink_address($in, $mode_arg) {
   $in = strip_all($in);	
   $mode_arg = strip_all($mode_arg);
   $return_tnam = return_part_tnam1($in);
   if (!$return_tnam) {die('wrong internal parameter call');}
  $uri = strip_all($_SERVER['REQUEST_URI']);
 $uri = array_shift(explode('?', $uri)); 
  $servername = strip_all($_SERVER['HTTP_HOST']);
  $newlink = 'https://' . $servername . $uri . '?address=' . $return_tnam . '&mode=' . $mode_arg . '&threshold=&ltgt=gt';
  $returnstring = '<a href="' . $newlink . '" style="text-decoration: none">' . $in . '</a>'; 
  return $returnstring;
}

function hyperlink_proposal($in, $mode_arg) {
  $uri = strip_all($_SERVER['REQUEST_URI']);
 $uri = array_shift(explode('?', $uri));
  $servername = strip_all($_SERVER['HTTP_HOST']);
  $newlink = 'https://' . $servername . $uri . '?proposal_id=' . $in;
  $returnstring = '<a href="' . $newlink . '">' . $in . '</a>';
  return $returnstring;
}



?>
