<?php
#create_graph("calls-halfhour.png", 	"-15m", 	"ROOST-VGW Calls last 15 mins");
create_graph("calls-hour.png", 		"-3h", 		"ROOST-VGW last 3 hrs", 		"200", "800");
create_graph("calls-day.png", 		"-1d", 		"ROOST-VGW last 24 hrs", 		"70", "200");
create_graph("calls-week.png", 		"-1w", 		"ROOST-VGW last 7 days", 		"70", "200");
create_graph("calls-month.png", 	"-1m", 		"ROOST-VGW last 30 days", 		"70", "200");
#create_graph("calls-year.png", 		"-1y", 		"ROOST-VGW last 365 days", 		"70", "200");



echo "<html><head>";
echo "<style> div.outer {display:block; margin-left:auto; margin-right:auto;}</style>";
echo "<meta http-equiv=\"refresh\" content=\"30\">";
echo "</head><body>";

echo "<div class='outer'>";

echo "<table>";
echo "<tr><td>";
echo "<img src='calls-hour.png' alt='Generated RRD image'>";
echo "</td></tr>";
echo "</table>";

echo "<BR>";

echo "<table>";
echo "<tr><td>";
echo "<img src='calls-day.png' alt='Generated RRD image'>";
echo "</td><td>";
echo "<img src='calls-week.png' alt='Generated RRD image'>";
echo "</td><td>";
echo "<img src='calls-month.png' alt='Generated RRD image'>";
echo "</td></tr>";
echo "</table>";

echo "</div>";
echo "</body></html>";

exit;

function create_graph($output, $start, $title, $height, $width) {

  $options = array(
    "--slope-mode",
    "--start", $start,
    "--title=$title",
    "--vertical-label=Av Calls/min",
    "--lower=0",
    "--height=$height",
    "--width=$width",
    "DEF:calldata=/usr/local/scripts/git/jcall/data/jcall.rrd:activecalls:AVERAGE",
    "CDEF:transcalldata=calldata,1,*",
    "LINE4:transcalldata#00FF00:Active Calls",
    "AREA:transcalldata#AAFFAA",
    "COMMENT:\\n"#,
#    "GPRINT:transcalldata:AVERAGE:Calls %6.2lf"
  );

 $ret = rrd_graph($output, $options, count($options));

  if (! $ret) {
    echo "<b>Graph error: </b>".rrd_error()."\n";
  }
}

?>
