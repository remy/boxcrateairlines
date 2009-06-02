<!DOCTYPE html>
<html> 
  <head> 
  <title>--| Boxcrate airlines |--</title>
<?php if ($toggles['css']) : ?>
  <link rel="stylesheet" media="screen" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" media="screen" type="text/css" href="assets/css/jquery.autocomplete.css">
  <?php if ($toggles['css3']) : ?>
  <link rel="stylesheet" media="screen" type="text/css" href="assets/css/css3.css">
  <?php endif ?>
<?php endif ?>
</head> 
<body>
<div id="wrapper">
    
<ul id="test-menu">
    <li><a href="?toggle=javascript">Toggle JavaScript (now: <?php echo @$_COOKIE['javascript'] == 'off' ? 'off' : 'on';?>)</a></li>
    <li><a href="?toggle=css">Toggle all CSS (now: <?php echo @$_COOKIE['css'] == 'off' ? 'off' : 'on';?>)</a></li>
    <li><a href="?toggle=css3">Toggle CSS 3 (now: <?php echo @$_COOKIE['css3'] == 'off' ? 'off' : 'on';?>)</a></li>
    <li><a href="?toggle=images">Toggle Images (now: <?php echo @$_COOKIE['images'] == 'off' ? 'off' : 'on';?>)</a></li>
</ul>

<div id="header">
  <h1><a href="/">Boxcrate Airlines</a></h1> 
</div>
