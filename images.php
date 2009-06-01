<?php
if (@$_REQUEST['file']) {
  // sanitise so it's only a filename
  $file = 'assets/images/' . preg_replace('/\.+/', '.', preg_replace('/[^a-z\.\-]/', '', $_REQUEST['file']));
  
  if (@$_COOKIE['images'] == 'off' || !file_exists($file)) {
    // kinda dirty, but makes images vanish and triggers the alt tag
    header("HTTP/1.0 404 Not Found");
  } else {
    // Disabled for now, wonder what's more expensive on server & client: two http requests or serving from file - I think the former.
    // header('location: ' . preg_replace('/\/images\//', '/_images/', $_SERVER['REQUEST_URI']));
    // $type = finfo_file(finfo_open(FILEINFO_MIME), $file); // return mime type ala mimetype extension - wish I had 5.3!
    $pinfo = pathinfo($file);
    header('Content-type: image/' . $pinfo['extension']);
    echo file_get_contents($file);
  }
}

?>