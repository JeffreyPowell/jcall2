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

#echo "<style> #outer {position: relative;} #inner {margin: auto; position: absolute; left:0; right: 0; top: 0; bottom: 0;}</style>";
echo "<style> #outer {position: relative;} #inner {width:100%;height:100%;display:box;box-orient:horizontal;box-pack:center;box-align:center;} </style>";
#echo "<style> #inner {left: 0; right: 0; margin-left: auto; margin-right: auto; position: absolute;} </style>";

echo "</head><body bgcolor='#080808'>";
echo "<div id='outer' style='width:100%'><div id='inner'>";
    
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

echo "</div></div>";
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
    "-cBACK#161616",
    "-cCANVAS#1e1e1e",
    "-cSHADEA#000000",
    "-cSHADEB#000000",
    //"--color GRID#00AA00",
    //"--color MGRID#00AA00",
    "-cFONT#b7b7b7",
    //"--color AXIS#00AA00",
    "-cFRAME#ffffff",
    "-cARROW#000000",
    "DEF:incalldata=/usr/local/scripts/git/jcall/data/jcallio.rrd:incomingcalls:AVERAGE",
    "DEF:outcalldata=/usr/local/scripts/git/jcall/data/jcallio.rrd:outgoingcalls:AVERAGE",
    "CDEF:transincalldata=incalldata,1,*",
    "CDEF:transoutcalldata=outcalldata,-1,*",
    "LINE2:transincalldata#a0b842:Active Incoming Calls",
    "AREA:transincalldata#b6d14b40",
    "LINE2:transoutcalldata#8686bf:Active Outgoing Calls",
    "AREA:transoutcalldata#a0a0e599",
#    "COMMENT:\\n",
#    "GPRINT:transincalldata:AVERAGE:Calls IN %6.2lf",
#    "GPRINT:transoutcalldata:AVERAGE:Calls OUT %6.2lf"
  );

 $ret = rrd_graph($output, $options, count($options));

  if (! $ret) {
    echo "<b>Graph error: </b>".rrd_error()."\n";
  }
}

?>
