<?php if (count($airports) > 1) : 
  if ($ajax) :
    foreach ($airports as $airport) : 
      echo $airport['title'] . "\n";
    endforeach;
  else : ?>
<div class="find-destination">
  <p>The following destinations match your destination entry above. To search for a new destination, change the airport search entry and click "Search" again.</p>
  <ul class="destination-results">
<?php $i = 0; ?>
<?php foreach ($airports as $airport) : $i++; ?>
    <li><input id="<?php echo $type; ?>-airport<?php echo $i; ?>" type="radio" name="selected-<?php echo $type; ?>-airport" value="<?php echo $airport['title']; /* should be code, but does fine for our demo */ ?>"><label for="<?php echo $type; ?>-airport<?php echo $i; ?>"><?php echo $airport['title']; ?></label></li>
<?php endforeach; ?>
    <li><input id="<?php echo $type; ?>-airport-none" type="radio" name="selected-<?php echo $type; ?>-airport" value="none"><label for="<?php echo $type; ?>-airport-none">None, search again</label></li>
  </ul>
</div>
<?php endif; endif ?>