#!/bin/bash

  event=$(date +%s)

#  data=$(snmpwalk -v 2c -c Rakuten roost-vgw 1.3.6.1.4.1.9.9.63.1.3.8.4.1 )

#  alllines=$(snmpwalk -v 2c -c Rakuten roost-vgw 1.3.6.1.4.1.9.9.63.1.3.8.4.1 | wc -l)

#  inlines=$(snmpwalk -v 2c -c Rakuten roost-vgw 1.3.6.1.4.1.9.9.63.1.3.8.4.1 | grep 1.3.8.4.1.1 | wc -l)

  incalls=$( snmpwalk -v 2c -c Rakuten roost-vgw 1.3.6.1.4.1.9.9.63.1.3.8.4.1 | grep "1.3.8.4.1.1" | grep -v "Gauge32: 0" | wc -l)

#  outlines=$(snmpwalk -v 2c -c Rakuten roost-vgw 1.3.6.1.4.1.9.9.63.1.3.8.4.1 | grep 1.3.8.4.1.2 | wc -l)

  outcalls=$(snmpwalk -v 2c -c Rakuten roost-vgw 1.3.6.1.4.1.9.9.63.1.3.8.4.1 | grep "1.3.8.4.1.2" | grep -v "Gauge32: 0" | wc -l)

  rrdtool update /usr/local/scripts/git/jcall/data/jcallio.rrd $event:$incalls:$outcalls

#printf "\n";
#printf "$now,$incalls,$outcalls";
#printf "\n";
#printf "all=$alllines";
#printf "\n";
#printf "inall=$inlines";
#printf "\n";
#printf "incalls=$incalls";
#printf "\n";
#printf "outall=$outlines";
#printf "\n";
#printf "outcalls=$outcalls";
#printf "\n";


