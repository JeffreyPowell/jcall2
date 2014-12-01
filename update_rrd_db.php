
<?php

  // Fetch current time
  $now = time();

  $data=snmp2_walk("roost-vgw", "Rakuten", "1.3.6.1.4.1.9.9.63.1.3.2.1.1");

#  $data=$(snmpwalk -v 2c -c Rakuten roost-vgw 1.3.6.1.4.1.9.9.63.1.3.2.1.1 | grep Hex-STRING | wc -l);
    
#  $ret = rrd_update("jcall.rrd", "$now:$data");
echo "$data";

foreach ($data as $d){
  echo "-$d\n";
}

$lines = preg_grep( "/Hex-STRING/", $data );

$calls = count($lines);

echo "$now,$calls";

$ret = rrd_update("/var/scripts/jcall/jcall.rrd", "$now:$calls");

echo "-$ret-3-";

echo $ret;

?>


