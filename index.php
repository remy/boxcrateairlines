<?php
include('lib/airports.php');
include('lib/flights.php');

/**
 * Toggle logic for demo only - though could be reused for some accessiblity features
 */

// store the toggle state for CSS, JavaScript, images, etc
if (@$_GET['toggle']) {
  $toggle = $_GET['toggle'];
  
  if (!isset($_COOKIE[$toggle]) || $_COOKIE[$toggle] == 'on') {
    setcookie($toggle, 'off', time()+(60*60*24));  /* expire in 1 day */
  } else {
    setcookie($toggle, 'on', time()+(60*60*24));  /* expire in 1 day */
  }
  
  // do a redirect so that refresh doesn't accidently toggle back and forth
  header('location: index.php');
}

// read the toggles (images is handled in images.php)
$toggles = array('javascript' => true, 'css' => true, 'css3' => true);

foreach ($toggles as $key => $value) {
  if (@$_COOKIE[$key] == 'off') {
    $toggles[$key] = false;
  }
}

/**
 * Determine if this was an Ajax request, and if so, flag up and return a limited view back
 */ 

$ajax = false;
if (@$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
  $ajax = true;
}

$action = @$_REQUEST['action'];

$from_airports = array();
$to_airports = array();
$user_data = array(
  'flight-type' => isset($_REQUEST['flight-type']) ? $_REQUEST['flight-type'] : 'return',
  'from-airport' => '', 
  'to-airport' => '',
  'departure-date' => @$_REQUEST['departure-date'], // can be blank
  'return-date' => @$_REQUEST['return-date'],
  'adults' => (isset($_REQUEST['adults']) ? $_REQUEST['adults'] : 0),
  'children' => (isset($_REQUEST['children']) ? $_REQUEST['children'] : 0),
  'babies' => (isset($_REQUEST['babies']) ? $_REQUEST['babies'] : 0)
);

$fmt = 'l, F d, Y G:i A'; // Tuesday, June 20, 2009 13:04 PM
$fmt = 'Y-m-d\TH:i'; // required to make webforms2 work :-(

if ($user_data['departure-date']) {
  $user_data['departure-date'] = date($fmt, strtotime($user_data['departure-date']));
}

if ($user_data['return-date']) {
  $user_data['return-date'] = date($fmt, strtotime($user_data['return-date']));
}

if ($action == 'airport_lookup' || $action == 'search') {  
  $Airports = new Airports();
  
  // manually selected overrides
  if (@$_REQUEST['selected-from-airport'] && $_REQUEST['selected-from-airport'] != 'none') {
    $_REQUEST['from-airport'] = $_REQUEST['selected-from-airport'];
  }
  
  if (@$_REQUEST['selected-to-airport'] && $_REQUEST['selected-to-airport'] != 'none') {
    $_REQUEST['to-airport'] = $_REQUEST['selected-to-airport'];
  }
  
  if (@$_REQUEST['from-airport']) {
    $user_data['from-airport'] = $_REQUEST['from-airport'];
    $from_airports = $Airports->find($_REQUEST['from-airport']);
    
    if (count($from_airports) == 1) {
      $user_data['from-airport'] = $from_airports[0]['title'];
    }
  }

  if (@$_REQUEST['to-airport']) {
    $user_data['to-airport'] = $_REQUEST['to-airport'];
    $to_airports = $Airports->find($_REQUEST['to-airport']);

    if (count($to_airports) == 1) {
      $user_data['to-airport'] = $to_airports[0]['title'];
    }
  }
}

/**
 * Main rendering of the HTML is done here, split in to sections
 */

if (!$ajax) {
  include('header.php');
  include('welcome.php');
  include('sidebar.php');
}

if ($action == 'airport_lookup' && $ajax) {
  if (@$_REQUEST['from-airport']) {
    $airports = $from_airports;
    $type = 'from';
  } else {
    $airports = $to_airports;
    $type = 'to';
  }
  
  include('airport_search.php');
} else if ($action == 'search' && count($from_airports) == 1 && count($to_airports) == 1 && $user_data['departure-date']) {
  
  
  include('search.php');
} else {
  // shows errors
  echo 'errors - to be added';
}

if (!$ajax) {
  include('footer.php');
}
?>
