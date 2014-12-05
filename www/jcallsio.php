<?php

#create_graph("calls-halfhour.png",     "-15m",         "ROOST-VGW Calls last 15 mins");
create_graph("calls-hourio.png",          "-3h",          "ROOST-VGW last 3 hrs",                 "200", "800");
create_graph("calls-dayio.png",           "-1d",          "ROOST-VGW last 24 hrs",                "70", "200");
create_graph("calls-weekio.png",          "-1w",          "ROOST-VGW last 7 days",                "70", "200");
create_graph("calls-monthio.png",         "-1m",          "ROOST-VGW last 30 days",               "70", "200");
#create_graph("calls-year.png",         "-1y",          "ROOST-VGW last 365 days",              "70", "200");

echo "<html><head>";
#echo "<style> img {display:block; margin-left:auto; margin-right:auto;}</style>";
echo "<meta http-equiv=\"refresh\" content=\"30\">";
echo "</head><body>";

echo "<table>";
echo "<tr><td>";
echo "<img src='calls-hourio.png' alt='Generated RRD image'>";
echo "</td></tr>";
echo "</table>";

echo "<BR>";

echo "<table>";
echo "<tr><td>";
echo "<img src='calls-dayio.png' alt='Generated RRD image'>";
echo "</td><td>";
echo "<img src='calls-weekio.png' alt='Generated RRD image'>";
echo "</td><td>";
echo "<img src='calls-monthio.png' alt='Generated RRD image'>";
echo "</td></tr>";
echo "</table>";
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
    "--color BACK#00AA00",
    //"--color CANVAS#00AA00",
    //"--color SHADEA#00AA00",
    //"--color SHADEB#00AA00",
    //"--color GRID#00AA00",
    //"--color MGRID#00AA00",
    //"--color FONT#00AA00",
    //"--color AXIS#00AA00",
    //"--color FRAME#00AA00",
    //"--color ARROW#00AA00",
    "DEF:incalldata=/usr/local/scripts/git/jcall/data/jcallio.rrd:incomingcalls:AVERAGE",
    "DEF:outcalldata=/usr/local/scripts/git/jcall/data/jcallio.rrd:outgoingcalls:AVERAGE",
    "CDEF:transincalldata=incalldata,1,*",
    "CDEF:transoutcalldata=outcalldata,-1,*",
    "LINE4:transincalldata#a0b842:Active Incoming Calls",
    "AREA:transincalldata#b6d14b",
    "LINE4:transoutcalldata#8686bf:Active Outgoing Calls",
    "AREA:transoutcalldata#a0a0e5",
    "COMMENT:\\n"#,
#    "GPRINT:transincalldata:AVERAGE:Calls IN %6.2lf",
#    "GPRINT:transoutcalldata:AVERAGE:Calls OUT %6.2lf"
  );

 $ret = rrd_graph($output, $options, count($options));

  if (! $ret) {
    echo "<b>Graph error: </b>".rrd_error()."\n";
  }
}

?>
