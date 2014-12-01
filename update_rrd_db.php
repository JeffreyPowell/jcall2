
<?php

  // Fetch current time
  $now = time();

  $data=snmp2_walk("server", "community", "1.3.6.1.4.1.9.9.63.1.3.2.1.1");

  $lines = preg_grep( "/Hex-STRING/", $data );

  $calls = count($lines);

  $ret = rrd_update("/var/scripts/jcall/jcall.rrd", "$now:$calls");

?>


