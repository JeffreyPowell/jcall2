<?php

  // Fetch current time
  $now = time();

  $data=snmp2_walk("roost-vgw", "Rakuten", "1.3.6.1.4.1.9.9.63.1.3.2.1.1");

  $lines = preg_grep( "/Hex-STRING/", $data );

  $calls = count($lines);

  $ret = rrd_update("/usr/local/scripts/git/jcall/data/jcall.rrd", "$now:$calls");

echo "$now,$calls,$ret";

?>
