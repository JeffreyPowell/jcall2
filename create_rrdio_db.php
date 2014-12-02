<?php

	// requires php5-rddtool package 

$options = array(
 "--step", "300",		// Use a step-size of 5 minutes
 "--start", "now",		// this rrd started now xxx1 day ago
 "DS:incomingcalls:GAUGE:600:0:U",
 "DS:outgoingcalls:GAUGE:600:0:U",
 "RRA:AVERAGE:0.5:1:288",
 "RRA:AVERAGE:0.5:12:168",
 "RRA:AVERAGE:0.5:228:365",
 );

$ret = rrd_create("/var/scripts/jcall/jcallio.rrd", $options, count($options));
if (! $ret) {
 echo "<b>Creation error: </b>".rrd_error()."\n";
}

?>
