#!bin/bash


  event=$(date +%s)

#  $data=snmp2_walk("roost-vgw", "Rakuten", "1.3.6.1.4.1.9.9.63.1.3.8.4.1");

  alllines=$(/bin/bash snmpwalk -v 2c -c Rakuten roost-vgw 1.3.6.1.4.1.9.9.63.1.3.8.4 | wc -l)

#  $alllines = count($data);

#  $inlines  = preg_grep( '/^*1.1*$/', $data );
#  $inlinesc = count($inlines);


#  $indead   = preg_grep( '/^*1.1*Gauge32: 0$/', $data );

#  $indeadc  = count($indead);

#  $outlines = preg_grep( '/*1.2*/', $data );
#  $outlinesc= count($outlines);

#  $outdead  = preg_grep( '/9\.9\.63\.1\.3\.8\.4\.1\.2*Gauge32: 0/', $data );
#  $outdeadc = count($outdead);

#  $incalls  = $inlinesc-$indeadc;
#  $outcalls = $outlinesc-$outdeadc;

#  $ret = rrd_update("/var/scripts/jcall/jcallio.rrd", "$now:$incalls:$outcalls");

rrdtool update /var/scripts/jcall/jcallio.rrd $event:$incalls:$outcalls


echo "\n";
echo "$now,$incalls,$outcalls";
echo "\n";
echo "a=$alllines";
echo "\n";
echo "b=$inlinesc";
echo "\n";
echo "c=$indeadc";
echo "\n";
echo "d=$outlinesc";
echo "\n";
echo "e=$outdeadc";
echo "\n";


#========
#!/bin/bash

#filename=/tmp/jeff-$(date +%y-%m-%d_%H:%M).csv

#echo "" > $filename

# run script for x seconds ( 10800 = 60x60x3 = 3 hours )

#x=10800 

# sample every y seconds

#y=30


#starttime=$(date +%s)

#while [ $(( $(date +%s) - $x )) -lt $starttime ];
#do

#now="$(date)"
#printf "%s" "$now" >> $filename
#printf "%s\n" "$now"

#for i in $( lsof 2>>/dev/nul | grep lx-autoindex | awk '{print $2}' | uniq ); do

#        printf ", PID %s = %s " "$i" "$(lsof -p $i 2>>/dev/null | wc -l)" 1>>$filename
        
#done

#printf "\n" >> $filename

#sleep $y

#done
