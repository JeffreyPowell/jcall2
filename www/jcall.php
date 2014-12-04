<?php
$servername = "localhost";
$username = "jcalllogger";
$password = "oracle";
$dbname = "jcalllogger";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM log ORDER BY sample DESC LIMIT 60";
$result = mysqli_query($conn, $sql);

echo "<html><head><meta http-equiv=\"refresh\" content=\"30\"></head><body><code>";
echo "<h2>Calls last 60 mins</h2>";

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "" . $row["sample"]. " - Calls: " . $row["value"]. " ";
	$x = 1;
	while($x <= $row["value"]) {echo "#";$x++;}
	echo "<br>";
    }
} else {
    echo "0 results";
}
echo "</code>";
#echo "<img src=\"http://10.12.2.26/jhour.php\">";
echo "</body></html>";
mysqli_close($conn);
?>


