<?php

class Flights {
  var $flights = array();
  var $airports;
  
  function Flights() {
    $this->load_data();
    
    $this->airports = new Airports();
  }

  // ignores the time for now, showing all the flights for that day
  function find($from, $to, $date) {
    $flights = array();
    
    $date = '2009-05-29'; // hard coded to match the flight data
    
    $date = date('Y-m-j', strtotime($date));
    
    foreach ($this->flights as $flight) {
      if ($flight['dairport'] == $from['code'] && $flight['aairport'] == $to['code'] && $flight['ddate'] == $date) {
        $flight['dairport'] = $this->airports->lookup($flight['dairport']);
        $flight['aairport'] = $this->airports->lookup($flight['aairport']);
        $flights[] = $flight;
      }
    }
    
    uasort($flights, array($this, 'sort'));
    return $flights;
  }

  function load_data() {
    $this->all_flights = array();
    
    $handle = fopen('data/flights.csv', 'r');
    if ($handle) {
      $cols = fgetcsv($handle, 1000, ",");
      
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);

        $normalised = array();

        for ($c=0; $c < $num; $c++) {
          $normalised[$cols[$c]] = $data[$c];
        }
        
        $normalised['datetime'] = strtotime($normalised['ddate'] . ' ' . $normalised['dtime']);

        $this->flights[] = $normalised;
      }

      fclose($handle);      
    }
  }
  
  function sort($a, $b) {
    $a_dt = $a['ddate'] . 'T' . $a['dtime'];
    $b_dt = $b['ddate'] . 'T' . $b['dtime'];
    
    if ($a_dt == $b_dt) {
      return 0;
    }
    return $a_dt < $b_dt ? -1 : 1;
  }  
  
}
?>