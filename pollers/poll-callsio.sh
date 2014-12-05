#!/bin/bash

  event=$(date +%s)

  incalls=$( snmpwalk -v 2c -c Rakuten roost-vgw 1.3.6.1.4.1.9.9.63.1.3.8.4.1 | grep "1.3.8.4.1.1" | grep -v "Gauge32: 0" | wc -l)

  outcalls=$(snmpwalk -v 2c -c Rakuten roost-vgw 1.3.6.1.4.1.9.9.63.1.3.8.4.1 | grep "1.3.8.4.1.2" | grep -v "Gauge32: 0" | wc -l)

  rrdtool update /usr/local/scripts/git/jcall/data/jcallio.rrd $event:$incalls:$outcalls
