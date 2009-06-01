<?php
class Airports {
  var $airports = array();
  
  function Airports() {

    // load csv and store in $airports
    $handle = fopen('data/airports.csv', 'r');
    
    $this->airports = array();
    if ($handle) {
      $cols = fgetcsv($handle, 1000, ",");
      
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);

        $normalised = array();

        for ($c=0; $c < $num; $c++) {
          $normalised[$cols[$c]] = $data[$c];
        }

        $normalised['title'] = $normalised['airport'] . ' (' . $normalised['code'] . '), ' . $normalised['country'];

        $this->airports[] = $normalised;
      }
            
      uasort($this->airports, array($this, 'sort'));

      fclose($handle);      
    }
  }
  
  function sort($a, $b) {
    $a_title = strtolower($a['title']);
    $b_title = strtolower($b['title']);
    
    if ($a_title == $b_title) {
      return 0;
    }
    return $a_title < $b_title ? -1 : 1;
  }  
  
  function find($str) {
    $str = strtolower($str);
    
    $found = array();
    
    foreach ($this->airports as $airport) {
      if (stripos(strtolower($airport['title']), $str) !== false) {
        $found[] = $airport;
      }
    }
    
    return $found;
  }
}
?>