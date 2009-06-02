<?php
// helper function
function options($options, $selected) {
  foreach ($options as $option) {
    echo '<option value="' . $option . '"' . ($selected == $option ? ' selected="selected"' : '') . '>' . $option . '</option>' . "\n";
  }
}

$flight_type = array(
  'oneway' => $user_data['flight-type'] == 'oneway' ? 'checked="checked"' : '',
  'return' => $user_data['flight-type'] == 'return' ? 'checked="checked"' : '',
);

?>

<div id="sidebar">
<div id="search-form-container">
  <form id="search-form" action="index.php" method="get">
  <h2>Flight search</h2>
  <fieldset id="flight-type">
    <legend>Choose flight type</legend>
    <ul>
      <li>
        <input class="radio" type="radio" name="flight-type" value="oneway" id="flight-type-one-way" <?=$flight_type['oneway']?>>
        <label for="flight-type-one-way">One-way</label>
        <input class="radio" type="radio" name="flight-type" value="return" id="flight-type-return" <?=$flight_type['return']?>>
        <label for="flight-type-return">Return</label>
      </li>
    </ul>
  </fieldset>
  
  <div id="outgoing-form">
    <fieldset id="outoging-flight">
    <legend>Outgoing flight</legend>
    <ul>
      <li>
          <label for="from-airport">From:</label>
          <input class="airport-search" id="from-airport" type="text" name="from-airport" placeholder="airport leaving from" value="<?php echo $user_data['from-airport']; ?>">
        <?php
          $airports = $from_airports;
          $type = 'from';
          include('airport_search.php');
        ?>    
      </li>
      <li>
          <label for="to-airport">To:</label>
          <input class="airport-search" id="to-airport" type="text" name="to-airport" placeholder="airport wish to arrive at" value="<?php echo $user_data['to-airport']; ?>">
        <?php
          $airports = $to_airports;
          $type = 'to';
          include('airport_search.php');
        ?>    
      </li>
      <li>
        <div><label for="departure-date">Departure date &amp; time:</label></div>
        <div><input title="Format: year-month-day hh:mm" class="datetime_picker" type="datetime-local" name="departure-date" placeholder="year-month-day hh:mm" id="departure-date" value="<?php echo $user_data['departure-date']?>"></div>
      </li>
      <li>
        <p>Number of passengers:</p>
        <div>
          <label for="adults">Adults:</label>
          <select class="adults" id="adults" name="adults">
            <?php options(array(0,1,2,3,4,5,6,7,8,9), $user_data['adults']); ?>
          </select>          
        </div>
        <div>
          <label for="children">Children (1-14 years):</label>
          <select class="children" id="children" name="children">
            <?php options(array(0,1,2,3,4,5,6,7,8,9), $user_data['children']); ?>
          </select>
        </div>
        <div>
          <label for="babies">Babies (&lt; 1 years):</label>
          <select class="babies" id="babies" name="babies">
            <?php options(array(0,1,2,3,4,5,6,7,8,9), $user_data['babies']); ?>
          </select>
        </div>
      </li>
    </ul>
    </fieldset>
  </div>
  
  <div id="return-form">
    <fieldset id="return-flight">
      <legend>Return flight</legend>
      <ul>
        <li>
          <div><label for="return-date">Return date &amp; time:</label></div>
          <div><input title="Format: year-month-date hh:mm" type="datetime-local" class="datetime_picker" name="return-date" id="return-date" value="<?php echo $user_data['return-date']?>" placeholder="year-month-day hh:mm"></div>
        </li>
      </ul>
      
    </fieldset>
  </div>
  <input type="hidden" name="action" value="search">
  <input id="submit" name="submit" type="submit" value="Search">
  </form>
</div>
</div>
<div id="search-results">
