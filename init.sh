#!/bin/bash



/usr/bin/rrdtool create /usr/local/scripts/git/jcall/data/jcall.rrd \
--step 300 \
--start now \
DS:activecalls:GAUGE:600:0:U \
RRA:AVERAGE:0.5:1:288 \
RRA:AVERAGE:0.5:12:168 \
RRA:AVERAGE:0.5:228:365


/usr/bin/rrdtool create /usr/local/scripts/git/jcall/data/jcallio.rrd \
--step 300 \
--start now \
DS:incomingcalls:GAUGE:600:0:U \
DS:outgoingcalls:GAUGE:600:0:U \
RRA:AVERAGE:0.5:1:288 \
RRA:AVERAGE:0.5:12:168 \
RRA:AVERAGE:0.5:228:365

ln -s /usr/local/scripts/git/jcall/www /opt/observium/html/jcall
