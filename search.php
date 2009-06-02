<div id="results-wrapper">
  <h2>Search results</h2>
  <h3><?php echo $from_airports[0]['title']; ?> to <?php echo $to_airports[0]['title']; ?></h3>
  <form action="/">
    <input type="hidden" name="action" value="book_flight">
<?php

$Flights = new Flights();

if ($user_data['departure-date']) {
  $flights = $Flights->find($from_airports[0], $to_airports[0], $user_data['departure-date']);
?>
      <div id="outgoing">
        <h4>Outgoing</h4>
<?php foreach ($flights as $flight) : ?>
        <ul>
          <li><?=$flight['dairport']['title']?></li>
          <li><?=date('F jS Y', strtotime($flight['ddate']))?></li>
          <li><?=date('H.i a', strtotime('2009-06-01 ' . $flight['dtime']))?></li>
          <li><?=$flight['dterminal']?></li>
          <li>Arriving at <?=$flight['aairport']['title']?>, <?=date('H.i a', strtotime('2009-06-01 ' . $flight['atime']))?>, <?=$flight['aterminal']?></li>
        </ul>
<?php endforeach ?>
      </div>
<?php
} else {
  // show error for departure date
}

if ($user_data['return-date'] && $user_data['flight-type'] == 'return') {
    $flights = $Flights->find($to_airports[0], $from_airports[0], $user_data['return-date']);
?>
      <div id="return">
        <h4>Return</h4>
  <?php foreach ($flights as $flight) : ?>
        <ul>
          <li><?=$flight['dairport']['title']?></li>
          <li><?=date('F jS Y', strtotime($flight['ddate']))?></li>
          <li><?=date('H.i a', strtotime('2009-06-01 ' . $flight['dtime']))?></li>
          <li><?=$flight['dterminal']?></li>
          <li>Arriving at <?=$flight['aairport']['title']?>, <?=date('H.i a', strtotime('2009-06-01 ' . $flight['atime']))?>, <?=$flight['aterminal']?></li>
        </ul>
  <?php endforeach ?>
      </div>
<?php  
}
?>
  </form>
</div>