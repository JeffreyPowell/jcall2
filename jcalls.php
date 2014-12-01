<?php

create_graph("calls-hour.png", "-1h", "ROOST-VGW Hourly Calls");
create_graph("calls-day.png", "-1d", "ROOST-VGW Daily Calls");
create_graph("calls-week.png", "-1w", "ROOST-VGW Weekly Calls");
create_graph("calls-month.png", "-1m", "Monthly Calls");
create_graph("calls-year.png", "-1y", "Yearly Calls");

echo "<img src='calls-hour.png' alt='Generated RRD image'>";
echo "<BR><BR>";
#echo "<table>";
#echo "<tr><td>";
echo "<img src='calls-day.png' alt='Generated RRD image'>";
echo "<BR><BR>";
#echo "</td><td>";
echo "<img src='calls-week.png' alt='Generated RRD image'>";
#echo "</td></tr>";
#echo "<tr><td>";
#echo "<img src='calls-month.png' alt='Generated RRD image'>";
#echo "</td><td>";
#echo "<img src='calls-year.png' alt='Generated RRD image'>";
#echo "</td></tr>";
#echo "</table>";
exit;

function create_graph($output, $start, $title) {

  $options = array(
    "--slope-mode",
    "--start", $start,
    "--title=$title",
    "--vertical-label=Calls(av)",
    "--lower=0",
    "--height=200",
    "--width=500",
    "DEF:a=/var/scripts/jcall/jcall.rrd:activecalls:AVERAGE",
    "CDEF:b=a,300,*",
    "AREA:b#00FF00:Active Calls",
    "COMMENT:\\n",
    "GPRINT:b:AVERAGE:Calls %6.2lf"
  );

 $ret = rrd_graph($output, $options, count($options));

  if (! $ret) {
    echo "<b>Graph error: </b>".rrd_error()."\n";
  }
}

?>
